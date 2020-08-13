<style>

    #apwreset input{
        width: 100%;
        padding: 0.5em;
        border:1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 0.5em;
    }

    #adpwrebtn{
        width: 100%;
        padding: 0.5em;
        background: blue;
        border:1px solid blue;
        border-radius: 5px;
        color: #fff;
        font-weight: bold;
    }

    #resetpwli{
        display: none;
    }

</style>



<script>
    
    function activereset(){
        document.getElementById("resetpwbtn").style.display = "none";
        document.getElementById("resetpwli").style.display = "block";
    }

    function passcheck(){
        var newpw1 =document.getElementById("newpw1").value;
        var newpw2 =document.getElementById("newpw2").value;

        if(newpw1===newpw2){
            document.getElementById("matchPW").style.display = "block";
            document.getElementById("notmatchPW").style.display = "none";
        }else{
            document.getElementById("matchPW").style.display = "none";
            document.getElementById("notmatchPW").style.display = "block";
        }
    }

    function updatePW(ID){
        var newpw1 =document.getElementById("newpw1").value;
        var newpw2 =document.getElementById("newpw2").value;

        if(newpw1 && newpw2 && newpw1===newpw2){
            $.ajax({
                type: 'post',
                url: '../controller/updatePw.php',
                data: {
                    stuID:ID,
                    newPw:newpw2,
                },
                success: function (response) {
                    if(response==="success"){
                       document.getElementById("resetpwbtn").style.display = "block";
                        document.getElementById("resetpwli").style.display = "none";
                        document.getElementById("apwreset").reset(); 
                            
                    }else{
                        alert("Try Again");
                        document.getElementById("apwreset").reset(); 
                        document.getElementById("resetpwbtn").style.display = "block";
                        document.getElementById("resetpwli").style.display = "none";
                    }
                }
            });
        }
    }

    function logout(){
        gapi.auth.signOut();

    }

</script>

<?php
    
    if(!isset($_SESSION['userLogin']) && empty($_SESSION['userLogin'])) {
        echo "<script type='text/javascript'>location.href = '../';</script>";
    }else{
        $userID = $_SESSION['userID'];
    }


?>

<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">

        <a href="../Admin/" class="logo">
            <img src="../images/masterexamsLogo.png" style="height: 6.5em;margin-top: -1.3em;">
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-bars"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->

    <?php
        $totalmsg = getUnreadMessagesCount();
    ?>

    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                <li class="nav-item dropdown hidden-caret">

                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-comments"></i>
                       
                        <span class="notification"><?php echo $totalmsg; ?></span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">You have <b><?php echo $totalmsg; ?></b> new Messages</div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">

                                    <?php 
                                        getUnreadMessages();
                                        while ($getmsgRow = $GLOBALS['$getUnreadMessagesResults']->fetch_assoc()) {
                                            $mgsID = $getmsgRow["messageID"];
                                            $msgName = $getmsgRow["messageBy"];
                                            $msgMessage = $getmsgRow["message"];
                                    ?>

                                        <a href="readMessage.php?id=<?php echo $mgsID; ?>">
                                            <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    <?php echo $msgName; ?>
                                                </span>
                                                <span class="time"><?php echo substr($msgMessage,0,25); ?></span> 
                                            </div>
                                        </a>

                                    <?php } ?>
                                   
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="see-all" href="messages.php">See all messages<i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>

                </li>
                
                

                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="../images/defaultuser.png" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="../images/defaultuser.png" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4>admin</h4>

                                        <?php if(isset($_SESSION["googleLogin"])) {?>
                                            <p class="text-muted">Administrator</p><a href="../controller/logoutController.php" class="btn btn-xs btn-secondary btn-sm">Logout</a>

                                        <?php } else{?>
                                            <p class="text-muted">Administrator</p><a href="../controller/logoutController.php" class="btn btn-xs btn-secondary btn-sm">Logout</a>

                                        <?php } ?>

                                    </div>
                                </div>
                            </li>

                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Sidebar -->
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../images/defaultuser.png" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            admin
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li id="resetpwbtn">
                                <a href="#" onclick="activereset()">
                                    <span class="link-collapse">Edit Password</span>
                                </a>
                            </li>

                            <li id="resetpwli">
                                <form id="apwreset">
                                    <input type="password" name="newpw1" id="newpw1" required onkeyup="passcheck()" onkeydown="passcheck()" onkeypress="passcheck()" placeholder="New password">
                                    <input type="password" name="newpw2" id="newpw2" required onkeyup="passcheck()" onkeydown="passcheck()" onkeypress="passcheck()" placeholder="New password again">
                                    <p id="notmatchPW" style="color: red;display: none;">Passwords are not matching!</p>
                                    <p id="matchPW" style="color: green;display: none;">Passwords are matching!</p>
                                </form>

                                <button id="adpwrebtn" style="cursor: pointer;" onclick="updatePW(<?php echo $userID; ?>)">Update</button>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a href="students.php">
                        <i class="fa fa-graduation-cap"></i>
                        <p>Students</p>
                        <span class="caret"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="" href="main_subjects.php">
                        <i class="fa fa-list-alt"></i>
                        <p>Main Subjects</p>
                        <span class="caret"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="" href="Subjects.php">
                        <i class="fa fa-list-alt"></i>
                        <p>Subjects</p>
                        <span class="caret"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  href="admins.php">
                        <i class="fa fa-lock"></i>
                        <p>Admins</p>
                        <span class="caret"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#tables">
                        <i class="fa fa-book"></i>
                        <p>Papers</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="allPapers.php">
                                    <span class="sub-item">All Papers</span>
                                </a>
                            </li>
                            <li >
                                <a href="selectPaper.php">
                                    <span class="sub-item">Add Questions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-toggle="" href="answers.php">
                        <i class="fa fa-pencil-square"></i>
                        <p>Answers</p>
                        <span class="caret"></span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a data-toggle="" href="messages.php">
                        <i class="fa fa-commenting-o"></i>
                        <p>Messages</p>
                        <span class="caret"></span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a data-toggle="" href="invitations.php">
                        <i class="fa fa-share"></i>
                        <p>Invitations</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="" href="faq.php">
                        <i class="fa fa-question-circle"></i>
                        <p>FAQ</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="" href="news.php">
                        <i class="fa fa-newspaper-o"></i>
                        <p>News</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="" href="mainbanner.php">
                        <i class="fa fa-picture-o"></i>
                        <p>Main Banner</p>
                        <span class="caret"></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a data-toggle="" href="adver.php">
                        <i class="fa fa-clipboard"></i>
                        <p>Advertisement</p>
                        <span class="caret"></span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->


