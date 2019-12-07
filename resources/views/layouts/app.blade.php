
<?php 


use App\Http\Controllers\brokerController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\ledgerController;
?>

<!DOCTYPE html>
<html>
<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Transport ledger | {{ config('app.name', 'Land connect') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="public/bower_components/morris.js/morris.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="public/dist/css/skins/_all-skins.min.css">
  @include('layout.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('layout.header')
  <!-- Left side column. contains the logo and sidebar -->
@include('layout.sidenav')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ config('app.name', 'Land connect') }}</li>
      </ol>
    </section>
    @guest

    @else
<!-- Main content -->


   @if (session()->has('alert-success'))
             <script language="javascript">       
            alert("{{session()->get('alert-success')}}");          
            </script>
            @endif
             @if (session()->has('alert-danger'))
             <script language="javascript">       
            alert("{{session()->get('alert-danger')}}");          
            </script>
            @endif
 @yield('content')

 @endguest
