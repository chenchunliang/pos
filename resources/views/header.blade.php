<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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