@include('header')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('h2_title')</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            
            <h3 align="center" style="color:#000">@yield('h3_title')</h3>
  
  <p align="center">@yield('createbtn')@show </p>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer"> @yield('listtable')
              {{--清單表格--}}
              <p>&nbsp;</p>
              @show </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

@include('footer') 
<script>
var table1;
var opt={
	   "oLanguage":{"sUrl":"{{url('js/else/dataTables.zh-tw.txt') }}"},
       "bJQueryUI":true,
	   "sPaginationType":"full_numbers",
	   "order": [],
	   "responsive": true
   };
$(document).ready(function(){

	table1=$("#table1").dataTable(opt);
	
	@if($errors->first('delete_error'))
		alert("{{$errors->first('delete_error')}}");
	@endif
	@if($errors->first('edit_error'))
		alert("{{$errors->first('edit_error')}}");
	@endif
});
</script> 
