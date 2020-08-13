
<div class="top-header" style="background: transparent!important;">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 h-100">
                <div class="header-content h-100 d-flex align-items-center justify-content-between">
                    <div class="academy-logo">
                        <a href="index.php"><img src="images/masterexamsLogo.png" style="height: 10em;margin-top: 0.2em;"></a>
                    </div>
                    <div class="login-content">

                        <?php if(isset($_SESSION["userLogin"])){ ?>
                        <div class="drop-down">
                            <a href="#" class="logged-user">&nbsp;&nbsp;
                                <img class="profile-pic" src="images/defaultuser.png">
                                <?php echo $_SESSION["uFirstName"]; ?>
                            </a>

                            <ul class="login-dropdown" style="width:7em;">
                                <?php if (1 == 1) { ?>
                                <li><a href="dashboard.php">
                                        <i class="fa fa-tachometer" aria-hidden="true">&nbsp;Dashboard</i>
                                    </a>
                                </li>
                                
                                    <?php } else {?>
                                <li><a href="Admin/">
                                        <i class="fa fa-tachometer" aria-hidden="true">&nbsp;Dashboard</i>
                                    </a></li>

                                <?php }

                                    if ($_SESSION["userLogin"] == "true") {?>
                                <li style='border-top: 1px solid #ddd;'><a href='controller/logoutController.php' onclick='signOutfromGoogle()'><i class='fa fa-sign-out' aria-hidden='true'>&nbsp;Logout</i></a></li>

                                <?php } else {?>
                                <li style='border-top: 1px solid #ddd;'><a href='controller/logoutController.php'><i class='fa fa-sign-out' aria-hidden='true'>&nbsp;Logout</i></a></li>

                                <?php } ?>
                            </ul>

                        </div>

                        <?php } else { ?>
                        <a href="login.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Login</a>
                        <?php }?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="website-main-menu">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">

            <nav class="classy-navbar justify-content-between" id="webNav">

                <div class="classy-navbar-toggler ">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <div class="classy-menu">

                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li class="dropdown-main"><a>Subjects</a>
                                <ul class="dropdown-sub">
                                    <div><a href="papers.php">All Subjects</a></div>
                                    <?php 
                                        getAllAvialableSubjects();
                                        while($getSubjectsRow = $GLOBALS['$getSubjectsResults']->fetch_assoc()) {
                                            
                                    ?>

                                        
                                        <div>
                                            <a href="papers.php?subId=<?php echo $getSubjectsRow["subjectID"];?>"><?php echo $getSubjectsRow["subjectName"];?></a>
                                        </div>

                                    <?php }
                                        closeDBConnection();
                                    ?>
                                </ul>
                            </li>

                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li style="margin-bottom: 0.5em;"><a href="faq.php">FAQ</a></li>
                            
                            <li class="search-input">
                                <?php 
                                    if(isset($_GET["searchword"])){
                                        if($_GET["searchword"]!=""){
                                            $sW = $_GET['searchword'];
                                        }else{
                                            $sW = "Search...";
                                        }
                                        
                                    } else{
                                        $sW = "Search...";
                                    }
                                ?>
                                <center>
                                    <form action="search.php" method="GET"> 
                                        <input type="text" name="searchword" placeholder="<?php echo $sW;?>" required>
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </center>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- <div class="calling-info view-disable">
                    <div class="call-center">
                        <a href="mailto:support@memdollar.com"><i class="fa fa-envelope"></i> </a>
                    </div>
                </div> -->

            </nav>

        </div>
    </div>
</div>