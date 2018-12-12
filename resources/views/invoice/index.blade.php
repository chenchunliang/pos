@extends('listtable')

@section('h2_title','發票設定')

@section('h3_title','發票清單')

@section('createbtn') <a href="{{url('invoice/create')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')

<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
  <thead>
    <tr>
      <th>發票起始月份</th>
      <th>發票結束月份</th>
      <th>發票字軌</th>
      <th>發票起始號碼</th>
      <th>發票結束號碼</th>
      <th>發票目前號碼</th>
      <th>空白發票匯出</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($Invoices as $invoice)
  <tr>
    <td>{{ $invoice->invoice_startmonth }}</td>
    <td>{{ $invoice->invoice_endmonth }}</td>
    <td>{{ $invoice->invoice_wordtrack }}</td>
    <td>{{ $invoice->invoice_startnumber }}</td>
    <td>{{ $invoice->invoice_endnumber }}</td>
    <td>{{ $invoice->invoice_currentnumber }}</td>
    <td>{{ $invoice->invoice_emptynumber?"是":"無" }}</td>
    <th> <a href="{{url('invoice/'.$invoice->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
      <form action="{{url('invoice/'.$invoice->id)}}" method="post" id="invoice_delete_{{$invoice->id}}" class="deletebtn_form">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="invoice_delete_{{$invoice->id}}">刪除</button>
      </form>
    </th>
  </tr>
  @endforeach
    </tbody>
  
</table>
@endsection