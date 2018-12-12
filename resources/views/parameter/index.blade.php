@extends('listtable')

@section('h2_title','參數設定')

@section('h3_title','參數清單')

@section('createbtn') <a href="{{url('parameter/create')}}" role="button" class="btn btn-primary btn-lg">新增</a> @endsection

@section('listtable')
<p style="text-align:center">
  @php
  $i=0;
  @endphp
  
  @foreach($ParametersDistinct as $parameterdistinct) <span style="color:#000FFF;cursor:pointer;" onClick="filter('{{$parameterdistinct->parameter_groups}}')">{{$parameterdistinct->parameter_groups}}</span>
  @if($i!=count($ParametersDistinct))
  | 
  @endif
  @php
  $i++;
  @endphp
  @endforeach <span style="color:#000FFF;cursor:pointer;" onClick="filter('')">全部顯示</span></p>
<table width="100%" class="table table-striped table-bordered table-hover" id="table2">
  <thead>
    <tr>
      <th>參數群組</th>
      <th>參數代號</th>
      <th>參數名稱</th>
      <th>參數內容</th>
      <th>功能</th>
    </tr>
  </thead>
  <tbody>
  
  @foreach($Parameters as $parameter)
  <tr>
    <td>{{ $parameter->parameter_groups }}</td>
    <td>{{ $parameter->parameter_code }}</td>
    <td>{{ $parameter->parameter_title }}</td>
    <td style="word-break:break-word;">
    @if($parameter->parameter_code=="invoiceImage")
    <img src='{!!$parameter->parameter_value!!}' width='100'>
    @else
    {{$parameter->parameter_value }}
    @endif
    </td>
    <th> <a href="{{url('parameter/'.$parameter->id.'/edit/')}}" role="button" class="btn btn-warning btn-lg">修改</a>
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

@section('customjs')
<script>
var table2;
$(function(){
var opt={
	   "oLanguage":{"sUrl":"{{url('js/else/dataTables.zh-tw.txt') }}"},
       "bJQueryUI":true,
	   "sPaginationType":"full_numbers",
	   "order": [ [ 0, 'desc' ],[ 1, 'asc' ]],
	   "lengthMenu": [ 20 , 40 , 60 ]
   };
    table2=$("#table2").dataTable(opt);
});

function filter(object){
	if(object){
	table2.fnFilter(object);
	var data = table1._('tr', {"search": "applied"});
	}else {
		table2.fnFilter('');
		var data = table1._('tr', {"search": "applied"});	
	}
}
</script>
@endsection