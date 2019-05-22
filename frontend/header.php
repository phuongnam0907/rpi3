<header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
                <!-- Logo -->
                <li>
                    <div class="logo-wrapper waves-light">
                        <a href="about.php"><img src="../images/lora.png" class="img-fluid flex-center"></a>
                    </div>
                </li>
                <!--/. Logo -->
                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        
                        <!-- <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i> Gateway ID - 1<i class="fas fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="main.php" class="waves-effect">Sensor 1</a>
                                    </li>
                                    <li><a href="main2.php" class="waves-effect">Sensor 2</a>
                                    </li>
                                    <li><a href="main3.php" class="waves-effect">Sensor 3</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i> Gateway ID - 2<i class="fas fa-angle-down rotate-icon"></i></a>
                            <div class="collapsible-body">
                                <ul class="list-unstyled">
                                    <li><a href="#" class="waves-effect">Sensor 4</a>
                                    </li>
                                    <li><a href="#" class="waves-effect">Sensor 5</a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->

                        <?php 
                            include("../backend/config.php");
                            $heroes = array(); 
                            $sql = "SELECT DISTINCT Gateway, Node FROM sensor ORDER BY Gateway;";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $stmt->bind_result($gateway, $node);
                             
                            //looping through all the records
                            while($stmt->fetch()){                             
                                $temp = [
                                'Gateway'=>$gateway,
                                'Node'=>$node
                                ];

                                //pushing the array inside the hero array 
                                array_push($heroes, $temp);
                            }                             
                            $json = json_encode($heroes);
                            $firstGateway = $heroes[0]['Gateway'];
                            $string = "<li><a class='collapsible-header waves-effect arrow-r'><i class='fas fa-chevron-right'></i> Gateway ID - ".$firstGateway."<i class='fas fa-angle-down rotate-icon'></i></a><div class='collapsible-body'><ul class='list-unstyled'>";
                            for ($i=0; $i < count($heroes); $i++) { 
                                if ($firstGateway == $heroes[$i]['Gateway']) $string .="<li><a href='main.php?gw=".$heroes[$i]['Gateway']."&nd=".$heroes[$i]['Node']."' class='waves-effect'>Sensor ".$heroes[$i]['Node']."</a></li>";
                                else {
                                    $firstGateway = $heroes[$i]['Gateway'];
                                    $string .= "</ul></div></li><li><a class='collapsible-header waves-effect arrow-r'><i class='fas fa-chevron-right'></i> Gateway ID - ".$firstGateway."<i class='fas fa-angle-down rotate-icon'></i></a><div class='collapsible-body'><ul class='list-unstyled'>";
                                    $string .="<li><a href='main.php?gw=".$heroes[$i]['Gateway']."&nd=".$heroes[$i]['Node']."' class='waves-effect'>Sensor ".$heroes[$i]['Node']."</a></li>";
                                }
                            }
                            $string .="</ul></div></li>";
                            echo $string;
                            mysqli_close($conn);
                        ?>
 
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fas fa-bars"></i></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto">
                <p>Gateway Data</p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="main.php"><i class="fas fa-home"></i> <span class="clearfix d-none d-sm-inline-block">Home</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-database"></i> <span class="clearfix d-none d-sm-inline-block">Data</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="data.php"><i class="fas fa-table"></i> Sensor Value</a>
                        <a class="dropdown-item" href="node.php"><i class="fas fa-list-alt"></i> Node List</a>
                    </div>
                </li>
				<li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="nodemap.php"><i class="fas fa-sitemap"></i> <span class="clearfix d-none d-sm-inline-block">Node Mapping</span></a>
                </li>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-cloud-download-alt"></i> <span class="clearfix d-none d-sm-inline-block">Download</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="android.php"><i class="fab fa-android"></i> Android</a>
                        <a class="dropdown-item" href="ios.php"><i class="fab fa-apple"></i> iOS</a>
                    </div>
                </li>
				<li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="about.php"><i class="fas fa-info-circle"></i> <span class="clearfix d-none d-sm-inline-block">About</span></a>
                </li>
            </ul>
        </nav>
        <!-- /.Navbar -->
    </header>