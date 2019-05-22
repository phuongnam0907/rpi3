<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
    <title> Show Data</title>
	<?php require_once "head.php"; ?>
	<?php if ((@is_null($_GET['nd']) && @$_GET['nd'] == '') && (@is_null($_GET['gw']) && @$_GET['gw'] == '')) echo "<style>body {background-image: url('../images/banner.jpg');background-color: #cccccc;background-position: top; background-repeat: no-repeat; background-size: cover;}</style>";?>
</head>
<body class="fixed-sn white-skin">
    <?php require_once "header.php"; ?>
    <main>
		<?php 
			if ((@is_null($_GET['nd']) && @$_GET['nd'] == '') && (@is_null($_GET['gw']) && @$_GET['gw'] == '')) require_once "main-intro.php";
			else require_once "main-sub-body.php";
		?>
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

	window.onload = function () {

	var dpsph = []; // dataPoints
	var dpste = [];
	var dpsli = [];
	var dpsdo = [];
	var dpstd = [];
	var dpsor = [];

	var chartph = new CanvasJS.Chart("phChart", {
		title :{
			text: "pH Data"
		},
		axisY: {
			//title: "pH",
			includeZero: false,
			valueFormatString: "##.##"
			
		},   
		axisX: {
			title: "Time",
			includeZero: false,
			valueFormatString: "hh:mm TT"
		},    
		data: [{
			color: "orange",
			type: "line",
			xValueFormatString: "DD/MM/YYYY hh:mm TT",
			yValueFormatString: "##.##",
			dataPoints: dpsph
		}]
	});

	var chartte = new CanvasJS.Chart("tempChart", {
		title :{
			text: "Temperature Data"
		},
		axisY: {
			//title: "Temperature",
			includeZero: false,
			valueFormatString: "##.##\u00B0C",
		},   
		axisX: {
			title: "Time",
			includeZero: false,
			valueFormatString: "hh:mm TT"
		},    
		data: [{
			color: "red",
			type: "line",
			xValueFormatString: "DD/MM/YYYY hh:mm TT",
			yValueFormatString: "##.##\u00B0C",
			dataPoints: dpste
		}]
	});

	var chartli = new CanvasJS.Chart("liqChart", {
		title :{
			text: "Liquid Water Level Data"
		},
		axisY: {
			//title: "Liquid Level Water",
			includeZero: false,
			valueFormatString: "##.##'%'"
			
		},   
		axisX: {
			title: "Time",
			includeZero: false,
			valueFormatString: "hh:mm TT"
		},    
		data: [{
			color: "blue",
			type: "line",
			xValueFormatString: "DD/MM/YYYY hh:mm TT",
			yValueFormatString: "##.##'%'",
			dataPoints: dpsli
		}]
	});

	var chartdo = new CanvasJS.Chart("doChart", {
		title :{
			text: "Dissolved Oxygen Data"
		},
		axisY: {
			//title: "Dissolved Oxygen",
			includeZero: false,
			valueFormatString: "##.##'%'"
			
		},   
		axisX: {
			title: "Time",
			includeZero: false,
			valueFormatString: "hh:mm TT"
		},    
		data: [{
			color: "darkblue",
			type: "line",
			xValueFormatString: "DD/MM/YYYY hh:mm TT",
			yValueFormatString: "##.##'%'",
			dataPoints: dpsdo
		}]
	});

	var charttd = new CanvasJS.Chart("tdsChart", {
		title :{
			text: "Total Dissolved Solids Data"
		},
		axisY: {
			//title: "pH",
			includeZero: false,
			valueFormatString: "##.##'ppm'"
			
		},   
		axisX: {
			title: "Time",
			includeZero: false,
			valueFormatString: "hh:mm TT"
		},    
		data: [{
			color: "purple",
			type: "line",
			xValueFormatString: "DD/MM/YYYY hh:mm TT",
			yValueFormatString: "##.##'ppm'",
			dataPoints: dpstd
		}]
	});

	var chartor = new CanvasJS.Chart("orpChart", {
		title :{
			text: "Oxidation Reduction Potential Data"
		},
		axisY: {
			//title: "Oxidation Reduction Potential",
			includeZero: false,
			valueFormatString: "##.##'mV'"
			
		},   
		axisX: {
			title: "Time",
			includeZero: false,
			valueFormatString: "hh:mm TT"
		},    
		data: [{
			color: "black",
			type: "line",
			xValueFormatString: "DD/MM/YYYY hh:mm TT",
			yValueFormatString: "##.##'mV'",
			dataPoints: dpsor
		}]
	});

	var d = new Date();
	var xVal = 0;
	var yVal = 50; 
	var updateInterval = 1000;
	var dataLength = 100; // number of dataPoints visible at any point
	var aph = 0;
	var ate = 0;
	var ali = 0;
	var ado = 0;
	var atd = 0;
	var aor = 0;


	var updateChart = function (count) {

		$.getJSON("<?php require_once "url.php"; ?>/getdata.php?gw=<?php echo $_GET['gw'];?>&id=<?php echo $_GET['nd'];?>", 
			function(data){

				for (var i = 0; i < data.length; i++) {
				    dpsph.push({
				      x: new Date(data[i].time*1000),
				      y: data[i].phValue
			    	});
			    	dpste.push({
				      x: new Date(data[i].time*1000),
				      y: data[i].tempValue
			    	});
			    	dpsli.push({
				      x: new Date(data[i].time*1000),
				      y: data[i].liqValue
			    	});
			    	dpsdo.push({
				      x: new Date(data[i].time*1000),
				      y: data[i].doValue
			    	});
			    	dpstd.push({
				      x: new Date(data[i].time*1000),
				      y: data[i].tdsValue
			    	});
			    	dpsor.push({
				      x: new Date(data[i].time*1000),
				      y: data[i].orpValue
			    	});
			    	aph += data[i].phValue;
			    	ate += data[i].tempValue;
			    	ali += data[i].liqValue;
			    	ado += data[i].doValue;
			    	atd += data[i].tdsValue;
			    	aor += data[i].orpValue;
			    	if (i == data.length-1){
			    		document.getElementById("nph").innerHTML = data[i].phValue;
			    		document.getElementById("nte").innerHTML = data[i].tempValue;
			    		document.getElementById("nli").innerHTML = data[i].liqValue;
			    		document.getElementById("ndo").innerHTML = data[i].doValue;
			    		document.getElementById("ntd").innerHTML = data[i].tdsValue;
			    		document.getElementById("nor").innerHTML = data[i].orpValue;
			    		document.getElementById("aph").innerHTML = (aph/data.length).toFixed(2);
			    		document.getElementById("ate").innerHTML = (ate/data.length).toFixed(2);
			    		document.getElementById("ali").innerHTML = (ali/data.length).toFixed(2);
			    		document.getElementById("ado").innerHTML = (ado/data.length).toFixed(2);
			    		document.getElementById("atd").innerHTML = (atd/data.length).toFixed(2);
			    		document.getElementById("aor").innerHTML = (aor/data.length).toFixed(2);
			    		aph = 0;
						ate = 0;
						ali = 0;
						ado = 0;
						atd = 0;
						aor = 0;
			    	}
			  	}
			}
		);

		if (dpsph.length > dataLength) {
			dpsph.shift();
			dpste.shift();
			dpsli.shift();
			dpsdo.shift();
			dpstd.shift();
			dpsor.shift();
		}
		chartph.render();
		chartte.render();
		chartli.render();
		chartdo.render();
		charttd.render();
		chartor.render();
	};

	updateChart(dataLength);
	setInterval(function(){updateChart()}, updateInterval);

	}
	</script>
    

</body>
</html>