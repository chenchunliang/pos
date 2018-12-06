<?php
//use Endroid\QrCode\ErrorCorrectionLevel;
//use Endroid\QrCode\QrCode;
//use Endroid\QrCode\LabelAlignment;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Parameter;

/*
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
*/

function barcodeGenerator($data){
	$barcode = new DNS1D();
	return '<img src="data:image/png;base64,'.$barcode->getBarcodePNG($data, "C39",1,1).'" width="100%" height="24" />';
}

function item_barcodeGenerator($data){//EAN13最後1位是檢查碼，不可以亂輸入
	$barcode = new DNS1D();
	return '<img src="data:image/png;base64,'.$barcode->getBarcodePNG($data, "EAN13",1,1).'" width="120px" height="25px" />';
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
	$Parameter_AESkey=Parameter::where('parameter_code','AESkey')->first()->parameter_value;
	//6F42C5148D45357E77124DC9CD27225A
	$AESkey =  hex2bin($Parameter_AESkey);//公司取得之AESkey
	
	$iv 	= base64_decode("Dt8lyToo17X/XkXaQvihuA==");//財政部固定值
	$method = 'AES-128-CBC';//加密方法
	
	return base64_encode(openssl_encrypt($data,$method, $AESkey,OPENSSL_RAW_DATA, $iv));
}

							//發票號碼		發票日期		隨機碼			銷售額			總計		買方統編				商品資訊
function createInvoiceCode($InvoiceNumber,$InvoiceDate,$RandomNumber,$SalesAmount,$TotalAmount,$BuyerIdentifier,$ProductArrays){
		
	$Parameter_companyIdentifier=Parameter::where('parameter_code','companyIdentifier')->first();
	$SellerIdentifier=$Parameter_companyIdentifier->parameter_value;
	
	$codepath=array('barcode'=>'','qr1'=>'','qr2'=>'');
	
	//--------barcode--------
	$InvoicePeriod=intval(substr($InvoiceDate,0,3));
	$m=intval(substr($InvoiceDate,3,2));
	
	if($m%2==0) $InvoicePeriod.=$m;
	if($m%2!=0) $InvoicePeriod.=str_pad(($m+1),2,"0",STR_PAD_LEFT);
	
	$codepath['barcode']=barcodeGenerator($InvoicePeriod.$InvoiceNumber.$RandomNumber);
	//-----------------------
	
	//--------QRrcode--------
	$RepresentIdentifier='00000000';//固定
	$BuyerIdentifier=$BuyerIdentifier?$BuyerIdentifier:'00000000';
	
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

function C0401JsonGenerator($Salesinvoice,$others){
	$date = new DateTime($Salesinvoice->salesinvoice_date.' '.$Salesinvoice->salesinvoice_time, new DateTimeZone('Asia/Taipei'));
	$unix_time=floatval($date->getTimestamp());
	

	$invoice['m']=array(
		'n'=>$Salesinvoice->salesinvoice_invoicenumber,
		'd'=>$unix_time,
		's'=>array(
			'i'=>$others['companyIdentifier'],
			'n'=>$others['companyName']
		),
		'pm'=>"Y",
		'r'=>strval($Salesinvoice->salesinvoice_randomnumber)
	);
	
	if($Salesinvoice->salesinvoice_identifier){
		$invoice['m']=array_merge($invoice['m'],array('b'=>array('i'=>$Salesinvoice->salesinvoice_identifier)));
	}
	
	$invoice['a']=array(
		's'=>intval($Salesinvoice->salesinvoice_txsalesamount),
		'f'=>intval($Salesinvoice->salesinvoice_tnsalesamount),
		'z'=>intval(0),//零稅率
		'ta'=>intval($Salesinvoice->salesinvoice_taxamount),
		'a'=>intval($Salesinvoice->salesinvoice_totalamount)
	);
	
	$ProductItemArray=array();
	$SequenceNumber=1;
	
	foreach(json_decode($Salesinvoice->salesinvoice_productarray,true) as $ProductItem){
		
		array_push($ProductItemArray,
			array(
				'd'=>$ProductItem['ProductName'],
				'q'=>floatval($ProductItem['ProductQty']),
				'p'=>floatval($ProductItem['ProductAmount']),
				'a'=>floatval($ProductItem['ProductSumAmount']),
				's'=>strval($SequenceNumber++),
				'r'=>($ProductItem['TaxType']=="TN"?"Tf":"Tx")
			)
		);
		
	}//end foreach
	
	$invoice['d']['l']=$ProductItemArray;
	$json_text=json_encode($invoice,JSON_PRESERVE_ZERO_FRACTION);
	
	$file = fopen($others['uploadC0401Folder']."/C0401-".$Salesinvoice->salesinvoice_invoicenumber.".json","w");
	$rs=fwrite($file,$json_text);
	fclose($file);
	
	return $rs;
}



function C0501JsonGenerator($Salesinvoice,$others){
	$invalidinvoice=$Salesinvoice->invalidinvoice;
	$invalidinvoice=$invalidinvoice->first();
	
	$invoice=array(
		'n'=>$Salesinvoice->salesinvoice_invoicenumber,
		'd'=>floatval(strtotime($Salesinvoice->salesinvoice_date)),
		'cd'=>floatval(strtotime($invalidinvoice->invalidinvoice_invaliddate.' '.$invalidinvoice->invalidinvoice_invalidtime)),
		'r'=>$invalidinvoice->invalidinvoice_invalidreason
	);
	
	$json_text=json_encode($invoice,JSON_PRESERVE_ZERO_FRACTION);
	
	$file = fopen($others['uploadC0501Folder']."/C0501-".$Salesinvoice->salesinvoice_invoicenumber.".json","w");
	$rs=fwrite($file,$json_text);
	fclose($file);
	
	return $rs;
}
?>