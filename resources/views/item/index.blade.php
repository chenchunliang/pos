@extends('listtable')

@section('h2_title','貨品設定')

@section('h3_title','貨品清單')

@section('createbtn') <a href="{{url('item/create')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')

<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
  <thead>
    <tr>
      <th>品名</th>
      <th>規格</th>
      <th>條碼</th>
      <th>單位</th>
      <th>稅別</th>
      <th>照片</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($Items as $item)
  <tr>
    <td>{{ $item->item_name }}</td>
    <td>{{ $item->item_specification }}</td>
    <td>{{ $item->item_barcode }}<br>{!!item_barcodeGenerator($item->item_barcode)!!}</td>
    <td>{{ $item->item_unit }}</td>
    <td>{{ $item->item_taxtype }}</td>
    <td><img src='{{ $item->item_image }}'></td>
    <th> <a href="{{url('item/'.$item->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
      <form action="{{url('item/'.$item->id)}}" method="post" id="item_delete_{{$item->id}}" class="deletebtn_form">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="item_delete_{{$item->id}}">刪除</button>
      </form>
    </th>
  </tr>
  @endforeach
    </tbody>
  
</table>
@endsection