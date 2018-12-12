@extends('listtable')

@section('h2_title','作廢發票設定')

@section('h3_title','作廢發票清單')

@section('createbtn') <a href="{{url('invalidinvoice/create')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')

<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
  <thead>
    <tr>
      <th>作廢發票號碼</th>
      <th>發票開立時間</th>
      <th>作廢發票時間</th>
      <th>作廢發票原因</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  @foreach($Invalidinvoices as $invalidinvoice)
  <tr>
    <td>{{ $invalidinvoice->salesinvoice->salesinvoice_invoicenumber }}</td>
    <td>{{ $invalidinvoice->salesinvoice->salesinvoice_date }}<br>{{ $invalidinvoice->salesinvoice->salesinvoice_time }}</td>
    <td>{{ $invalidinvoice->invalidinvoice_invaliddate }}<br>{{ $invalidinvoice->invalidinvoice_invalidtime }}</td>
    <td>{{ $invalidinvoice->invalidinvoice_invalidreason }}</td>
    <th> <a href="{{url('invalidinvoice/'.$invalidinvoice->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
      <form action="{{url('invalidinvoice/'.$invalidinvoice->id)}}" method="post" id="invalidinvoice_delete_{{$invalidinvoice->id}}" class="deletebtn_form">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="invalidinvoice_delete_{{$invalidinvoice->id}}">刪除</button>
      </form>
    </th>
  </tr>
  @endforeach
    </tbody>
  
</table>
@endsection