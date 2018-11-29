@extends('commontable')

@section('h2_title','發票設定')

@section('h3_title','新增發票')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('invoice')}}">
  {{csrf_field()}}
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>發票起始月份</th>
        <td align="center"><input type="text" class="form-control" name="invoice_startmonth" value="{{old('invoice_startmonth')}}">
          @if($errors->has('invoice_startmonth'))
          <p style="color:red">請輸入月份</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>發票結束月份</th>
        <td align="center"><input type="text" class="form-control" name="invoice_endmonth" value="{{old('invoice_endmonth')}}">
          @if($errors->has('invoice_endmonth'))
          <p style="color:red">請輸入月份</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>發票字軌</th>
        <td align="center"><input type="text" class="form-control" name="invoice_wordtrack" value="{{old('invoice_wordtrack')}}">
          @if($errors->has('invoice_wordtrack'))
          <p style="color:red">請輸入字軌</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>發票起始號碼</th>
        <td align="center"><input type="text" class="form-control" name="invoice_startnumber" value="{{old('invoice_startnumber')}}">
          @if($errors->has('invoice_startnumber'))
          <p style="color:red">請輸入號碼</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>發票結束號碼</th>
        <td align="center"><input type="text" class="form-control" name="invoice_endnumber" value="{{old('invoice_endnumber')}}">
          @if($errors->has('invoice_endnumber'))
          <p style="color:red">請輸入號碼</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>發票目前號碼</th>
        <td align="center"><input type="text" class="form-control" name="invoice_currentnumber" value="{{old('invoice_currentnumber')}}">
          @if($errors->has('invoice_currentnumber'))
          <p style="color:red">請輸入號碼</p>
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