<?php require '../components/header.php'?>

<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location:login.php');
}
?>

<div class="container-fluid page-content mt-3">

    <div class="row mb-3 p-0">
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fa fa-users fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Users</h6>
                            <h1 class="display-4 user"></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fa fa-wheelchair fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Patients</h6>
                            <h1 class="display-4 patient"></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-medkit fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Medicines</h6>
                            <h1 class="display-4 medicine"></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 py-2">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body">
                            <div class="rotate">
                                <i class="fa fa-address-book fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Diagnose</h6>
                            <h1 class="display-4 diagnose"></h1>
                        </div>
                    </div>
                </div>
            </div>

</div>

<?php require '../components/footer.php'?>


      
