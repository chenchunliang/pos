@extends('listtable')

@section('h2_title','銷貨發票管理')

@section('h3_title','銷貨發票清單')

@section('createbtn') <a href="{{url('salesinvoice/sales')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')

<meta name="csrf-token" content="{{ csrf_token() }}">

<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
  <thead>
    <tr>
      <th>發票號碼 (隨機碼)</th>
      <th>發票時間</th>
      <th>買方統編</th>
      <th>發票總金額</th>
      <th>狀態</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($Salesinvoices as $salesinvoice)
  <tr>
    <td>{{ $salesinvoice->salesinvoice_invoicenumber.' ('.$salesinvoice->salesinvoice_randomnumber.')' }}</td>
    <td>{{ $salesinvoice->salesinvoice_date }}<br>
      {{ $salesinvoice->salesinvoice_time }}</td>
    <td>{{ $salesinvoice->customer->customer_name }}<br>
      {{ $salesinvoice->salesinvoice_identifier }}</td>
    <td style="text-align:right">
      <p>免稅銷售額：{{ number_format($salesinvoice->salesinvoice_tnsalesamount) }}</p>
      <p>應稅銷售額：{{ number_format($salesinvoice->salesinvoice_txsalesamount) }}</p>
      <p>稅額：{{ number_format($salesinvoice->salesinvoice_taxamount) }}</p>
      <p>總金額：{{ number_format($salesinvoice->salesinvoice_totalamount) }}</p>
    </td>
    <td>
      <p class="{{ $salesinvoice->salesinvoice_printstate?'font_green':'' }}">列印：{{ $salesinvoice->salesinvoice_printstate?'V':'X' }}</p>
      <p class="{{ $salesinvoice->salesinvoice_C0401state?'font_green':'' }}">上傳開立：{{ $salesinvoice->salesinvoice_C0401state?'V':'X' }}</p>
      <p class="{{ $salesinvoice->salesinvoice_invalidstate?'font_green':'' }}">作廢：{{ $salesinvoice->salesinvoice_invalidstate?'V':'X' }}</p>
      <p class="{{ $salesinvoice->salesinvoice_C0501state?'font_green':'' }}">上傳作廢：{{ $salesinvoice->salesinvoice_C0501state?'V':'X' }}</p>
      <p class="{{ $salesinvoice->salesinvoice_isdownload?'font_green':'' }}">下載狀態：{{ $salesinvoice->salesinvoice_isdownload?'V':'X' }}</p>
    </td>
    <th>
    <button type="button" class="btn btn-default btn-lg product_detail" data-toggle="modal" data-target="#myModal" data-sid="{{$salesinvoice->id}}">查看品項明細</button>
      <br>
      <p><a href="{{url('salesinvoice/show/'.$salesinvoice->id.'/type/2')}}" role="button" class="btn btn-info btn-lg" target="_blank">重印</a>
      <a href="{{url('salesinvoice/show/'.$salesinvoice->id.'/type/3')}}" role="button" class="btn btn-success btn-lg" target="_blank">補印</a>
      </p>
      <a href="{{url('salesinvoice/'.$salesinvoice->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
      <form action="{{url('salesinvoice/'.$salesinvoice->id)}}" method="post" id="salesinvoice_delete_{{$salesinvoice->id}}" class="deletebtn_form">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="salesinvoice_delete_{{$salesinvoice->id}}">刪除</button>
      </form>
    </th>
  </tr>
  @endforeach
    </tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content"></div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
@endsection

@section('customjs') 
<script>
$('.product_detail').click(function(e) {
	
	var sid = $(this).data('sid');
	//console.log(sid);
	$('#myModal').modal({
		show: false,
		remote: "{{url('salesinvoice/display_detail')}}/"+sid,
	});
});

$("#myModal").on('hidden.bs.modal', function () {
    $(this).data('bs.modal', null);
});
</script> 
@endsection