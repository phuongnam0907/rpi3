<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title> View Database</title>
	 	<?php require_once "head.php"; ?>
		
		<style>
			table th {font-weight: bold;}
		</style>
</head>
<body class="fixed-sn white-skin">
	<?php require_once "header.php"; ?>
    <main class="bd-masthead" id="content" role="main">
	  <div class="container">
		<div style="border: 1px solid black;" name="datatable" id="datatable">
			<table class="table table-bordered table-striped" style="text-align:center" id="sensor_table">
				<tr>
					<th>No</th>
					<th>Gateway</th>
					<th>ID</th>
					<th>pH</th>
					<th>Temperature</th>
					<th>Liquid</th>
					<th>DO</th>
					<th>TDS</th>
					<th>ORP</th>
					<th>Time</th>
				</tr>
			</table>
		</div>
	  </div>
	</main>
	<?php require_once "footer.php";?>
	<script src="../script/canvasjs.min.js"></script>
	<script defer src="../font/js/all.js"></script>
	<script src="../script/jquery-3.2.1.slim.min.js"></script>
	<script src="../script/jquery-3.3.1.min.js"></script>
	<script src="../script/mbd.min.js"></script>
	<script src="../script/popper.min.js"></script>
	<script src="../script/bootstrap.min.js"></script>	
	<script>

         // SideNav Initialization
        $(".button-collapse").sideNav();
        
        new WOW().init();
    
    </script>
	
	<script>
	$(document).ready(function(){
		$.getJSON("../backend/getdata.php",function(datas){
			var Sd = '';
			$.each(datas, function(key, value){
				Sd += '<tr>';
				Sd += '<td>'+value.id+'</td>';
				Sd += '<td>'+value.Gateway+'</td>';
				Sd += '<td>'+value.Node+'</td>';
				Sd += '<td>'+value.phValue+'</td>';
				Sd += '<td>'+value.tempValue+'&#8451</td>';
				Sd += '<td>'+value.liqValue+'%</td>';
				Sd += '<td>'+value.doValue+'%</td>';
				Sd += '<td>'+value.tdsValue+' ppm</td>';
				Sd += '<td>'+value.orpValue+' mV</td>';
				Sd += '<td>'+value.time+'</td>';
				Sd += '</tr>';
			});
			$('#sensor_table').append(Sd);
		});
	});
	</script>
</body>
</html>