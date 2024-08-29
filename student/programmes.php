<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<?php include('../config/app.php');

include_once('../controllers/AuthenticationController.php');
include_once('../controllers/ProgrammeController.php');
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
            <div class="content">
                <div class="content-details">
                    <div class="title">
                        <h5>Programme(s)</h5>
                    </div>
                    <?php  include('../includes/psms.php'); ?>
                    <?php
                      $studentUserId = $_SESSION['auth_user']['user_studentId'];
                         $program = new ProgrammeController;
                         $result = $program->Index($studentUserId);

                         $row = $result ? $result[0] : null;
                         
                       ?>
                    <form action="../code/programme_code.php" method="POST">
                    
                        <div class="bio-info">
                            <div class="infos">
                                <div class="inputs">
                                    <label>Student Phone Number <span>*</span>:</label>
                                    <input type="text" name="number" value="<?=isset($row['number']) ? $row['number']:'' ?>" placeholder="eg 025478658" required>
                                </div>
                                <div class="inputs">
                                    <label>Index Number <span>*</span>:</label>
                                    <input type="hidden" name="studentUserId" value="<?= $_SESSION['auth_user']['user_studentId']?>" >
                                    <input type="text" name="indexNumber" value="<?= $_SESSION['auth_user']['user_studentId']?>" placeholder="" disabled>
                                    <input type="hidden" name="indexNumber" value="<?= $_SESSION['auth_user']['user_studentId']?>">
                                </div>
                                <div class="inputs">
                                    <label>Full Name Shown on Certificate with Title (Miss) <span>*</span>:</label>
                                    <input type="text" name="fullname" value="<?= isset($row['fullname'])?$row['fullname']:'' ?>" placeholder="Danku kennedy Edem" required>
                                </div>
                                <div class="inputs">
                                    <label>Graduate Type<span>*</span>:</label>
                                    <select name="graduateType" id="" required>
                                        <option value="<?= $row['graduateType'] ?>"><?= isset($row['graduateType']) ? $row['graduateType']: '-- Select Graduate Type --' ?></option>
                                        <option value="Undergraduate">Undergraduate</option>
                                        <option value="Postgraduate">Postgraduate</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Programme of Study<span>*</span>:</label>
                                    <select name="programme" id="" required>
                                        <option value="<?= $row['programme'] ?>"><?= isset($row['programme']) ? $row['programme']:'-- Select Programme of Study --' ?></option>
                                        <option value="Bachelor of Technology in Computer Technology">Bachelor of Technology in Computer Technology</option>
                                        <option value="Bachelor of Technology in Fashion Studies">Bachelor of Technology in Fashion Studies</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Admission Year<span>*</span>:</label>
                                    <select name="admissionYear" id="" required>
                                        <option value="<?= $row['admissionYear'] ?>"><?= isset($row['admissionYear']) ?$row['admissionYear'] :'-- Select Admission Year --' ?></option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Graduation of Last Study Year<span>*</span>:</label>
                                    <select name="graduationYear" id="" required>
                                        <option value="<?= $row['graduationYear'] ?>"><?= isset($row['graduationYear']) ? $row['graduationYear']:'-- Select Graduation of Last Study Year --' ?></option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Add Transcript Address (if any) <span>*</span>:</label>
                                    <input type="text" name="transcriptEmail" value="<?= isset($row['transcriptEmail']) ? $row['transcriptEmail'] : $_SESSION['auth_user']['user_email'] ?>" placeholder="admission@transway.com" disabled>
                                    <input type="hidden" name="transcriptEmail" value="<?= isset($row['transcriptEmail']) ? $row['transcriptEmail'] : $_SESSION['auth_user']['user_email'] ?>" placeholder="admission@transway.com" >
                                </div>
                            </div>
                            <div class="add-more">
                                <button >+ Add Programme</button>
                            </div>
                            <div class="actions">
                                <button type="submit" name="reg_program">Save</button>
                                <button type="button" onclick="window.location.href='identification.php';">Previous</button>
                                <button type="button" onclick="window.location.href='review.php';">Next</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>