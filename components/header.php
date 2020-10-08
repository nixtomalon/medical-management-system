<!-- <?php session_star;?> -->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Medical-System</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../vendor/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="../vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/jquery-confirm.css">
  <link rel="stylesheet" href="../css/bs4.pop.css">
  <!-- Custom styles for this template -->
  <link href="../css/sidebar.css" rel="stylesheet">
  <link href="../css/main.css" rel="stylesheet">
  <link href="../css/custom-modal.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/forms.css">

</head>

<body> 

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="" id="sidebar-wrapper">
      <div class="sidebar-heading">MEDICAL MANAGEMENT SYSTEM</div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item"><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a>
        <a href="consult.php" class="list-group-item"><i class="fa fa-wheelchair" aria-hidden="true"></i>Consult</a>
        <a href="patient.php" class="list-group-item"><i class="fa fa-file-text-o" aria-hidden="true"></i>Patient</a>
        <a href="medicine.php" class="list-group-item"><i class="fa fa-medkit" aria-hidden="true"></i>Medicines</a>
        <a href="diagnose.php" class="list-group-item"><i class="fa fa-address-book" aria-hidden="true"></i>Diagnosed</a>
        <a href="#" class="list-group-item"><i class="fa fa-users" aria-hidden="true"></i>Users</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand navbar-light bg-white border-bottom">
        <span id="menu-toggle"><i class="fa fa-align-justify"></i></span>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user" aria-hidden="true"></i>User
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../components/logout.php">Log Out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">

        <!-- content -->