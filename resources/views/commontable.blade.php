@include('header')
<div style="padding:0% 5% 0% 5%">
  <div class="section-title text-center">
    <h2>@yield('h2_title')</h2>
  </div>
  <p>&nbsp;</p>
  <h3 align="center" style="color:#000">@yield('h3_title')</h3>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"> @yield('commontable')
            {{--清單表格--}}
            <p>&nbsp;</p>
            @show </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('footer') 
<script>
var opt={
	   "oLanguage":{"sUrl":"{{url('js/else/dataTables.zh-tw.txt') }}"},
       "bJQueryUI":true,
	   "sPaginationType":"full_numbers",
	   "order": [],
	   "responsive": true
   };
$(document).ready(function(){
	$("#table1").dataTable(opt);
	
	
	@if($errors->first('store_error'))
		alert("{{$errors->first('store_error')}}");
	@endif
});
</script>