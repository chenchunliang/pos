@include('header')

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">登入管理平台</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{url('login')}}" method="post" id="form1">
                        {{csrf_field()}}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="帳號" name="account" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密碼" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="javascript:$('#form1').submit()" class="btn btn-lg btn-success btn-block">登入</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
		@if(Session::has('login_err_message'))
			alert("{{ Session::get('login_err_message') }}");
		@endif
</script>

@include('footer')