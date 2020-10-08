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
        <h5 class="content-title">Diagnose</h5>
    </div>
    <div class="container-fluid rounded shadow m-0 p-2 bg-white" style="border-top:solid 4px #112232">

        <table width="100%" class="table table-sm table-bordered table-hover" id="patientRecordTable">
            <thead>
                <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Full name</th>
                    <th scope="col">Contact number</th>
                    <th scope="col">Diagnose</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>

        
        <div id="record-patient-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-1">
                        <h6 class="modal-title m-1" id="exampleModalLabel">PRESCRIPTIONS</h6>
                        <button type="button" class="close m-1 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-4">
                        <table class="table table-sm table-striped table-bordered table-hover" id="medInfoTable">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Miligram</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="details"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> 

<?php require '../components/footer.php'?>