@extends('commontable')

@section('h2_title','櫃台目錄設定')

@section('h3_title','新增櫃台目錄')

@section('commontable')
<form id="form1" name="form1" method="post" action="{{url('catalog')}}">
  {{csrf_field()}}
  <table width="100%" class="table table-striped table-bordered table-hover">
    <thead>
    	<th style="width:20%">項目</th>
      	<th style="width:80%" colspan="4">內容</th>
    </thead>
    <tbody>
      <tr>
        <th>櫃台順位</th>
        <td align="center" colspan="4"><input type="number" min="1" class="form-control" name="catalog_orders" value="{{old('catalog_orders')}}">
          @if($errors->has('catalog_orders'))
          <p style="color:red">請至少輸入1個</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>櫃台名稱</th>
        <td align="center" colspan="4"><input type="text" class="form-control" name="catalog_name" value="{{old('catalog_name')}}">
          @if($errors->has('catalog_name'))
          <p style="color:red">請至少輸入1個字</p>
          @endif
          </td>
      </tr>
      <tr>
        <th>是否啟用</th>
        <td align="center" colspan="4">
        <label style="font-size: 16px;font-weight:normal"><input type="checkbox" class="form-control" name="catalog_display" value="1" {{old('catalog_display')?"checked":""}} style="width:20px;margin:0">&nbsp;是</label>
          @if($errors->has('catalog_display'))
          <p style="color:red">請至少輸入1個字元</p>
          @endif
          </td>
      </tr>
      <tr>
        <th colspan="5">櫃台品項</th>
      </tr>
      @for($i=1;$i<=8;$i++)
      <tr>
       	@for($j=1;$j<=5;$j++)
        <td style="text-align:center;width:20%">{{$i.'-'.$j}}&nbsp;&nbsp;
        <select class="form-control" name="position[{{$i}}][{{$j}}]">
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