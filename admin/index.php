<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<? include('config/app.php'); ?>
<?php include "../includes/stu-header.php" ?>

<div class="landing-page">
    <div class="land-page">
        <div class="login-form">
            <div class="picture">
                <img src="../images/staff.JPG" alt="">
            </div>
            <h3>Transcript Request System</h3>
            <?php  include('../includes/message.php'); ?>
            <form action="" method ="POST">
                <input type="text" name="staffId" placeholder="Staff ID" required>
                <input type="password" name="pin"placeholder="Pin" required>
                <button>Login</button>
                <div class="links">
                <span> <a href="../index.php">Student Login</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>