<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <title> View Node Mapping</title>
		<?php require_once "head.php"; ?>
		
		<style>
			table th {font-weight: bold;}

			/*Now the CSS*/
			.tree ul {
				padding-top: 20px; 
			  	position: relative;
				transition: all 0.5s;
				-webkit-transition: all 0.5s;
				-moz-transition: all 0.5s;
			}

			.tree li {
				float: left; text-align: center;
				list-style-type: none;
				position: relative;
				padding: 20px 5px 0 5px;
				transition: all 0.5s;
				-webkit-transition: all 0.5s;
				-moz-transition: all 0.5s;
			}

			/*We will use ::before and ::after to draw the connectors*/

			.tree li::before, .tree li::after{
				content: '';
				position: absolute; top: 0; right: 50%;
				border-top: 1px solid #ccc;
				width: 50%; height: 20px;
			}
			.tree li::after{
				right: auto; left: 50%;
				border-left: 1px solid #ccc;
			}

			/*We need to remove left-right connectors from elements without 
			any siblings*/
			.tree li:only-child::after, .tree li:only-child::before {
				display: none;
			}

			/*Remove space from the top of single children*/
			.tree li:only-child{ padding-top: 0;}

			/*Remove left connector from first child and 
			right connector from last child*/
			.tree li:first-child::before, .tree li:last-child::after{
				border: 0 none;
			}
			/*Adding back the vertical connector to the last nodes*/
			.tree li:last-child::before{
				border-right: 1px solid #ccc;
				border-radius: 0 5px 0 0;
				-webkit-border-radius: 0 5px 0 0;
				-moz-border-radius: 0 5px 0 0;
			}
			.tree li:first-child::after{
				border-radius: 5px 0 0 0;
				-webkit-border-radius: 5px 0 0 0;
				-moz-border-radius: 5px 0 0 0;
			}

			/*Time to add downward connectors from parents*/
			.tree ul ul::before{
				content: '';
				position: absolute; top: 0; left: 50%;
				border-left: 1px solid #ccc;
				width: 0; height: 20px;
			}

			.tree li a{
				border: 1px solid #ccc;
				padding: 5px 10px;
				text-decoration: none;
				color: #666;
				font-family: arial, verdana, tahoma;
				font-size: 11px;
				display: inline-block;
				border-radius: 5px;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				transition: all 0.5s;
				-webkit-transition: all 0.5s;
				-moz-transition: all 0.5s;
			}

			/*Time for some hover effects*/
			/*We will apply the hover effect the the lineage of the element also*/
			.tree li a:hover, .tree li a:hover+ul li a {
				background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
			}
			/*Connector styles on hover*/
			.tree li a:hover+ul li::after, 
			.tree li a:hover+ul li::before, 
			.tree li a:hover+ul::before, 
			.tree li a:hover+ul ul::before{
				border-color:  #94a0b4;
			}
		</style>
</head>
<body class="fixed-sn white-skin">
	<?php require_once "header.php"; ?>
    <main class="bd-masthead" id="content" role="main">
	  	<div class="container">
		</div> 

		<div class="tree" style="margin-bottom: 30%;">
		<ul>
			<li>
				<a href="#">Server</a>
				<ul>

					<!-- Start PHP -->
					<?php require_once "../backend/check.php";?>
					<?php
						include("../backend/config.php");
						$heroes = array(); 
						$sql = "SELECT * FROM nodelink ORDER BY No ASC;";
						$stmt = $conn->prepare($sql);						 
						$stmt->execute();
						$stmt->bind_result($No, $ip, $gateway, $dad, $son);
						while($stmt->fetch()){
							$temp = [
								'No'=>$No,
								'gateway'=>$gateway,
								'ip'=>$ip,
								'dad'=>$dad,
								'son'=>$son
							];
							array_push($heroes, $temp);
						}
						$json = json_encode($heroes);
						// echo $json;
						
						$gw = array();
						$sqlgw = "SELECT DISTINCT Gateway, Son FROM nodelink wHERE dad='' ORDER BY Gateway ASC;";
						//$sqlgw = "SELECT DISTINCT gateway FROM nodelink ORDER BY gateway ASC;";
						$stmt = $conn->prepare($sqlgw);						 
						$stmt->execute();
						$stmt->bind_result($gateway,$son);
						while($stmt->fetch()){
							$temp = [
								'gateway'=>$gateway,
								'son'=>$son
							];
							array_push($gw, $temp);
						}
						$jsongw = json_encode($gw);

						for ($i=0; $i <count($gw) ; $i++) {
							if ($gw[$i]['son'] == 1){ 
								echo "<li><a href='#'>Gateway ".$gw[$i]['gateway']."</a><ul>";
								loopfor($heroes,0,$gw[$i]['gateway'],$gw[$i]['gateway']);
								echo "</ul></li>";
							} else {
								echo "<li><a href='#'>Gateway ".$gw[$i]['gateway']."</a></li>";
							}
						}
						mysqli_close($conn);

						function loopfor($a,$b,$c,$d){
							for ($i=$b; $i < count($a) ; $i++) { 
								if (($c == $a[$i]['dad'])&& ($a[$i]['son'] == 1)) {
									echo "<li><a href='./main.php?gw=".$d."&nd=".$a[$i]['ip']."'>Node ".$a[$i]['ip']."</a><ul>";
									loopfor($a,$b+1, $a[$i]['ip'],$d);	
									echo "</ul></li>";
								} else if (($c == $a[$i]['dad']) && ($a[$i]['son'] == 0)) {
									echo "<li><a href='./main.php?gw=".$d."&nd=".$a[$i]['ip']."'>Node ".$a[$i]['ip']."</a></li>";
									loopfor($a,$b+1, $a[$i]['ip'],$d);	
								}
							}
						}
					?>
					<!-- End PHP -->	

				</ul>
			</li>
		</ul>
		</div>


		<br> 
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
</body>
</html>
