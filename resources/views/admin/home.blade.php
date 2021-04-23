@extends('admin.layouts.app')

@section('content')

<title>Dashboard</title>
<div class="main">
  <h2><span class="glyphicon glyphicon-menu-right"></span>&nbsp;Dashboard</h2>
  <ul class="breadcrumb">
    <li><a href="{{url('admin/home')}}">Home</a></li>
  </ul>

  <p style="text-align:center;font-size:55px;">Hello {{auth()->user()->name}}</p>

  </div>

@endsection
