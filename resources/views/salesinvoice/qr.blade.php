<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>電子發票</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
.big_text {
	font-size: 24px;
	text-align: center;
	font-weight: 600;
	line-height:23px;
}

.big_text2 {
	font-size: 20px;
	text-align: center;
	font-weight: 600;
	line-height:23px;
}


.small_text{
	font-size:10px;
}
body {
	font-size: 12px;
}
</style>
        </head>
        <body>
<div style="width: 4.8cm; margin-left:-3px">
	<div>
        <div align="center"><img src="{{ $invoiceImage}}" height="50" />
        <div class="big_text2">{{$title}}</div>
        <div class="big_text">{{$salesinvoice_date_text}}</div>
        <div class="big_text">{{substr($Salesinvoice->salesinvoice_invoicenumber,0,2)."-".substr($Salesinvoice->salesinvoice_invoicenumber,2,8)}}</div>
        <div style="text-align: left;">{{$Salesinvoice->salesinvoice_date.' '.$Salesinvoice->salesinvoice_time}}<span style="float: right;">格式 25</span> </div>
        <div style="text-align: left;">隨機碼:{{$Salesinvoice->salesinvoice_randomnumber}}<span style="float: right;">總計:{{number_format($Salesinvoice->salesinvoice_totalamount)}}</span> </div>
        <div style="text-align: left;">賣方:{{$Parameter_companyIdentifier}}<span style="float: right;">{{$Salesinvoice->salesinvoice_identifier?'買方:'.$Salesinvoice->salesinvoice_identifier:''}}</span></div>
	</div>
	<div class="line" style="display: block; margin: 3px auto 4px; height: 0.6cm; letter-spacing: 0.33cm;">
     {!!$barcode!!}
     </div>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="100%">
       <tbody>
		  <tr>
			 <td align="left" width="50%">{!!$qr1!!}</td>
       		 <td align="right" width="50%">{!!$qr2!!}</td>
     		  </tr>
          </tbody>
  	</table>
    <div>客服電話：{{$companyPhone}}</div>
    
    @if($invoiceDetail)
    <div style="margin:15px 0px 7px 0px; border:1px dashed black;"></div>
    <div>
    <div class="big_text">交易明細</div>
    <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;">
      <tbody>
        <tr>
          <td colspan="3">賣方：{{$companyName}}</td>
        </tr>
        <tr>
          <td colspan="3">電話：{{$companyPhone}}</td>
        </tr>
        <tr class="small_text">
          <td colspan="3">地址：{{$companyAddress}}</td>
        </tr>
        <tr>
          <td colspan="3">{{$Salesinvoice->salesinvoice_identifier?'買方:'.$Salesinvoice->salesinvoice_identifier:''}}</td>
        </tr>
        <tr style="border-bottom:1px black dashed;">
          <td colspan="3">日期：{{$Salesinvoice->salesinvoice_date.' '.$Salesinvoice->salesinvoice_time}}</td>
        </tr>
        @foreach($ProductArrays as $ProductArray)
        <tr class="small_text">
          <td width="55%" style="word-break: break-all;">{{$ProductArray['ProductName'].'x'.$ProductArray['ProductQty']}}</td>
          <td width="20%" align="right">{{$ProductArray['ProductAmount']}}</td>
		  <td width="25%" align="right">{{$ProductArray['ProductSumAmount'].$ProductArray['TaxType']}}</td>
        </tr>
        @endforeach
        <tr style="border-top:1px black dashed;">
          <td align="right">銷售額：</td>
		  <td colspan="2" align="right">${{number_format($Salesinvoice->salesinvoice_txsalesamount)}}</td>
        </tr>
        @if($Salesinvoice->salesinvoice_identifier)
        <tr>
          <td align="right">稅&nbsp;&nbsp;&nbsp;&nbsp;額：</td>
		  <td colspan="2" align="right">${{number_format($Salesinvoice->salesinvoice_taxamount)}}</td>
        </tr>
        @endif
        <tr>
          <td align="right">免稅銷售額：</td>
		  <td colspan="2" align="right">${{number_format($Salesinvoice->salesinvoice_tnsalesamount)}}</td>
        </tr>
        <tr>
          <td align="right">總&nbsp;&nbsp;&nbsp;&nbsp;計：</td>
		  <td colspan="2" align="right">${{number_format($Salesinvoice->salesinvoice_totalamount)}}</td>
        </tr>
      </tbody>
	</table>
    <p>更正內容請於7日內辦理</p>
  </div>
        </div>
  @endif
</div>
</div>
<!-- jQuery -->
	{{ HTML::script('vendor/jquery/jquery.min.js')}}
    
<script>

$(function() {
	print();
	window.close();
});

</script>
</body>
</html>
