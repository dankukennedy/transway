<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<?php include('../config/app.php');

include_once('../controllers/AuthenticationController.php');
include_once('../controllers/TransRequest.php');
include_once('../controllers/TransData.php');
include_once('../controllers/TransFetch.php');
$authenticated=new AuthenticationController;
$data = $authenticated->authStaffDetail();
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
                    <span>Staff Email: <?= $_SESSION['auth_staff']['staff_email'] ?></span>
                     <span ></span><span >&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span >&nbsp;&nbsp;&nbsp;</span><span >&nbsp;&nbsp;&nbsp;</span>
                     <span style="float:right;">Staff ID: <?= $_SESSION['auth_staff']['staff_staffUserId'] ?></span>
                     <div class="profile-pic">
                        <img src="../images/stud.JPG" alt="">
                    </div>
                </div>
            </div>
            <div class="dashboard-analytics">
            <?php  include('../includes/psms.php'); ?>
                <div class="analysis">
                <?php
                        $request= new TransRequest;
                        $transRequest = $request->totalTransServe();
                        $row = $transRequest;
                        ?>
                    <div class="data">
                        <div class="data-info">
                            <h3><?= isset($row['count']) ? $row['count'] :" No Transcript To Serve"?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript To serve</p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
                        $transReady = $request->totalTransReady();
                        $read =$transReady;
                    ?>
                         <div class="data-info">
                            <h3><?= isset($read['count'])? $read['count'] : "No Transcript Is Ready "?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Ready </p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
                          $transRequest = $request->totalTransRequest();
                          $row = $transRequest;
                        ?>
                        <div class="data-info">
                            <h3><?= isset($row['count']) ? $row['count'] :" No Transcript To Serve"?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Transcript Status</p>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
               <?php
                // Number of records per page
                $recordsPerPage = 10;

                // Get the current page number from the URL, default to 1 if not set
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $page = ($page < 1) ? 1 : $page; // Ensure page is at least 1

                // Calculate the offset
                $offset = ($page - 1) * $recordsPerPage;

                // Instantiate your data class
                $dataRequest = new TransFetch();
                $totalRecords = $dataRequest-> newApplicationServe();// Get total count for pagination
                $result = $dataRequest->getPaginatedApplications2($recordsPerPage, $offset); // Get records for current page
                $totalPages = ceil($totalRecords / $recordsPerPage);
                ?>

                <table class="table table-hover table-striped table-bordered">
      <thead>
         <tr>
            <th>#</th>
            <th>Student ID</th>
            <th>Programme</th>
            <th>No. Transcript</th>
            <th>GraduationYear</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Time</th>
            <th>Option</th>
         </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        $request = new TransData;
        $result = $request->newApplication();
        if($result)
        {
            foreach($result as $row)
            {

        ?>
              <tr >
            <th><?=$i++?></th>
            <td><?=$row['studentUserId'] ?></td>
            <td><?=$row['programme'] ?></td>
            <td><?=$row['tNumber'] ?></td>
            <td><?=$row['graduationYear'] ?></td>
            <td><?=$row['contact'] ?></td>
            <td><?=$row['email'] ?></td>
            <td><?= date("Y-m-d", strtotime($row['createdAt'])) ?></td>
            <td>
            <a href="viewApplicant.php?studentUserId=<?= $row['studentUserId'] ?>" class="btn btn-success">View</a>
             </td>

        </tr>

        <?php
             }
          } else{
              echo "No New Application Yet";
          }
       ?>
    </tbody>
</table>
 <!-- Pagination Links -->
        <nav aria-label="Page navigation" class="mt-3">
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>

<?php include "../includes/stu-footer.php" ?>