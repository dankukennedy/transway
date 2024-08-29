<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<?php include('../config/app.php');

include_once('../controllers/AuthenticationController.php');
include_once('../controllers/TransRequest.php');
include_once('../controllers/IdentificationController.php');
include_once('../controllers/ProgrammeController.php');
include_once('../controllers/PersonalController.php');
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
            <div class="content">
                <div class="content-details">
                    <div class="title">
                        <h5>Programme(s)</h5>
                        <?php  include('../includes/psms.php'); ?>
                    </div>
                    <form  action="#" >
                        <div class="bio-info">
                            <div class="propic-info">
                                <div class="pro-pic">
                                    <img src="../images/stud.JPG" alt="">
                                </div>
                                <div class="review-info">
                                    <div class="questions">
                                        <h4>Personal Information</h4>
                                        <?=isset($_GET['studentUserId'])? $_GET['studentUserId']:"Error Passed" ?>
                                           <?php  $studentUserId = $_GET['studentUserId']; ?>

                                        <?php
                                           $studentUserId= $_GET['studentUserId'];
                                            $personal = new PersonalController;
                                            $result = $personal->Index($studentUserId);

                                            $per = $result ? $result[0] : null;

                                   ?>
                                        <div class="answers">
                                            <span>Surname</span>
                                            <span><?= isset($per['surename']) ? $per['surename']:'Danku' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Other Names</span>
                                            <span><?= isset($per['othername']) ? $per['othername']:'Kennedy Edem' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Gender</span>
                                            <span><?= isset($per['gender']) ? $per['gender'] :'' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Date of Birth</span>
                                            <span><?= isset($per['dob']) ? $per['dob']: '' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Phone Number</span>
                                            <span><?= isset($per['number']) ? $per['number']:'025487522' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Country of Residence</span>
                                            <span><?= isset($per['country']) ? $per['country']: 'Ghana' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Residential Address</span>
                                            <span><?= isset($per['address'])? $per['address']:'GD-269, F224, 4680 BARBET ST, Amrahia' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Postal Address</span>
                                            <span><?= isset($per['postAddress']) ? $per['postAddress']: 'eg P . O BOX 234 Accra' ?></span>
                                        </div>
                                    </div>
                                    <div class="questions">
                                        <h4>Identification</h4>
                                        <?php
                                        $studentUserId =$_GET['studentUserId'];
                                        $identity = new IdentificationController;
                                        $result = $identity->index($studentUserId);

                                        // Initialize $row to an empty array if no data is found
                                        $ide =$result ? $result[0] : null;;
                                        ?>

                                        <div class="answers">
                                            <span>Type of ID Card</span>
                                            <span><?= isset($row['idCard']) ? $row['idCard']: 'Ghana Card'?></span>
                                        </div>
                                        <div class="answers">
                                            <span>ID Card Number</span>
                                            <span><?= isset($row['idCardNumber']) ? $row['idCardNumber']: 'G202568858-7'?></span>
                                        </div>
                                    </div>
                                    <div class="questions">
                                        <h4>Programme(s)</h4>
                                        <?php
                                        $studentUserId= $_GET['studentUserId'];
                                            $program = new ProgrammeController;
                                            $result = $program->Index($studentUserId);

                                            $pro = $result ? $result[0] : null;

                                        ?>
                                        <div class="answers">
                                            <span>Student Phone Number</span>
                                            <span><?= isset($pro['number']) ?  $pro['number']: '02478536982'?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Index Number</span>
                                            <span><?= isset($pro['studentUserId']) ?  $pro['studentUserId']: '02478536982'?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Full Name</span>
                                            <span><?= isset($pro['fullname']) ?  $pro['fullname']: '02478536982'?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Graduate Type</span>
                                            <span><?= isset($pro['graduateType']) ? $pro['graduateType']:'Undergraduate' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Programme Name</span>
                                            <span><?= isset($pro['programme']) ? $pro['programme']:'Bachelor of Technology in Computer Technology' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Admission Year</span>
                                            <span><?= isset($pro['admissionYear']) ? $pro['admissionYear'] :'2021' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Graduation Year</span>
                                            <span><?= isset($pro['graduationYear']) ? $pro['graduationYear']:'2024' ?></span>
                                        </div>
                                        <div class="answers">
                                            <span>Email to sent the Transcript To</span>
                                            <span><?= isset($pro['transcriptEmail']) ? $pro['transcriptEmail']:'' ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>