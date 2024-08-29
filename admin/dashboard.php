<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<?php include('../config/app.php');

include_once('../controllers/AuthenticationController.php');
include_once('../controllers/TransRequest.php');
$authenticated=new AuthenticationController;
$data = $authenticated->authStaffDetail();
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
                    <span>Staff Email: <?= $_SESSION['auth_staff']['staff_email'] ?></span>
                     <span ></span><span >&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span style="float:right;">Staff ID: <?= $_SESSION['auth_staff']['staff_staffUserId'] ?></span>
                     <div class="profile-pic">
                        <img src="../images/stud.JPG" alt="">
                    </div>
                </div>
            </div>
            <div class="dashboard-analytics">
            <?php  include('../includes/psms.php'); ?>
                <div class="analysis">
                    <div class="data">
                        <?php 
                          $request= new TransRequest;
                          $transRequest = $request->totalTransRequest();
                          $row = $transRequest;
                        ?>
                        <div class="data-info">
                            <h3><?= isset($row['count']) ? $row['count']:"No Transcript Requested Yet " ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Requested</p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
                      
                       $transDelivered = $request ->totalTranDelivered();
                       $deal = $transDelivered;
                    ?>
                        <div class="data-info">
                            <h3><?= isset($deal['count']) ? $deal['count'] : "No Transcript Delivered Yet" ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Delivered</p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
            
                     $transServer = $request->totalTransServe(); 
                     $ser= $transServer
                    ?>
                        <div class="data-info">
                            <h3><?= isset($ser['count']) ? $ser['count'] :" No Transcript To Serve"?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript to Serve</p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
    
                       $transReady = $request->totalTransReady();
                       $read =$transReady;
                    ?>
                        <div class="data-info">
                            <h3><?= isset($read['count'])? $read['count'] : "No Transcript Is Ready "?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Transcript Ready </p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
                  
                      $transApp = $request->newApplication();
                      $newApplicant= $transApp;
                    ?>
                        <div class="data-info">
                            <h3><?=isset($newApplicant['count']) ? $newApplicant['count']:"No Application Yet" ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">New Applications </p>
                        </div>
                    </div>
                    <div class="data">
                    <?php ?>
                        <div class="data-info">
                            <h3><?= isset($row['count']) ? $row['count']:"No Transcript Requested Yet " ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Total Transcript</p>
                        </div>
                    </div>

                    <div>

                    </div>
                </div>
              

            </div>
        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>