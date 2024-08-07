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
                        <h5>Programme(s)</h5>
                    </div>
                    <form action="#">
                        <div class="bio-info">
                            <div class="propic-info">
                                <div class="pro-pic">
                                    <img src="../images/stud.JPG" alt="">
                                </div>
                                <div class="review-info">
                                    <div class="questions">
                                        <h4>Personal Information</h4>
                                        <div class="answers">
                                            <span>Surname</span>
                                            <span>Osei</span>
                                        </div>
                                        <div class="answers">
                                            <span>Other Names</span>
                                            <span>Kwame Obed</span>
                                        </div>
                                        <div class="answers">
                                            <span>Gender</span>
                                            <span>Male</span>
                                        </div>
                                        <div class="answers">
                                            <span>Date of Birth</span>
                                            <span>10/14/1997</span>
                                        </div>
                                        <div class="answers">
                                            <span>Phone Number</span>
                                            <span>+233 24 604 4481</span>
                                        </div>
                                        <div class="answers">
                                            <span>Country of Residence</span>
                                            <span>Ghana</span>
                                        </div>
                                        <div class="answers">
                                            <span>Residential Address</span>
                                            <span>Plt 365 Kumasi</span>
                                        </div>
                                        <div class="answers">
                                            <span>Postal Address</span>
                                            <span>P.O.Box 854, Kumasi</span>
                                        </div>
                                    </div>
                                    <div class="questions">
                                        <h4>Identification</h4>
                                        <div class="answers">
                                            <span>Type of ID Card</span>
                                            <span>Ghana Card</span>
                                        </div>
                                        <div class="answers">
                                            <span>ID Card Number</span>
                                            <span>GHA-12345678-9</span>
                                        </div>
                                    </div>
                                    <div class="questions">
                                        <h4>Programme(s)</h4>
                                        <div class="answers">
                                            <span>Student Number</span>
                                            <span>123456789</span>
                                        </div>
                                        <div class="answers">
                                            <span>Index Number</span>
                                            <span>123456789</span>
                                        </div>
                                        <div class="answers">
                                            <span>Full Name</span>
                                            <span>Osei Kwame Obed</span>
                                        </div>
                                        <div class="answers">
                                            <span>Graduate Type</span>
                                            <span>Undergraduate</span>
                                        </div>
                                        <div class="answers">
                                            <span>Programme Name</span>
                                            <span>Bachelor of Technology in Computer Technology</span>
                                        </div>
                                        <div class="answers">
                                            <span>Admission Year</span>
                                            <span>2021</span>
                                        </div>
                                        <div class="answers">
                                            <span>Graduation Year</span>
                                            <span>2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <button>Previous</button>
                                <button>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>