<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['crmsaid']==0)) {
  header('location:logout.php');
} else {
  // Update for message
  $vid=$_GET['viewid'];
  $ret=mysqli_query($con,"update tblmessage set IsRead='1' where AppID='$vid'");
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <title>Campus Recruitment Management System-History of applied Jobs</title>
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/app.css">
  <style>
    .loader {
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: #F5F8FA;
      z-index: 9998;
      text-align: center;
    }
    .plane-container {
      position: absolute;
      top: 50%;
      left: 50%;
    }
  </style>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
  <div class="plane-container">
    <div class="preloader-wrapper small active"></div>
  </div>
</div>
<div id="app">
<?php include_once('includes/sidebar.php'); ?>
<?php include_once('includes/header.php'); ?>
<div class="page has-sidebar-left">
  <div class="animatedParent animateOnce">
    <div class="container-fluid my-3">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <header class="blue accent-3 relative">
              <div class="container-fluid text-white">
                <div class="row p-t-b-10">
                  <div class="col">
                    <h4><i class="icon-package"></i> Details of Applied Jobs</h4>
                  </div>
                </div>
              </div>
            </header>
            <div class="card-body b-b">
<?php
$vid=$_GET['viewid'];
$ret=mysqli_query($con,"SELECT tblvacancy.ID, tblvacancy.JobTitle, tblvacancy.MonthlySalary,
  tblvacancy.JobDescriptions, tblvacancy.NoofOpenings, tblvacancy.JobLocation,
  tblvacancy.ApplyDate, tblvacancy.LastDate, tblapplyjob.ID, tblapplyjob.Resume,
  tblapplyjob.Message, tblapplyjob.Remark, tblapplyjob.Status, tbluser.ID AS uid,
  tbluser.FullName, tbluser.Email, tbluser.MobileNumber, tbluser.StudentID,
  tbluser.Gender, tbluser.Address, tbluser.Age, tbluser.DOB, tbluser.Image,
  tblcompany.CompanyName FROM tblapplyjob 
  JOIN tbluser ON tblapplyjob.UserId = tbluser.ID
  JOIN tblvacancy ON tblapplyjob.JobId = tblvacancy.ID
  JOIN tblcompany ON tblcompany.ID = tblvacancy.CompanyID 
  WHERE tblapplyjob.ID = '$vid'");
$cnt = 1;
while ($row = mysqli_fetch_array($ret)) {
?>
<table class="table table-bordered table-hover data-tables">
  <tr>
    <th scope="col" width="200">Job Title</th>
    <td><?php echo $row['JobTitle']; ?></td>
    <th scope="col">Company Name</th>
    <td><?php echo $row['CompanyName']; ?></td>
  </tr>
  <tr>
    <th scope="col">Monthly In-hand Salary</th>
    <td colspan="3"><?php echo $row['MonthlySalary']; ?></td>
  </tr>
  <tr>
    <th scope="col">Job Descriptions</th>
    <td colspan="3"><?php echo $row['JobDescriptions']; ?></td>
  </tr>
  <tr>
    <th scope="col">Job Location</th>
    <td><?php echo $row['JobLocation']; ?></td>
    <th scope="col">No of Opening</th>
    <td><?php echo $row['NoofOpenings']; ?></td>
  </tr>
  <tr>
    <th scope="col">Apply Date</th>
    <td><?php echo $row['ApplyDate']; ?></td>
    <th scope="col">Last Date</th>
    <td><?php echo $row['LastDate']; ?></td>
  </tr>
  <tr>
    <th scope="col">Full Name</th>
    <td><?php echo $row['FullName']; ?></td>
    <th scope="col">Email</th>
    <td><?php echo $row['Email']; ?></td>
  </tr>
  <tr>
    <th scope="col">Mobile Number</th>
    <td><?php echo $row['MobileNumber']; ?></td>
    <th scope="col">Student ID</th>
    <td><?php echo $row['StudentID']; ?></td>
  </tr>
  <tr>
    <th scope="col">Gender</th>
    <td><?php echo $row['Gender']; ?></td>
    <th scope="col">Address</th>
    <td><?php echo $row['Address']; ?></td>
  </tr>
  <tr>
    <th scope="col">Age</th>
    <td><?php echo $row['Age']; ?></td>
    <th scope="col">DOB</th>
    <td><?php echo $row['DOB']; ?></td>
  </tr>
  <tr>
    <th scope="col">Image</th>
    <td><img src="../user/images/<?php echo $row['Image']; ?>" width="200" height="150"></td>
    <th scope="col">Education Detail</th>
    <td><a href="view-education-detail.php?eduid=<?php echo $row['uid']; ?>&uname=<?php echo $row['FullName']; ?>" target="_blank">My Education Details</a></td>
  </tr>
  <tr>
    <th scope="col">Resume</th>
    <td><a href="../user/images/<?php echo $row['Resume']; ?>" target="_blank">Download</a></td>
    <th scope="col">Status</th>
    <td>
      <?php echo $row['Status'] == "" ? "Not Responded Yet" : $row['Status']; ?>
    </td>
  </tr>
</table>
<?php if ($row['Status'] != '0') {
$ret = mysqli_query($con, "SELECT tblmessage.Message, tblmessage.Status AS comstatus, tblmessage.ResponseDate FROM tblapplyjob LEFT JOIN tblmessage ON tblmessage.AppID = tblapplyjob.ID WHERE tblapplyjob.ID = '$vid'");
$cnt = 1;
?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
  <tr align="center">
    <th scope="col" colspan="4" style="font-size:18px">Application History</th>
  </tr>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Message</th>
    <th scope="col">Status</th>
    <th scope="col">Time</th>
  </tr>
  <?php while ($row = mysqli_fetch_array($ret)) { ?>
  <tr>
    <td><?php echo $cnt++; ?></td>
    <td><?php echo $row['Message']; ?></td>
    <td><?php echo $row['comstatus']; ?></td>
    <td><?php echo $row['ResponseDate']; ?></td>
  </tr>
  <?php } ?>
</table>
<?php } } ?>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>
<?php } ?>
