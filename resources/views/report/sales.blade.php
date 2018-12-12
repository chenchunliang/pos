@extends('commontable')

@section('h2_title','銷售報表')

@section('commontable')
<form action="{{url('report/sales/print')}}" method="get">
<table width="100%" class="table table-striped table-bordered">
  
    <th width="20%">快捷鍵</th>
    <th width="30%"><button type="button" class="btn btn-info btn-lg date_btn" data-type="1">日結</button>
      <button type="button" class="btn btn-warning btn-lg date_btn" data-type="2">週結</button>
      <button type="button" class="btn btn-danger btn-lg date_btn" data-type="3">月結</button></th>
    <th width="20%">交易日期</th>
    <th width="30%"> <input type="date" name="sd" id="sd" class="form-control" value="{{$weekStart}}">
      <input type="date" name="ed" id="ed"class="form-control" value="{{$weekEnd}}">
    </th>
  </tr>
  <tr>
    <th>客戶群組</th>
    <th><select name="cg" class="form-control">
        <option value="%" selected>全部</option>
        @foreach($customerDistinct as $customer)        
          
        <option value="{{$customer->customer_group}}">{{$customer->customer_group}}</option>
                
        @endforeach
        
      </select>
    </th>
    <th>發票類型</th>
    <th> <label for="radio1">
        <input type="radio" id="radio1" name="i" value="C0401" checked>
        交易發票</label>
      &nbsp;&nbsp;
      <label for="radio2">
        <input type="radio" id="radio2" name="i" value="C0501">
        作廢發票</label></th>
  </tr>
  <tr>
    <th>已下載</th>
    <th><label for="isdownload1">
      <input type="radio" id="isdownload1" name="isdownload" value="1">
      是</label>
  &nbsp;&nbsp;
  <label for="isdownload0">
    <input type="radio" id="isdownload0" name="isdownload" value="0" checked>
    否</label></th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
</table>
<p style="text-align:center">
  <button type="submit" class="btn btn-success btn-lg">下載EXCEL</button>
</p>
@endsection

@section('customjs') 
<script>	
$('.date_btn').click(function() {
	
	switch($(this).data('type')){
		case 1:
			$("#sd").val('{{$today}}');
			$("#ed").val('{{$today}}');
		break;
		case 2:
			$("#sd").val('{{$weekStart}}');
			$("#ed").val('{{$weekEnd}}');
		break;
		case 3:
			$("#sd").val('{{$monthStart}}');
			$("#ed").val('{{$monthEnd}}');
		break;
		default:
			$("#sd").val('{{$today}}');
			$("#ed").val('{{$today}}');
		break;
	}
});
  </script> 
@endsection 