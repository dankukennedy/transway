
         <div class="sidenav">
                    <nav>
                        <a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'active': '' ?>">Dashboard</a>
                        <a href="newApplicant.php" class="<?php echo $current_page == 'newApplicant.php' ? 'active': '' ?> ">New Applications</a>
                        <a href="transcriptYetToServe.php" class="<?php echo $current_page == 'transcriptYetToServe.php' ? 'active': '' ?> ">Transcript Yet To Serve</a>
                        <a href="readyTranscript.php" class="<?php echo $current_page == 'readyTranscript.php'? 'active': '' ?> ">Ready Transcript</a>
                        <a href="transcriptDelivered.php" class="<?php echo $current_page == 'transcriptDelivered.php' ? 'active': '' ?> ">Transcript Delivered</a>
                        <form action="" method="POST"><button name="logout">Logout</button></form>
                    </nav>
                </div>

