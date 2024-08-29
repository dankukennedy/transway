<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<?php 
include('../config/app.php');

include_once('../controllers/AuthenticationController.php');
include_once('../controllers/IdentificationController.php');
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
                        <h5>Identification</h5>
                        <?php  include('../includes/psms.php'); ?>
                    </div>
                 <?php
                    $studentUserId = $_SESSION['auth_user']['user_studentId'];
                    $identity = new IdentificationController;
                    $result = $identity->index($studentUserId);

                    // Initialize $row to an empty array if no data is found
                    $row = $result ? $result[0] : null;
                    ?>

                    <form action="../code/identification_code.php" method="POST">
                        <div class="bio-info">
                            <div class="infos">
                                <div class="inputs">
                                    <input type="hidden" name=" <?=$_SESSION['auth_user']['user_studentId']  ?>" value=" <?=$_SESSION['auth_user']['user_studentId']  ?>" >
                                    <label>Type of Identification Card <span>*</span>:</label>
                                    <select name="idCard" id="" required>
                                        <option value="<?= $row['idCard'] ?>"><?= isset($row['idCard']) ? $row['idCard']: '-- Select Type of ID Card --'; ?></option>
                                        <option value="Ghana Drivers License">Ghana Drivers License</option>
                                        <option value="Ghana Voters ID">Ghana Voters ID</option>
                                        <option value="National ID">National ID</option>
                                        <option value="NHIS">NHIS</option>
                                        <option value="Passport">Passport</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                <input type="hidden" name="studentUserId" value="<?= $_SESSION['auth_user']['user_studentId']?>" >
                                    <label>Identification Card Number <span>*</span>:</label>
                                    <input type="text" name="idCardNumber" value="<?= isset($row['idCardNumber']) ? $row['idCardNumber']: ''; ?>" placeholder="eg. F12548785-3" required>
                                </div>
                                <div class="inputs">
                                    <label>Identification File (.pdf only, 5mb max) <span>*</span>:</label>
                                    <input type="file" name="IdCardImage" value="<?= $row['idCardImage'] ?>" required>
                                    <p><span>Note:</span> Upload a pdf copy of the bio data page of your identification card (This page should contain your name, picture and identification card id)</p>
                                </div>
                            </div>
                            <div class="actions">
                                <button type="submit" name="identity">Save</button>
                                <button type="button"  onclick="window.location.href='personal-information.php';">Previous</button>
                                <button type="button" onclick="window.location.href='programmes.php';">Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_FILES['image']['name']))
    {
            // print_r($_FILES);
        $id=$_POST['id'];
        $name=$_POST['name'];


        $imageName=$_FILES['image']['name'];
        $imageSize=$_FILES['image']['size'];
        $tmpName=$_FILES['image']['tmp_name'];

        $validImageExtension=['jpg','jpeg','png'];
        $imageExtension=explode('.',$imageName);
        $imageExtension=strtolower(end($imageExtension));

        if(!in_array($imageExtension,$validImageExtension))
        {
            echo " <script>
            alert('invalid image Extension');
            document.location.href='ad_viewProfile.php';
            </script>";
        } 
        elseif($imageSize>1200000)
            {
                echo "  <script>
            alert('invalid image too Large');
            document.location.href='ad_viewProfile.php';
            </script>";
            }
                else
                {
                $newImageName=$imageName."-".date("Y.m.d")."-".date("h.i.sa");
                $newImageName.=".".$imageExtension;
                $managerUpdateQuery=" UPDATE admin SET profile_img='$newImageName'  WHERE id='$id' ";
                $result=$db->conn->query($managerUpdateQuery);
                
                    move_uploaded_file($tmpName,'../files/'.$newImageName);
                    echo "  <script>
                    alert('Profile Image Successfully Updated');
                    document.location.href='ad_viewProfile.php';
                    </script>";
                    if($result){
                    return true;
                }
                }

    }
    
?>      
<?php include "../includes/stu-footer.php" ?>