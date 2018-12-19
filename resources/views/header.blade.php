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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('menu')}}">管理平台</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				<li><a href="{{url('logout')}}"><i class="fa fa-sign-out fa-fw"></i>登出</a>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{url('menu')}}"><i class="fa fa-dashboard fa-fw"></i>主選單</a>
                        </li>
                        <li>
                            <a href="{{url('salesinvoice/sales')}}"><i class="fa fa-dashboard fa-fw"></i>櫃台作業</a>
                        </li>
                        <li>
                            <a href="{{url('salesinvoice')}}"><i class="fa fa-dashboard fa-fw"></i>銷貨發票管理</a>
                        </li>
                        <li>
                            <a href="{{url('invalidinvoice')}}"><i class="fa fa-dashboard fa-fw"></i>作廢發票管理</a>
                        </li>
                        <li>
                            <a href="{{url('report/sales')}}"><i class="fa fa-dashboard fa-fw"></i>銷售報表</a>
                        </li>
                        <li>
                            <a href="{{url('parameter')}}"><i class="fa fa-dashboard fa-fw"></i>基本參數設定</a>
                        </li>
                        <li>
                            <a href="{{url('item')}}"><i class="fa fa-dashboard fa-fw"></i>貨品設定</a>
                        </li>
                        <li>
                            <a href="{{url('catalog')}}"><i class="fa fa-dashboard fa-fw"></i>櫃台目錄設定</a>
                        </li>
                        <li>
                            <a href="{{url('customer')}}"><i class="fa fa-dashboard fa-fw"></i>客戶設定</a>
                        </li>                        
                        <li>
                            <a href="{{url('invoice')}}"><i class="fa fa-dashboard fa-fw"></i>發票設定</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>