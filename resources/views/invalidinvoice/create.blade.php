@extends('commontable')

@section('h2_title','作廢發票設定')

@section('h3_title','新增作廢發票')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('invalidinvoice')}}">
  {{csrf_field()}}
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>作廢發票號碼</th>
        <td align="center">
        <select name="salesinvoice_id" class="form-control" style="width:100%">
         @if(count($Salesinvoices)==0)
         <option value="">無</option>
         @endif
        @foreach($Salesinvoices as $Salesinvoice)
          <option value="{{$Salesinvoice->id}}">{{ '【'.$Salesinvoice->salesinvoice_invoicenumber.'】 '.str_replace('-','/',$Salesinvoice->salesinvoice_date).' '.$Salesinvoice->customer->customer_name.'   總金額'.number_format($Salesinvoice->salesinvoice_totalamount).'元 '.(($Salesinvoice->salesinvoice_remark && $Salesinvoice->salesinvoice_remark!='無')?$Salesinvoice->salesinvoice_remark:'') }}</option>
        @endforeach
        </select>
          @if($errors->has('salesinvoice_id'))
          <p style="color:red">請選擇發票</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>作廢發票原因</th>
        <td align="center"><input type="text" class="form-control" name="invalidinvoice_invalidreason" value="{{old('invalidinvoice_invalidreason')}}" style="width:100%">
          @if($errors->has('invalidinvoice_invalidreason'))
          <p style="color:red">請輸入作廢原因</p>
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