<? include('config/app.php'); ?>
<?php include "includes/header.php" ?>

<div class="landing-page">
    <div class="land-page">
        <div class="login-form">
            <div class="picture">
                <img src="./images/student.JPG" alt="">
            </div>
            <h3>Transcript Request System</h3>
           

            <form action="./code/authentication_code.php" method ="POST">
            <?php  include('includes/message.php'); ?>
                <input type="email" name="email" placeholder="eg. kwame@gmail.com" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login" value="submit">Login</button>
                <div class="links">
                    <span><a href="./admin">Staff Login</a></span>
                    <span><a href="signup.php">Are you a New <span>Student</span> to Transway? Register Now</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>