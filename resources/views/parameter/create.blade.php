@extends('commontable')

@section('h2_title','參數設定')

@section('h3_title','新增參數')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('parameter')}}">
  {{csrf_field()}}
  <table width="100%" class="table table-striped table-bordered table-hover" id="table1">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>參數代號</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_code" value="{{old('parameter_code')}}">
          @if($errors->has('parameter_code'))
          <p style="color:red">請至少輸入1個字</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數名稱</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_title" value="{{old('parameter_title')}}">
          @if($errors->has('parameter_title'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數內容</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_value" value="{{old('parameter_value')}}">
          @if($errors->has('parameter_value'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數群組</th>
        <td align="center"><input type="text" class="datafield form-control" name="parameter_groups" value="{{old('parameter_groups')}}">
          @if($errors->has('parameter_groups'))
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

