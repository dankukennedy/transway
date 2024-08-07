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
                            <div class="infos">
                                <div class="inputs">
                                    <label>Student Number <span>*</span>:</label>
                                    <input type="text" name="" placeholder="" required>
                                </div>
                                <div class="inputs">
                                    <label>Index Number <span>*</span>:</label>
                                    <input type="text" name="" placeholder="" required>
                                </div>
                                <div class="inputs">
                                    <label>Full Name Shown on Certificate with Title (Miss) <span>*</span>:</label>
                                    <input type="text" name="" placeholder="" required>
                                </div>
                                <div class="inputs">
                                    <label>Graduate Type<span>*</span>:</label>
                                    <select name="gender" id="" required>
                                        <option value="-- Select Graduate Type --">-- Select Graduate Type --</option>
                                        <option value="Undergraduate">Undergraduate</option>
                                        <option value="Postgraduate">Postgraduate</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Programme of Study<span>*</span>:</label>
                                    <select name="admitted" id="" required>
                                        <option value="-- Select Admission Year --">-- Select Programme of Study --</option>
                                        <option value="Bachelor of Technology in Computer Technology">Bachelor of Technology in Computer Technology</option>
                                        <option value="Bachelor of Technology in Fashion Studies">Bachelor of Technology in Fashion Studies</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Admission Year<span>*</span>:</label>
                                    <select name="admitted" id="" required>
                                        <option value="-- Select Admission Year --">-- Select Admission Year --</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Gradutation of Last Study Year<span>*</span>:</label>
                                    <select name="admitted" id="" required>
                                        <option value="-- Select Gradutation of Last Study Year --">-- Select Gradutation of Last Study Year --</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                <div class="inputs">
                                    <label>Add Transcript Address (if any) <span>*</span>:</label>
                                    <input type="text" name="" placeholder="admission@transway.com" required>
                                </div>
                            </div>
                            <div class="add-more">
                                <button>+ Add Programme</button>
                            </div>
                            <div class="actions">
                                <button>Verify</button>
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