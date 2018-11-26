@include('header')
<section id="clogo" class="clogo">
  <div class="container">
    <div class="row">
      <div class="main_clogo sections text-center">
        <div class="head_title text-center">
          <p>&nbsp;</p>
          <h2>現金銷售管理平台</h2>
          <p>&nbsp;</p>
          <div class="separator"></div>
        </div>
        <!-- End off Head_title -->
        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-danger">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價類別設定、其他基本設定等</p>
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
        </div>
        <div class="row">
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
            <div class="panel panel-primary">
              <div class="panel-heading">櫃台作業</div>
              <div class="panel-body">
                <p>進行櫃台結帳作業</p>
              </div>
              <a href="{{url('sales')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">銷貨發票管理</div>
              <div class="panel-body">
                <p>編輯銷貨發票資料</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-yellow">
              <div class="panel-heading">發票配號檔</div>
              <div class="panel-body">
                <p>匯入發票字軌</p>
              </div>
              <a href="{{url('invoice')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-red">
              <div class="panel-heading">發票明細表</div>
              <div class="panel-body">
                <p>顯示發票開立明細表</p>
              </div>
              <a href="{{url('invoice_report')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-green">
              <div class="panel-heading">銷售明細表</div>
              <div class="panel-body">
                <p>顯示銷售狀況明細表</p>
              </div>
              <a href="{{url('sale_report')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
		@if(Session::has('login_err_message'))
			alert("{{ Session::get('login_err_message') }}");
		@endif
</script>