

<!DOCTYPE html>
<html>
<head>
      <link rel="stylesheet" href="vendor/mckenziearts/laravel-notify/public/css/notify.css">
		<script>
function goBack() {
  window.history.back();
}
</script>
	<title>Bill</title>
	<style type="text/css">
		
		td{
          text-align: center;

		}
	</style>
</head>
<body>
    @include('notify::messages')
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
<form action="print_bill" method="Post">
@include('bill')
@include('invoice')

</form>
<script src="vendor/mckenziearts/laravel-notify/public/js/notify.js"></script>
</body>
</html>