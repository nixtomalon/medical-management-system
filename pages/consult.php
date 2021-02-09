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
        <h5 class="content-title">Consult</h5>
    </div>
    <div class="container-fluid rounded shadow m-0 p-2 bg-white" style="border-top:solid 4px #112232">
        <div class="row">
            <div class="column pr-2" id="c1">
                <p id="pwarning" class="consult-title">PATIENT INFORMATION</p>
                <form>
                    <div class="row">
                        <div class="col-25">
                            <label for="id_num">ID or Name</label>
                        </div>
                            <div class="col-75">
                        <input type="text" id="p_idnum" required>
                    </div>   
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="pname">Name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="pname" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="purpose">Diagnose</label>
                        </div>
                        <div class="col-75">
                            <textarea type="text" id="purpose" rows="3" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="column pl-2" style="border-left:solid 2px #112232;">
                <p id="mwarning" class="consult-title">MEDICINE</p>
                <form style="height:auto">
                    <div class="row">
                        <div class="col-25">
                            <label for="p_med">Name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="p_med" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="p_brand">Brand</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="p_brand" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="p_mg">Miligram</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="p_mg" rows="3" readonly></input>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="p_quan">Quantity</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="p_quan" rows="3" required></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid p-0 mt-2">
            <p class="consult-title">PRESCRIPTIONS LIST</p>
                <table class="table table-sm table-bordered table-hover" id="theTable">
                    <thead>
                        <tr>
                            <th style="width:5%">ID</th>
                            <th style="width:30%">Name</th>
                            <th style="width:20%">Brand</th>
                            <th style="width:15%">Miligram</th>
                            <th style="width:15%">Quantity</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="presTable"> 
                    </tbody>
                    <tbody id="presTable1"> 
                    </tbody>
                </table>
                <div class="container-fluid btn-consult p-0 m-0 d-flex">
                    <div>
                        <button type="button" class="btn consult btn-labeled btn-sm btn-primary" id="addpres"><span class="btn-label"><i class="fa fa-plus fa-sm m-0"></i></span>medicine</button>
                        <button type="button" class="btn consult btn-labeled btn-sm btn-success" id="btnnext"><span class="btn-label"><i class="fa fa-check fa-sm m-0"></i></span>proceed</button>
                        <button type="button" class="btn consult btn-labeled btn-sm btn-danger" id="btncancel"><span class="btn-label"><i class="fa fa-close fa-sm m-0"></i></span>cancel</button>
                    </div>
                    <div class="ml-auto d-flex">
                        <p class="align-self-center m-1" style="color:black; font-weight:bold; font-size:.75rem;">TOTAL ITEM(S): <span id="item-num"> 0 </span></p>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php require '../components/footer.php'?>