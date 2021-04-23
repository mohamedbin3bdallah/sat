<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{url('uploads/images/logo.png')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
::selection {
  background: blue !important; /* WebKit/Blink Browsers */
  color: #fff !important;
}
::-moz-selection {
  background: blue !important; /* Gecko Browsers */
  color: #fff !important;
}

body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    padding-top: 20px;
}

.sidenav a {
    padding: 6px 8px 20px 16px;
    text-decoration: none;
    font-size: 13px;
    color: #818181;
    display: block;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.main {
    margin-left: 260px; /* Same as the width of the sidenav */
    font-size: 16px; /* Increased text to enable scrolling */
    padding: 0px 10px;
}

.ul-danger, .li-danger, .ul-success, .li-success, .ul-warning, .li-warning{
	text-align: center;
	padding: 1%;
}
.li-danger {
	list-style: none;
	color: #fff;
	background-color: red;
}
.li-success {
	list-style: none;
	color: #fff;
	background-color: green;
}
.li-warning {
	list-style: none;
	color: #000;
	background-color: #ffc107;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>
<div class="well"></div>
<div class="sidenav">
<br />
<center><img src="{{url('uploads/images/logo.png')}}" width="100"/></center>
<br />
<br />
	<a href="{{url('admin/home')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Dashoard</a>

   <a href="{{url('admin/admins')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Admins</a>

   <a href="{{url('admin/customers')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Customers</a>

   <a href="{{url('admin/companies')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Companies</a>

  <a href="{{url('admin/categories')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Categories</a>

  <a href="{{url('admin/subcategories')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;SubCategories</a>

   <a href="{{url('admin/doctypes')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Document types</a>
   
   <a href="{{url('admin/catdocs')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Category Documents</a>

  <a href="{{url('admin/services/products')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Products</a>

  <a href="{{url('admin/services/solutions')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Solutions</a>

  <a href="{{url('admin/news')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;News</a>

  <a href="{{url('admin/cms')}}"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Content Management</a>
  
  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="glyphicon glyphicon-triangle-right" style="color:white;"></span>&nbsp;Logout</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
</div>

@yield('content')

<script src="{{asset('resources/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('resources/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
	$('label').css('display','block');
	$("select").removeClass("custom-select");
} );
</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>
</html>
