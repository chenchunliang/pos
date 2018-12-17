<?php
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Parameter;

function get_thisweek($day){

	$dayweek=get_number_weekday($day);//算出這天星期幾(數字)
		switch($dayweek){
			case 1:
				$startday=date("Y-m-d",strtotime($day));
				$endday=date("Y-m-d",strtotime($day)+60*60*24*6);
		break;
			case 2:
				$startday=date("Y-m-d",strtotime($day)-60*60*24*1);
				$endday=date("Y-m-d",strtotime($day)+60*60*24*5);
		break;
			case 3:
				$startday=date("Y-m-d",strtotime($day)-60*60*24*2);
				$endday=date("Y-m-d",strtotime($day)+60*60*24*4);
		break;
			case 4:
				$startday=date("Y-m-d",strtotime($day)-60*60*24*3);
				$endday=date("Y-m-d",strtotime($day)+60*60*24*3);
		break;
			case 5:
				$startday=date("Y-m-d",strtotime($day)-60*60*24*4);
				$endday=date("Y-m-d",strtotime($day)+60*60*24*2);
		break;
			case 6:
				$startday=date("Y-m-d",strtotime($day)-60*60*24*5);
				$endday=date("Y-m-d",strtotime($day)+60*60*24*1);
		break;
			case 7:
				$startday=date("Y-m-d",strtotime($day)-60*60*24*6);
				$endday=date("Y-m-d",strtotime($day));
		break;
		}//end switch
		return array($startday,$endday);
}

function get_before_day($day,$before){
	$endday=date("Y-m-d",strtotime($day)-60*60*24*$before);
	return $endday;
}

function get_number_weekday($datetime){
    $weekday = date('w', strtotime($datetime));
	$weeklist = array(7, 1, 2, 3, 4, 5, 6);
    return $weeklist[$weekday];
}

function lastDateOfMonth($date){
	return date("Y-m-t", strtotime($date));
}

function barcodeGenerator($data){
	$barcode = new DNS1D();
	return '<img src="data:image/png;base64,'.$barcode->getBarcodePNG($data, "C39",1,1).'" width="100%" height="24" />';
}

function item_barcodeGenerator($data){//EAN13最後1位是檢查碼，不可以亂輸入
	$barcode = new DNS1D();
	return '<img src="data:image/png;base64,'.$barcode->getBarcodePNG($data, "EAN13",1,1).'" width="120px" height="25px" class="itembarcode" />';
}

function qrcodeGenerator($data){
	$qrcode = new DNS2D();
	return '<img src="data:image/png;base64,'.$qrcode->getBarcodePNG($data,"QRCODE").'" width="80%" />';
}

function aseEncrypt($data){
	$Parameter_AESkey=Parameter::where('parameter_code','AESkey')->first()->parameter_value;
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
	$RepresentIdentifier='00000000';//固定值
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
	
	$qr2_data="**".$qr2_product_string;
	//echo $qr2_data;
	
	$codepath['qr2']=qrcodeGenerator($qr2_data);
		
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
		'd'=>floatval(strtotime($Salesinvoice->salesinvoice_date.' '.$Salesinvoice->salesinvoice_time)),
		'cd'=>floatval(strtotime($invalidinvoice->invalidinvoice_invaliddate.' '.$invalidinvoice->invalidinvoice_invalidtime)),
		'r'=>$invalidinvoice->invalidinvoice_invalidreason
	);
	
	$json_text=json_encode($invoice,JSON_PRESERVE_ZERO_FRACTION);
	
	$file = fopen($others['uploadC0501Folder']."/C0501-".$Salesinvoice->salesinvoice_invoicenumber.".json","w");
	$rs=fwrite($file,$json_text);
	fclose($file);
	
	return $rs;
}

function emptyInvoiceGenerator($Invoices,$others){
	$n=1;
	$text="";
	foreach($Invoices as $Invoice){
		$text.=$n.','.$others['companyIdentifier'].','.$others['period'].','
			  .$Invoice->invoice_wordtrack.','.str_pad($Invoice->invoice_currentnumber+1,8,'0',STR_PAD_LEFT).','.$Invoice->invoice_endnumber.",07\r\n";
		$Invoice->invoice_outputemptynumber=1;//有匯出
        $Invoice->update();
		
		$n++;
	}
	
	if(count($Invoices)>0){
		$file = fopen($others['uploadEmptyFolder']."/emptyInvoice-".$others['period'].".csv","w");
		$rs=fwrite($file,$text);
		fclose($file);
	}
}
?>