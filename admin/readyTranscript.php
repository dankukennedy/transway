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
                        $transRequest = $request->totalTransRequest();
                        $row = $transRequest;
                        ?>
                    <div class="data">
                        <div class="data-info">
                            <h3><?= isset($row['count']) ? $row['count']:"No Transcript Requested Yet " ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Requested</p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
                      $transDelivered = $request ->totalTranDelivered();
                      $deal = $transDelivered;
                   ?>

                        <div class="data-info">
                            <h3><?= isset($deal['count']) ? $deal['count'] : "No Transcript Delivered Yet" ?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Number of Transcript Delivered</p>
                        </div>
                    </div>
                    <div class="data">
                    <?php
                        $transReady = $request->totalTransReady();
                        $read =$transReady;
                    ?>
                        <div class="data-info">
                            <h3><?= isset($read['count'])? $read['count'] : "No Transcript Is Ready "?></h3>
                            <p style="color:deepskyblue; font-size:large;font-weight:500px">Transcript Yet To Serve </p>
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

                    // Instantiate your data class and get the total number of records
                    $dataRequest = new TransFetch();
                    $totalRecords = $dataRequest-> newApplication(); // Method to get total count
                    $result = $dataRequest->getPaginatedApplications($recordsPerPage, $offset); // Get records for current page
                    $totalPages = ceil($totalRecords / $recordsPerPage);
                ?>

                <div class="container">
    <div class="row">
        <?php
        $request = new TransData;
        $result = $request->newApplication();
        if ($result) {
            foreach ($result as $row) {
        ?>
        <!-- Card -->
        <div class="col-md-2 mb-2"> <!-- Adjust column width as needed -->
            <div class="card" style="width: 100%; height: 12.4rem;">
                <div class="card-body p-2">
                    <h5 class="card-title text-center mb-2" style="font-size: 1rem; color: #333;">Send Transcript</h5>
                    <form method="post" id="form_<?= $row['id'] ?>" enctype="multipart/form-data">
                        <p class="text-center mb-2"><?= htmlspecialchars($row['studentUserId']) ?></p>
                        <div class="mb-3">
                            <input type="file" name="image" class="form-control" accept=".pdf, .jpg, .png, .jpeg" />
                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>" />
                        </div>
                        <button type="button" id="submitButton" class="btn btn-primary w-100">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            echo "<p>No New Application Yet</p>";
        }
        ?> 
        
    </div>
</div>

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
<script type="text/javascript">
    document.querySelectorAll("#submitButton").forEach(button => {
        button.onclick = function() {
            const form = button.closest('form');
            form.submit();
        }
    });
</script>

<?php
if (isset($_FILES['image']['name'])) {
    $id = $_POST['id'];
    $imageName = $_FILES['image']['name'];
    $imageSize = $_FILES['image']['size'];
    $tmpName = $_FILES['image']['tmp_name'];

    $validImageExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
    $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    if (!in_array($imageExtension, $validImageExtensions)) {
        echo "<script>
                alert('Invalid file extension. Please select a PDF, JPEG, PNG, or JPG file.');
                document.location.href='readyTranscript.php';
              </script>";
    } elseif ($imageSize > 1200000) {
        echo "<script>
                alert('File size is too large. Maximum allowed size is 1.2MB.');
                document.location.href='readyTranscript.php';
              </script>";
    } else {
        $newImageName = $imageName . "-" . date("Y.m.d") . "-" . date("h.i.sa") . "." . $imageExtension;
        $managerUpdateQuery = "UPDATE transcripts SET transFile='$newImageName',disable=1 WHERE id='$id'";
        $result = $db->conn->query($managerUpdateQuery);

        if ($result) {
            move_uploaded_file($tmpName, '../files/' . $newImageName);
            echo "<script>
                    alert('Transcript successfully sent.');
                    document.location.href='readyTranscript.php';
                  </script>";
        }
    }
}
?>

<?php include "../includes/stu-footer.php" ?>