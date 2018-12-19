<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="陳俊良,CCL">

	<meta name="theme-color" content="#009100">
    <link rel="shortcut icon" href="{{url('favicon.ico')}}"/>
    <link rel="bookmark" href="{{url('favicon.ico')}}"/>
    
    <title>現金銷售管理平台</title>

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('vendor/bootstrap/css/bootstrap.min.css')}}

    <!-- MetisMenu CSS -->
    {{ HTML::style('vendor/metisMenu/metisMenu.min.css')}}

	<!-- DataTables CSS -->
	{{ HTML::style('vendor/datatables-plugins/dataTables.bootstrap.css')}}

    <!-- DataTables Responsive CSS -->
    {{ HTML::style('vendor/datatables-responsive/dataTables.responsive.css')}}
    
    <!-- Custom CSS -->
    {{ HTML::style('dist/css/sb-admin-2.css')}}
    
    <!-- Custom Fonts -->
    {{ HTML::style('vendor/font-awesome/css/font-awesome.min.css')}}
    
    <!-- Custom Fonts -->
    {{ HTML::style('css/my.css')}}
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
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
                                    <input class="form-control" placeholder="帳號" name="account" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="密碼" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" type="submit">登入</button></a>
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