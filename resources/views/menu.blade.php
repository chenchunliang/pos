@include('header') 

<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">現金銷售管理平台</h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- /.container-fluid -->
  <div class="row">
    <div class="col-lg-12">
      <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">櫃台作業</div>
              <div class="panel-body">
                <p>進行櫃台結帳作業</p>
              </div>
              <a href="{{url('salesinvoice/sales')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-yellow">
              <div class="panel-heading">銷貨發票管理</div>
              <div class="panel-body">
                <p>編輯銷貨發票資料</p>
              </div>
              <a href="{{url('salesinvoice')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-blue">
              <div class="panel-heading">作廢發票管理</div>
              <div class="panel-body">
                <p>作廢發票</p>
              </div>
              <a href="{{url('invalidinvoice')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-green">
              <div class="panel-heading">銷售報表</div>
              <div class="panel-body">
                <p>顯示銷售明細、發票明細、匯總表</p>
              </div>
              <a href="{{url('report/sales')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-red">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人、售價類別、其他設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
        <div class="col-lg-4">
          <div class="panel panel-success">
            <div class="panel-heading">貨品設定</div>
            <div class="panel-body">
              <p>編輯品項、售價、圖片等資料</p>
            </div>
            <a href="{{url('item')}}">
            <div class="panel-footer">前往</div>
            </a> </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-info">
            <div class="panel-heading">櫃台目錄設定</div>
            <div class="panel-body">
              <p>編輯櫃台分類、品項設定等</p>
            </div>
            <a href="{{url('catalog')}}">
            <div class="panel-footer">前往</div>
            </a> </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-warning">
            <div class="panel-heading">客戶設定</div>
            <div class="panel-body">
              <p>編輯客戶資料、統編等</p>
            </div>
            <a href="{{url('customer')}}">
            <div class="panel-footer">前往</div>
            </a> </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-danger">
            <div class="panel-heading">發票設定</div>
            <div class="panel-body">
              <p>匯入發票字軌與匯出空白發票</p>
            </div>
            <a href="{{url('invoice')}}">
            <div class="panel-footer">前往</div>
            </a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- /#page-wrapper --> 

@include('footer') 
<script>
		@if(Session::has('login_err_message'))
			alert("{{ Session::get('login_err_message') }}");
		@endif
</script>