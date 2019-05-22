<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="UTF-8">
        <title> View Node Mapping</title>
		<?php require_once "head.php"; ?>
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
						<th>IP Address</th>
						<th>Dad Node</th>
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
		$.getJSON("../backend/getmap.php",function(datas){
			var Sd = '';
			$.each(datas, function(key, value){
				Sd += '<tr>';
				Sd += '<td>'+value.No+'</td>';
				Sd += '<td>'+value.gateway+'</td>';
				Sd += '<td>'+value.ip+'</td>';
				Sd += '<td>'+value.dad+'</td>';
				Sd += '</tr>';
			});
			$('#sensor_table').append(Sd);
		});
	});
	</script>
</body>
</html>