<div style="padding:3%">
  <h3>品項明細</h3>
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>品項</th>
        <th>數量</th>
        <th>單價</th>
      </tr>
    </thead>
    <tbody>
    @foreach(json_decode($Salesinvoice->salesinvoice_productarray) as $productArray)
    <tr>
      <td align="center">{{ $productArray->ProductName }}</td>
      <td align="center">{{ $productArray->ProductQty }}</td>
      <td align="center">{{ number_format($productArray->ProductAmount,1) }}</td>
    </tr>
    @endforeach
    </tbody>
    
  </table>
  <div align="right">
      <p>免稅銷售額：{{ number_format($Salesinvoice->salesinvoice_tnsalesamount) }}</p>
      <p>應稅銷售額：{{ number_format($Salesinvoice->salesinvoice_txsalesamount) }}</p>
      <p>稅額：{{ number_format($Salesinvoice->salesinvoice_taxamount) }}</p>
      <p>總金額：{{ number_format($Salesinvoice->salesinvoice_totalamount) }}</p>
  </div>
  <p>訂單備註：</p>
  <p>{{ $Salesinvoice->salesinvoice_remark?$Salesinvoice->salesinvoice_remark:'無' }}</p>
</div>
