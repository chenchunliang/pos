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
            <div class="panel panel-primary">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-success">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-info">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-warning">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-danger">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-green">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-yellow">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-red">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
          <div class="col-lg-4">
            <div class="panel panel-default">
              <div class="panel-heading">基本參數設定</div>
              <div class="panel-body">
                <p>編輯營業人資料、售價設定、其他基本設定等</p>
              </div>
              <a href="{{url('parameter')}}">
              <div class="panel-footer">前往</div>
              </a> </div>
          </div>
        </div>
        <div class="col-sm-4 col-xs-6"> </div>
        <div class="col-sm-4 col-xs-6"> <a href="{{url('farmers')}}">農友維護</a> </div>
        <div class="col-sm-4 col-xs-6"> <a href="{{url('environments')}}">環境維護</a> </div>
        <div class="col-sm-4 col-xs-6"> <a href="{{url('batchs')}}">批號維護</a> </div>
        <div class="col-sm-4 col-xs-6"> <a href="{{url('reports')}}">報告維護</a> </div>
        <div class="col-sm-4 col-xs-6"> <a href="{{url('lists')}}">管理員維護</a> </div>
      </div>
    </div>
  </div>
</section>
<script>
		@if(Session::has('login_err_message'))
			alert("{{ Session::get('login_err_message') }}");
		@endif
</script>