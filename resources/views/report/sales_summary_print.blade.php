<table width="100%" class="table table-striped table-bordered">
  <tr>
    <th colspan="6">{{$companyName}}</th>
  </tr>
  <tr>
    <th colspan="4">{{$companyAddress}}</th>
    <th colspan="2">{{$companyPhone}}</th>
  </tr>
  <tr>
    <th colspan="6">銷售匯總表</th>
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
    <th>發票號碼</th>
    <th>{{$startinvoicenumber}} ~ {{$endinvoicenumber}}</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>品項</th>
    <th>數量</th>
    <th>發票金額</th>
    <th>稅別</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
 @foreach($productSummary as $product)
  <tr>
    <th>{{$product['ProductName']}}</th>
    <th>{{$product['ProductQty']}}</th>
    <th>{{$product['ProductSumAmount']}}</th>
    <th>{{$product['TaxType']=='TN'?'免稅':'應稅內含'}}</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  @endforeach
  <tr>
    <th>總計</th>
    <th>&nbsp;</th>
    <th>{{$totalMoney}}</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
</table>