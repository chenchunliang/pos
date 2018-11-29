@extends('listtable')

@section('h2_title','櫃台目錄設定')

@section('h3_title','目錄清單')

@section('createbtn') <a href="{{url('catalog/create')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')

<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
  <thead>
    <tr>
      <th>目錄順位</th>
      <th>目錄名稱</th>
      <th>是否啟用</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($Catalogs as $catalog)
  <tr>
    <td>{{ $catalog->catalog_orders }}</td>
    <td>{{ $catalog->catalog_name }}</td>
    <td>{{ $catalog->catalog_display==1?"是":"否" }}</td>
    <th><a href="{{url('catalog/'.$catalog->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
      <form action="{{url('catalog/'.$catalog->id)}}" method="post" id="catalog_delete_{{$catalog->id}}" class="deletebtn_form">
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="catalog_delete_{{$catalog->id}}">刪除</button>
      </form>
    </th>
  </tr>
  @endforeach
    </tbody>
  
</table>
@endsection