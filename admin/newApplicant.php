<?php
// Include necessary files
include('../config/app.php');
include_once('../controllers/AuthenticationController.php');
include_once('../controllers/TransRequest.php');
include_once('../controllers/TransData.php');
include_once('../controllers/TransFetch.php');

// Create instances and authenticate staff
$authenticated = new AuthenticationController();
$data = $authenticated->authStaffDetail();

// Determine the current page
$current_page = basename($_SERVER['PHP_SELF']);
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
                    <span>Staff Email: <?= htmlspecialchars($_SESSION['auth_staff']['staff_email']) ?></span>
                    <span style="float:right;">Staff ID: <?= htmlspecialchars($_SESSION['auth_staff']['staff_staffUserId']) ?></span>
                    <div class="profile-pic">
                        <img src="../images/stud.JPG" alt="Profile Picture">
                    </div>
                </div>
            </div>
            <div class="dashboard-analytics">
                <?php include('../includes/psms.php'); ?>
                <div class="analysis">
                    <?php 
                        $request = new TransRequest();
                        $transRequest = $request->newApplication();
                    ?>
                    <div class="data">
                        <div class="data-info">
                            <h3><?= isset($transRequest['count']) ? htmlspecialchars($transRequest['count']) : "No Transcript Requested Yet" ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Requested</p>
                        </div>
                    </div>
                    <div class="data">
                        <?php
                            $transDelivered = $request->totalTranDelivered();
                        ?>
                        <div class="data-info">
                            <h3><?= isset($transDelivered['count']) ? htmlspecialchars($transDelivered['count']) : "No Transcript Delivered Yet" ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Delivered</p>
                        </div>
                    </div>
                    <div class="data">
                        <?php
                            $transReady = $request->totalTransReady();
                        ?>
                        <div class="data-info">
                            <h3><?= isset($transReady['count']) ? htmlspecialchars($transReady['count']) : "No Transcript Is Ready" ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Transcript Ready</p>
                        </div>
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

                    // Instantiate your data class and get the total number of records
                    $dataRequest = new TransFetch();
                    $totalRecords = $dataRequest->newApplication(); // Method to get total count
                    $result = $dataRequest->getPaginatedApplications($recordsPerPage, $offset); // Get records for current page
                    $totalPages = ceil($totalRecords / $recordsPerPage);
                ?>

                <table class="table table-hover table-striped table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Programme</th>
                            <th>No. Transcript</th>
                            <th>Graduation Year</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Time</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = $offset + 1;
                        if ($result) {
                            foreach ($result as $row) {
                        ?>
                        <tr>
                            <th><?= htmlspecialchars($i++) ?></th>
                            <td><?= htmlspecialchars($row['studentUserId']) ?></td>
                            <td><?= htmlspecialchars($row['programme']) ?></td>
                            <td><?= htmlspecialchars($row['tNumber']) ?></td>
                            <td><?= htmlspecialchars($row['graduationYear']) ?></td>
                            <td><?= htmlspecialchars($row['contact']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= date("Y-m-d", strtotime($row['createdAt'])) ?></td>
                            <td>
                                <a href="viewApplicant.php?studentUserId=<?= urlencode($row['studentUserId']) ?>" class="btn btn-success">View</a>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='9'>No New Application Yet</td></tr>";
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
