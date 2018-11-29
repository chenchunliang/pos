@extends('commontable')

@section('h2_title','客戶設定')

@section('h3_title','新增客戶')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('customer')}}">
  {{csrf_field()}}
  <table width="100%" class="table table-striped table-bordered table-hover" id="table1">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>客戶名稱</th>
        <td align="center"><input type="text" class="form-control" name="customer_name" value="{{old('customer_name')}}">
          @if($errors->has('customer_name'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>客戶統編</th>
        <td align="center"><input type="text" class="form-control" name="customer_identifier" value="{{old('customer_identifier')}}"></td>
      </tr>
      <tr>
        <th>備註</th>
        <td align="center"><input type="text" class="form-control" name="customer_remark" value="{{old('customer_remark')}}">
          @if($errors->has('customer_remark'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
    </tbody>
  </table>
  <p style="text-align:center">
    <input type="submit" name="submit" class="btn btn-lg" value="儲存">
  </p>
</form>
@endsection