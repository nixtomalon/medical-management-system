<?php require '../components/header.php'?>

<?php
session_start();
if(!isset($_SESSION['id']))
{
    header('Location:login.php');
}
?>


<div class="container-fluid page-content mt-3">
    <div class="container-fluid p-0 m-0">
        <h5 class="content-title">patients</h5>
    </div>
    <div class="container-fluid rounded shadow m-0 p-2 bg-white" style="border-top:solid 4px #112232">
        <table width="100%" class="table table-sm table-bordered table-hover" id="patientTable">
            <thead >
                <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Birth date</th>
                    <th scope="col">Contact number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<?php require '../components/add-patient-modal.php'?>
<?php require '../components/edit-patient-modal.php'?>
<?php require '../components/footer.php'?>