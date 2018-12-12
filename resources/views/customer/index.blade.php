@extends('listtable')

@section('h2_title','客戶設定')

@section('h3_title','客戶清單')

@section('createbtn') <a href="{{url('customer/create')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')

<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
  <thead>
    <tr>
      <th>客戶群組</th>
      <th>客戶名稱</th>
      <th>客戶統編</th>
      <th>備註</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($Customers as $customer)
  <tr>
    <td>{{ $customer->customer_group }}</td>
    <td>{{ $customer->customer_name }}</td>
    <td>{{ $customer->customer_identifier?$customer->customer_identifier:"無" }}</td>
    <td>{{ $customer->customer_remark?$customer->customer_remark:"無" }}</td>
    <th> <a href="{{url('customer/'.$customer->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
      <form action="{{url('customer/'.$customer->id)}}" method="post" id="customer_delete_{{$customer->id}}" class="deletebtn_form">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="customer_delete_{{$customer->id}}">刪除</button>
      </form>
    </th>
  </tr>
  @endforeach
    </tbody>
  
</table>
@endsection