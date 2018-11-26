@extends('commontable')

@section('h2_title','參數設定')

@section('h3_title','編輯參數')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('parameter/'.$Parameter->id)}}">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <table width="100%" class="table table-striped table-bordered table-hover" id="table1">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>參數群組</th>
        <td align="center"><input type="text" class="datafield form-control" list="parameter_groups" name="parameter_groups" value="{{$Parameter->parameter_groups}}">
          @if($errors->has('parameter_groups'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數代號</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_code" value="{{$Parameter->parameter_code}}">
          @if($errors->has('parameter_code'))
          <p style="color:red">請至少輸入1個字</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數名稱</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_title" value="{{$Parameter->parameter_title}}">
          @if($errors->has('parameter_title'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數內容</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_value" value="{{$Parameter->parameter_value}}">
          @if($errors->has('parameter_value'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
    </tbody>
  </table>
  <p>&nbsp;</p>
  <p style="text-align:center">
    <input type="submit" name="submit" class="btn btn-lg" value="儲存">
  </p>
</form>
<p>&nbsp;</p>
@endsection

<datalist id="parameter_groups">
@foreach($ParametersDistinct as $parameterdistinct)
<option>{{$parameterdistinct->parameter_groups}}</option>
@endforeach
</datalist>