@extends('listtable')

@section('h2_title','參數設定')

@section('h3_title','參數清單')

@section('createbtn')
<a href="{{url('parameter/create')}}" role="button" class="btn btn-primary btn-lg">新增</a>
@endsection

@section('listtable')
<table width="100%" class="table table-striped table-bordered table-hover" id="table1">
      <thead>
        <tr>
          <th>參數代號</th>
          <th>參數名稱</th>
          <th>參數內容</th>
          <th>參數群組</th>
          <th>功能</th>
        </tr>
      </thead>
      <tbody>
      @foreach($Parameters as $parameter)
        <tr>
          <td>{{ $parameter->parameter_code }}</td>
          <td>{{ $parameter->parameter_title }}</td>
          <td>{{ $parameter->parameter_value }}</td>
          <td>{{ $parameter->parameter_groups }}</td>
          <th>
          <a href="{{url('parameter/'.$parameter->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
          <form action="{{url('parameter/'.$parameter->id)}}" method="post" id="parameter_delete_{{$parameter->id}}" class="deletebtn_form">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="button" class="btn btn-danger btn-lg deletebtn" data-formid="parameter_delete_{{$parameter->id}}">刪除</button>
          </form>
        </th>
        </tr>
        @endforeach
      </tbody>
    </table>
   @endsection