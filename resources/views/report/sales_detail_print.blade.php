<table width="100%" class="table table-striped table-bordered">
  <tr>
    <th colspan="6">{{$companyName}}</th>
  </tr>
  <tr>
    <th colspan="4">{{$companyAddress}}</th>
    <th colspan="2">{{$companyPhone}}</th>
  </tr>
  <tr>
    <th colspan="6">銷售明細表</th>
  </tr>
  <tr>
    <th>列印日期</th>
    <th>{{$print_date}}</th>
    <th>交易日期</th>
    <th>{{$startdate}} ~ {{$enddate}}</th>
    <th>客戶群組</th>
    <th>{{$customer_group}}</th>    
  </tr>
  <tr>
    <th>發票日期</th>
    <th>發票號碼</th>
    <th>買受人</th>
    <th>買受人統編</th>
    <th>商品項目</th>
    <th>發票金額</th>
  </tr>
  @foreach($Salesinvoices as $Salesinvoice)
  <tr>
    <th>{{$Salesinvoice->salesinvoice_date}}</th>
    <th>{{$Salesinvoice->salesinvoice_invoicenumber}}</th>
    <th>{{$Salesinvoice->customer->customer_name}}</th>
    <th>{{$Salesinvoice->salesinvoice_identifier}}</th>
    <th>@php
	$productarray= json_decode($Salesinvoice->salesinvoice_productarray);
    $i=1;
    @endphp
    
    @foreach($productarray as $product)
      {{$product->ProductName.' '.$product->ProductQty.' '.number_format($product->ProductAmount)}}
    @if($i!=count($productarray))
    <br>
    @endif
    
    @php
    $i++;
    @endphp
    @endforeach
   	</th>
    <th>{{$Salesinvoice->salesinvoice_totalamount}}</th>
  </tr>
  @endforeach
</table>