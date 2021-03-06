@extends('commontable')

@section('h2_title','貨品設定')

@section('h3_title','編輯貨品')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('item/'.$Item->id)}}">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
    	<th style="width:30%">項目</th>
      	<th style="width:70%">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>品項名稱</th>
        <td align="center"><input type="text" class="form-control" name="item_name" value="{{$Item->item_name}}">
          @if($errors->has('item_name'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>品項規格</th>
        <td align="center"><input type="text" class="form-control" name="item_specification" value="{{$Item->item_specification}}">
          @if($errors->has('item_specification'))
          <p style="color:red">請至少輸入1個字</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>品項條碼</th>
        <td align="center"><input type="text" class="form-control" name="item_barcode" value="{{$Item->item_barcode}}"><br>*應有13碼
          @if($errors->has('item_barcode'))
          <p style="color:red">請輸入條碼</p>
          @endif
          </td>
      </tr>
      
      @php
      	$i=1;
      @endphp
      
      @foreach($Parameters as $Parameter)   
      
      @php
      	$item_unitprice='item_unitprice'.$i;
      @endphp
      <tr>
        <th>售價{{$text[$i]}} ({{$Parameter->parameter_value?$Parameter->parameter_value:"未定義"}})</th>
        <td align="center"><input type="number" class="form-control" name="item_unitprice{{$i}}" value='{{$Item->$item_unitprice}}'>
          @if($errors->has('item_unitprice'.$i))
          <p style="color:red">請輸入價格</p>
          @endif
        </td>
      </tr>
      
     @php $i++; @endphp
     @endforeach
     
      <tr>
        <th>品項單位</th>
        <td align="center"><input type="text" class="form-control" name="item_unit" value="{{$Item->item_unit}}">
          @if($errors->has('item_unit'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>品項稅別</th>
        <td align="center">
          <label>
            <input type="radio" name="item_taxtype" id="item_taxtype_1" value="1" @if($Item->item_taxtype=='1') checked @endif>
            免稅</label>&nbsp;&nbsp;
          <label>
            <input type="radio" name="item_taxtype" id="item_taxtype_2" value="2" @if($Item->item_taxtype=='2') checked @endif>
            應稅內含</label>
          @if($errors->has('item_taxtype'))
          <p style="color:red">請至少選擇1個項目</p>
          @endif
        </td>
      </tr>
      <tr>
        <th>品項圖片</th>
        <td align="center">
        <p>已上傳：</p>
        <img src="{!!$Item->item_image!!}" width="100">
        <p>建議大小：55px*55px</p>
        <label for="input_img" class="form-control" style="width:200px"> <i class="fa fa-cloud-upload"></i>&nbsp;選擇新照片</label>
        <input id="input_img" type="file" accept="image/*">
          @if($errors->has('item_image'))
          <p style="color:red">請上傳照片</p>
          @endif
        <input type="hidden" name="item_image" id="item_image">
          </td>
      </tr>
    </tbody>
  </table>
  <p style="text-align:center">
    <input type="submit" name="submit" class="btn btn-lg" value="儲存">
  </p>
</form>
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
		  $('#item_image').val(e.target.result);
		});
	}
}

$("#input_img").change(function(){
	//console.log('item_img change');
	readFile($(this));
});
</script>
@endsection