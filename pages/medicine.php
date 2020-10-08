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
        <h5 class="content-title">Medicines</h5>
    </div>
    <div class="container-fluid rounded shadow m-0 p-2 bg-white" style="border-top:solid 4px #112232">

        <?php require '../components/add-medicine-modal.php'?>
        <?php require '../components/edit-medicine-modal.php'?>

        <table width="100%" class="table table-sm table-bordered table-hover" id="medTable">
            <thead >
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">MiliGram</th>
                    <th scope="col">Expiration Date</th>
                    <th scope="col">Tablet/Capsule</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>

    </div>  
</div>

<?php require '../components/footer.php'?>