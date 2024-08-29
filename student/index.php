<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<?php include('../config/app.php');

include_once('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$data = $authenticated->authUserDetail();
?>

<?php include "../includes/stu-header.php" ?>


<div class="sdashboard">
    <div class="sidebar-content">
        <div class="sidebar">
            <div class="sidebar-info">
                <div class="title">
                    <h4>Student Transway</h4>
                </div>
            
                <?php include "sidenav.php" ?>

            </div>
        </div>
        <div class="main-content">
            <div class="header">
                 <div class="header-content" style="display: flex; justify-content: space-between;">
                    <span>Email: <?= $_SESSION['auth_user']['user_email'] ?></span>
                     <span ></span><span >&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span style="float:right;">Student ID: <?= $_SESSION['auth_user']['user_studentId'] ?></span>
                     <div class="profile-pic">
                        <img src="../images/stud.JPG" alt="">
                    </div>
                </div>
            </div>
            <div class="dashboard-analytics">
                <div class="analysis">
                    <div class="data">
                        <div class="data-info">
                            <h3>5</h3>
                            <p>Number of Transcript Requested</p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h3>1</h3>
                            <p>Number of Transcript Delivered</p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h3>Ready</h3>
                            <p>Transcript Status</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php include "../includes/stu-footer.php" ?>
