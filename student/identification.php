<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<?php include "../includes/stu-header.php" ?>

<div class="sdashboard">
    <div class="sidebar-content">
        <div class="sidebar">
            <div class="sidebar-info">
                <div class="title">
                    <h2>Student Transway</h2>
                </div>
                
                <?php include "sidenav.php" ?>

            </div>
        </div>
        <div class="main-content">
            <div class="header">
                <div class="header-content">
                    <span>Welcome Kwame</span>
                    <div class="profile-pic">
                        <img src="../images/stud.JPG" alt="">
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="content-details">
                    <div class="title">
                        <h5>Identification</h5>
                    </div>
                    <form action="#">
                        <div class="bio-info">
                            <div class="infos">
                                <div class="inputs">
                                    <label>Type of Identification Card <span>*</span>:</label>
                                    <select name="idcard" id="" required>
                                        <option value="-- Select Type of ID Card --">-- Select Type of ID Card --</option>
                                        <option value="Ghana Drivers License">Ghana Drivers License</option>
                                        <option value="Ghana Voters ID">Ghana Voters ID</option>
                                        <option value="National ID">National ID</option>
                                        <option value="NHIS">NHIS</option>
                                        <option value="Passport">Passport</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Identification Card Number <span>*</span>:</label>
                                    <input type="text" name="" placeholder="" required>
                                </div>
                                <div class="inputs">
                                    <label>Identification File (.pdf only, 5mb max) <span>*</span>:</label>
                                    <input type="file" name="" required>
                                    <p><span>Note:</span> Upload a pdf copy of the bio data page of your identification card (This page should contain your name, picture and identification card id)</p>
                                </div>
                            </div>
                            <div class="actions">
                                <button>Previous</button>
                                <button>Next</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>