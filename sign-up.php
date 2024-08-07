<? include('config/app.php'); ?>

<?php include "includes/header.php" ?>

<div class="landing-page">
    <div class="land-page">
        <div class="login-form">
            <div class="picture">
                <img src="./images/student.JPG" alt="">
            </div>
            <h3>Transcript Request System</h3>
            <?php  include('includes/message.php'); ?>
            <form action="" method ="POST">
                <input type="number" name="name" placeholder="Student ID No." required>
                <input type="email" name="email" placeholder="Eg. kwame@gmail.com" required>
                <input type="number" name="number" placeholder="eg 0240000000" required>
                <input type="text" name="password" placeholder="Password" required>
                <input type="text" name="repassword" placeholder="Confirm Password" required>
                <button  type="submit" name="register" >Register</button>
                <div class="links">
                    <span><a href="./admin">Staff Login</a></span>
                    <span><a href="index.php">Already have an account? <span>Login</span></a></span>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>