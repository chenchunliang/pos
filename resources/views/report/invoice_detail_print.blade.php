<table width="100%" border="1" cellspacing="0">
  <tr>
    <th colspan="9">{{$companyName}}</th>
  </tr>
  <tr>
    <th colspan="4">{{$companyAddress}}</th>
    <th colspan="5">{{$companyPhone}}</th>
  </tr>
  <tr>
    <th colspan="9">發票明細表</th>
  </tr>
  <tr>
    <th>列印日期</th>
    <th>{{$print_date}}</th>
    <th>交易日期</th>
    <th>{{$startdate}} ~ {{$enddate}}</th>
    <th>客戶群組</th>
    <th>{{$customer_group}}</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th> 
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>發票日期</th>
    <th>發票號碼</th>
    <th>買受人</th>
    <th>買受人統編</th>
    <th>稅別</th>
    <th>免稅銷售額</th>
    <th>應稅銷售額</th>
    <th>稅額</th>
    <th>發票金額</th>
  </tr>
  @php $i=0; @endphp
  @foreach($Salesinvoices as $Salesinvoice)
  <tr>
    <th>{{$Salesinvoice->salesinvoice_date}}</th>
    <th>{{$Salesinvoice->salesinvoice_invoicenumber}}</th>
    <th>{{$Salesinvoice->customer->customer_name}}</th>
    <th>{{$Salesinvoice->salesinvoice_identifier}}</th>    
    <th>{{$TaxTypeArray[$i]}}</th>
    
    <th>{{$Salesinvoice->salesinvoice_tnsalesamount}}</th>
    <th>{{$Salesinvoice->salesinvoice_txsalesamount}}</th>
    <th>{{$Salesinvoice->salesinvoice_taxamount}}</th>
    <th>{{$Salesinvoice->salesinvoice_totalamount}}</th>
  </tr>
  @php $i++; @endphp
  @endforeach
   <tr>
    <th colspan="5">合計</th>
    <th>{{$total_tnsalesamount}}</th>
    <th>{{$total_txsalesamount}}</th>
    <th>{{$total_taxamount}}</th>
    <th>{{$total_totalamount}}</th>
  </tr>
  
</table>