<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<?php include('../config/app.php');


include_once('../controllers/AuthenticationController.php');
include_once('../controllers/TransFetch.php');
$authenticated=new AuthenticationController;
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
            <?php  include('../includes/psms.php'); ?>
                <div class="analysis">
              <?php
                    $studentUserId = $_SESSION['auth_user']['user_studentId'];
                    $trans = new TransFetch;
                    $result = $trans->transFetch($studentUserId);
                    $row = $result ? $result[0] : null;

               ?>
                    <div class="data">
                        <div class="data-info">
                            <h4><?= $row === null 
                              ? "No data available for Transcript Requested" 
                               : "Index Number : " . $row['studentUserId']; ?></h4>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Applicant Student ID :<?=isset($row['studentUserId']) ? $row['studentUserId']:$studentUserId?></p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h4><?= isset($row['tNumber']) ? $row['tNumber'] : 'No Application Yet' ?></h4>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Requested</p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h4><?= isset($row['email']) ? $row['email'] : 'No Application Yet' ?></h4>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">You Email Address</p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h4><?= isset($row['programme']) ? $row['programme'] : 'No Application Yet' ?></h4>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Programme Studied</p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h4><?= isset($row['graduationYear']) ? $row['graduationYear'] : 'No Application Yet' ?></h4>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Graduation Year</p>
                        </div>
                    </div>
                    <div class="data">
                        <div class="data-info">
                            <h3><?= isset($row['disable'])===0 ? $row['disable'] : 'Transcript Not ready Yet' ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Transcript Status</p>
                        </div>
                    </div>
                </div>
                    <div>
                    <?php
$fileExists = !empty($row['transFile']);
?>

<div class="download-container" style="margin-top: 20px;">
    <p>
        <img src="../files/pdf1.png" alt="Transcript Image" style="width: 100px; height: auto;" />
    </p>
    <a href="<?= $fileExists ? '../files/' . htmlspecialchars($row['transFile']) : '#'; ?>"
       <?= $fileExists ? 'download' : ''; ?> 
       class="download-btn">
        Download Transcript
    </a>
</div>



             </div>
            </div>
        </div>
    </div>
</div>

<style>

.download-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    width: 300px;
}

.download-btn {
    display: inline-block;
    padding: 15px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.download-btn:hover {
    background-color: #0056b3;
}
</style>

<?php include "../includes/stu-footer.php" ?>
