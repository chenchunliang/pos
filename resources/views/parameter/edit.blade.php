@extends('commontable')

@section('h2_title','參數設定')

@section('h3_title','編輯參數')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('parameter/'.$Parameter->id)}}">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>參數群組</th>
        <td align="center"><input type="text" class="form-control" list="parameter_groups" name="parameter_groups" value="{{$Parameter->parameter_groups}}">
          @if($errors->has('parameter_groups'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數代號</th>
        <td align="center"><input type="text" class="form-control" name="parameter_code" value="{{$Parameter->parameter_code}}">
          @if($errors->has('parameter_code'))
          <p style="color:red">請至少輸入1個字</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數名稱</th>
        <td align="center"><input type="text" class="form-control" name="parameter_title" value="{{$Parameter->parameter_title}}">
          @if($errors->has('parameter_title'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>參數內容</th>
        <td align="center">
         @if($Parameter->parameter_code=="invoiceImage")
            <p>已上傳：</p>
            <img src="{!!$Parameter->parameter_value!!}" width="100">
            <p>建議大小：55px*55px</p>
            <label for="input_img" class="form-control" style="width:200px"> <i class="fa fa-cloud-upload"></i>&nbsp;選擇新照片</label>
            <input id="input_img" type="file" accept="image/*">
              @if($errors->has('item_image'))
              <p style="color:red">請上傳照片</p>
              @endif
            <input type="hidden" name="parameter_value" id="parameter_value">
            
         @else
         
         <textarea name="parameter_value" rows="5" class="form-control">{{$Parameter->parameter_value}}</textarea>
          @if($errors->has('parameter_value'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
            
         @endif
          </td>
      </tr>
    </tbody>
  </table>
  <p style="text-align:center">
    <input type="submit" name="submit" class="btn btn-lg" value="儲存">
  </p>
</form>

<datalist id="parameter_groups">
@foreach($ParametersDistinct as $parameterdistinct)
<option>{{$parameterdistinct->parameter_groups}}</option>
@endforeach
</datalist>

@endsection

@section('customjs')
<script>
function readFile(outerfile) {
	//console.log('readFile');
	if (outerfile[0].files && outerfile[0].files[0]) {
		var FR= new FileReader();
		FR.readAsDataURL( outerfile[0].files[0] );
		
		FR.addEventListener("load", function(e) {
		  console.log(e.target.result);
		  $('#parameter_value').val(e.target.result);
		});
	}
}

$("#input_img").change(function(){
	//console.log('item_img change');
	readFile($(this));
});
</script>
@endsection