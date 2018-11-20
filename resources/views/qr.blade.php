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
	font-size:3px;
}
body {
	font-size: 4px;
}
</style>
        </head>
        <body>
<div style="width: 4.8cm;">
	<div>
        <div align="center">{{ HTML::image("images/logo.jpg", 'logo',array('height'=>'50')) }}</div>
        <div class="big_text2">電子發票證明聯(補)</div>
        <div class="big_text">107年11-12月 </div>
        <div class="big_text">JQ-10024414 </div>
        <div>2018-11-15 09:32:04 <span style="padding-left:15px">格式 25</span> </div>
        <div>隨機碼:0377<span style="padding-left:51px">總計:8,339</span> </div>
        <div>賣方:55891836<span style="padding-left:10px">買方:63987472</span></div>
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
    <div>客服電話：05-5512323</div>
    <div style="margin:15px 0px 7px 0px; border:1px dashed black"></div>
    <div>
    <div class="big_text">交易明細</div>
    <table align="center" border="0" cellspacing="0" cellpadding="0" width="100%" style="border-collapse:collapse;">
      <tbody>
        <tr>
          <td colspan="3">賣方：阿古力社會企業</td>
        </tr>
        <tr>
          <td colspan="3">電話：05-5512323</td>
        </tr>
        <tr class="small_text">
          <td colspan="3">地址：雲林縣斗六市西平路666號1樓</td>
        </tr>
        <tr>
          <td colspan="3">買方：06195262</td>
        </tr>
        <tr style="border-bottom:1px black dashed;">
          <td colspan="3">日期：2018-11-15 09:32:04</td>
        </tr>
        @foreach($ProductArrays as $ProductArray)
        <tr class="small_text">
          <td width="60%" style="word-break: break-all;">{{$ProductArray['ProductName'].'x'.$ProductArray['ProductQty']}}</td>
          <td width="17%" align="right">{{$ProductArray['ProductAmount']}}</td>
		  <td width="23%" align="right">{{$ProductArray['ProductSumAmount'].$ProductArray['TaxType']}}</td>
        </tr>
        @endforeach
        <tr style="border-top:1px black dashed;">
          <td align="right">應稅銷售額：</td>
		  <td colspan="2" align="right">${{number_format($ProductTotalTXSaleAmount)}}</td>
        </tr>
        <tr>
          <td align="right">稅&nbsp;&nbsp;&nbsp;&nbsp;額：</td>
		  <td colspan="2" align="right">${{number_format($TotalTaxAmount)}}</td>
        </tr>
        <tr>
          <td align="right">免稅銷售額：</td>
		  <td colspan="2" align="right">${{number_format($ProductTotalTNSaleAmount)}}</td>
        </tr>
        <tr>
          <td align="right">總&nbsp;&nbsp;&nbsp;&nbsp;計：</td>
		  <td colspan="2" align="right">${{number_format($ProductTotalAmount)}}</td>
        </tr>
      </tbody>
	</table>
    <p>更正內容請於7日內辦理</p>
  </div>
        </div>
</div>
</div>
</body>
</html>
