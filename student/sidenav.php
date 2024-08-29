
             <div class="sidenav">
                    <nav>
                        <a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'active': '' ?>">Dashboard</a>
                        <a href="personal-information.php" class="<?php echo $current_page == 'personal-information.php' ? 'active': '' ?> ">Personal Information</a>
                        <a href="identification.php" class="<?php echo $current_page == 'identification.php' ? 'active': '' ?> ">Identification</a>
                        <a href="programmes.php" class="<?php echo $current_page == 'programmes.php' ? 'active': '' ?> ">Programme(s)</a>
                        <a href="review.php" class="<?php echo $current_page == 'review.php' ? 'active': '' ?> ">Review</a>
                        <form action="" method="POST"><button name="logout">Logout</button></form>
                    </nav>
                </div>

