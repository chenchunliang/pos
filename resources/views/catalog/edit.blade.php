@extends('commontable')

@section('h2_title','櫃台目錄設定')

@section('h3_title','編輯櫃台目錄')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('catalog/'.$Catalog->id)}}">
  {{csrf_field()}}
  {{method_field('PUT')}}
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
    	<th style="width:20%">項目</th>
      	<th style="width:80%" colspan="4">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>櫃台順位</th>
        <td align="center" colspan="4"><input type="number" min="1" class="form-control" name="catalog_orders" value="{{$Catalog->catalog_orders}}">
          @if($errors->has('catalog_orders'))
          <p style="color:red">請至少輸入1個</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>櫃台名稱</th>
        <td align="center" colspan="4"><input type="text" class="form-control" name="catalog_name" value="{{$Catalog->catalog_name}}">
          @if($errors->has('catalog_name'))
          <p style="color:red">請至少輸入1個字</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>是否啟用</th>
        <td align="center" colspan="4">
        <label style="font-size: 16px;font-weight:normal"><input type="checkbox" class="form-control" name="catalog_display" value="1" {{$Catalog->catalog_display?"checked":""}} style="width:20px;margin:0">&nbsp;是</label>
          @if($errors->has('catalog_display'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th colspan="5">櫃台品項</th>
      </tr>
      @php
      $m=0;
      @endphp
      
      @for($y=1;$y<=8;$y++)
      <tr>
       	@for($x=1;$x<=5;$x++)
        <td style="text-align:center;width:20%">{{$y.'-'.$x}}&nbsp;&nbsp;
        <input type="hidden" name="position_id[{{$y}}][{{$x}}]" id="position_id_{{$y.'_'.$x}}">
        <select class="form-control" name="position[{{$y}}][{{$x}}]" id="position_{{$y.'_'.$x}}">
        <option value="">無</option>
        @foreach($Items as $Item)
        <option value="{{$Item->id}}">{{$Item->item_name}}</option>
        @endforeach
        </select>
        </td>
        @endfor
      </tr>
    @endfor
    </tbody>
  </table>
  <p style="text-align:center">
    <input type="submit" name="submit" class="btn btn-lg" value="儲存">
  </p>
</form>
@endsection

@section('customjs')
<script>
@foreach($positionArray as $position)
	$("#position_{{$position->position_y.'_'.$position->position_x}}").css('background','#e4f1fb');
	$("#position_{{$position->position_y.'_'.$position->position_x}} option[value={{$position->item_id}}]").prop('selected',true)
	$("#position_id_{{$position->position_y.'_'.$position->position_x}}").val({{$position->id}})
@endforeach
</script>
@endsection