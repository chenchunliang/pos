<?php
//use Endroid\QrCode\ErrorCorrectionLevel;
//use Endroid\QrCode\QrCode;
//use Endroid\QrCode\LabelAlignment;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

function is_cellphone(){
	$device='/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|'.
          'docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|'.
          'midp|mini|mmp|mobi|motorola|nokia|palm|panasonic|philips|'.
          'phone|sagem|sharp|smartphone|sony|symbian|t-mobile|telus|'.
          'vodafone|wap|webos|wireless|xda|xoom|zte)/i';
	if (preg_match($device, $_SERVER['HTTP_USER_AGENT']))
		return true;
	else return false;
}

function is_iphone(){
	$device='/(iphone|ipad|ipaq|ipod)/i';
	if (preg_match($device, $_SERVER['HTTP_USER_AGENT']))
		return true;
	else return false;
}


function barcodeGenerator($data){
	$barcode = new DNS1D();
	return '<img src="data:image/png;base64,'.$barcode->getBarcodePNG($data, "C39",1,1).'" width="100%" height="24" />';
}

function qrcodeGenerator($data){
	$qrcode = new DNS2D();
	return '<img src="data:image/png;base64,'.$qrcode->getBarcodePNG($data,"QRCODE").'" width="70%" />';
}


/*
function qrcodeGenerator($qrCode){
	
	$qrCode->setSize(150);
	
	// Set advanced options
	$qrCode->setWriterByName('png');//副檔名
	$qrCode->setMargin(15);//大小
	$qrCode->setEncoding('UTF-8');//編碼
	$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::LOW);//容錯率
	$qrCode->setRoundBlockSize(false);
	
	// Save it to a file
	$path='/images/qrcode/qrcode'.rand().'.png';
	$qrCode->writeFile(public_path().$path);
	
	return $path;
}
*/
	
function aseEncrypt($data){
	$AESkey =  hex2bin("6F42C5148D45357E77124DC9CD27225A");//公司取得之AESkey
	$iv 	= base64_decode("Dt8lyToo17X/XkXaQvihuA==");//財政部固定值
	$method = 'AES-128-CBC';//加密方法
	
	return base64_encode(openssl_encrypt($data,$method, $AESkey,OPENSSL_RAW_DATA, $iv));
}

function createInvoiceCode($InvoiceNumber,$InvoiceDate,$RandomNumber,$SalesAmount,$TotalAmount,$BuyerIdentifier,$SellerIdentifier,$ProductArrays){
	
	$codepath=array('barcode'=>'','qr1'=>'','qr2'=>'');
	
	//--------barcode--------
	$InvoicePeriod=substr($InvoiceDate,0,3);
	$m=substr($InvoiceDate,3,2);
	
	if($m%2==0) $InvoicePeriod.=$m;
	if($m%2!=0) $InvoicePeriod.=str_pad(($m+1),2,"0",STR_PAD_LEFT);
	
	$codepath['barcode']=barcodeGenerator($InvoicePeriod.$InvoiceNumber.$RandomNumber);
	//-----------------------
	
	//--------QRrcode--------
	$RepresentIdentifier='00000000';

	$SalesAmount=str_pad(dechex($SalesAmount),8,"0",STR_PAD_LEFT);
	$TotalAmount=str_pad(dechex($TotalAmount),8,"0",STR_PAD_LEFT);	
	$aesbase64=aseEncrypt($InvoiceNumber.$RandomNumber);
	$QR_length=0;
	$qr1_product_string="";
	$qr2_product_string="";
	
	
	//二維條碼記載完整品目筆數  QRcode可以不用記全部明細  所以要寫記在QRcode上的筆數
	//該張發票交易品目總筆數  紀錄該張發票交易品目總筆數(不管有沒有出現在QRcode上的總筆數)
	if(count($ProductArrays)>=5){//5個以上，只記5個  左QR*1+右QR*4
		$QR_length=5;
		$ProductArrays_length=count($ProductArrays);
		
		for($i=0;$i<5;$i++){
			if($i<1){
			   $qr1_product_string.=$ProductArrays[$i]['ProductName'].":".$ProductArrays[$i]['ProductQty'].":".$ProductArrays[$i]['ProductAmount'].":";
			}else{		
			   $qr2_product_string.=$ProductArrays[$i]['ProductName'].":".$ProductArrays[$i]['ProductQty'].":".$ProductArrays[$i]['ProductAmount'];			
				if($i!=4){	
					$qr2_product_string.=":";
				}
			}
		}
	}else if(count($ProductArrays)>3){//2~4個  左QR*1+右QR*3
		$ProductArrays_length=$QR_length=count($ProductArrays);
		for($i=0;$i<4;$i++){
			if($i<1){
			   $qr1_product_string.=$ProductArrays[$i]['ProductName'].":".$ProductArrays[$i]['ProductQty'].":".$ProductArrays[$i]['ProductAmount'].":";
			}else{		
			   $qr2_product_string.=$ProductArrays[$i]['ProductName'].":".$ProductArrays[$i]['ProductQty'].":".$ProductArrays[$i]['ProductAmount'];			
				if($i!=3){	
					$qr2_product_string.=":";
				}
			}
		}
	}else{//左QR*1 1個
		$ProductArrays_length=$QR_length=count($ProductArrays);
		$qr1_product_string.=$ProductArrays[0]['ProductName'].":".$ProductArrays[0]['ProductQty'].":".$ProductArrays[0]['ProductAmount'].":";
	}
	
	$qr1_data=$InvoiceNumber.$InvoiceDate.$RandomNumber.$SalesAmount.$TotalAmount.$BuyerIdentifier.$SellerIdentifier.$aesbase64.":**********:".$QR_length.":".$ProductArrays_length.":1:".$qr1_product_string;
	//echo $qr1_data;
	
	$codepath['qr1']=qrcodeGenerator($qr1_data);
	//$qr1_obj = new QrCode($qr1_data);
	//$codepath['qr1']=qrcodeGenerator($qr1_obj);
	
	$qr2_data="**".$qr2_product_string;
	//echo $qr2_data;
	
	$codepath['qr2']=qrcodeGenerator($qr2_data);
	//$qr2_obj = new QrCode($qr2_data);
	//$codepath['qr2']=qrcodeGenerator($qr2_obj);
		
	return $codepath;
	//-----------------------
}
	
?>