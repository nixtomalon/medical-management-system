<?php
session_start();
if(isset($_SESSION['id']))
{
  header('Location:dashboard.php');
}
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../vendor/jquery/dist/jquery.js"></script>
<link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="../vendor/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bs4.pop.css">
<style>
/* body {font-family: Arial, Helvetica, sans-serif;background-color:#f3f3f3;}
* {box-sizing: border-box;} */

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
  margin-top:2%;
} 

.icon {
  padding: 10px;
  background: #E8ECEF;
  color: black;
  min-width: 40px;
  text-align: center;
  border-bottom-left-radius: 5px;
  border-top-left-radius: 5px;
}


/* .input-field:focus {
  border: 2px solid dodgerblue;
} */

/* Set a style for the submit button */
/* .btn {
  background-color: dodgerblue;
  color: white;
  padding: 10px 10px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

form{
    width:400px;
    margin:auto;
    background-color:#fff;
    padding:10px;
    margin-top:8%;
    position:absolute;
    top:4%;
    left:35%;
    border:solid 1px #c3c3c3;
}

.btn:hover {
  opacity: 1;
}

.toast {
  width: 20%;
} */

.container-fluid {
  box-sizing: border-box;
  height: 100vh;
  background-color: #E8ECEF;
}

.col-3 {
  margin-top: 10%;
}

input[type=text],input[type=password] {
    border: none;
    outline: 0;
    border-radius: 0%;
    width: 100%;
    padding: 10px;
    font-size: .80rem;
    border-bottom-right-radius: 5px;
  border-top-right-radius: 5px;
}

.custom-btn {
  border:none;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    outline: 0;
    border: none;
    width: 100%;
    background-color : #112232;
    font-size: .85rem;
    border-radius: 5px;
    padding: 8px 2px;
    color: #fff;
    font-weight: bold;
}
.custom-btn:hover {
  background-color: hsl(208, 49%, 18%);
}
.custom-btn:focus {
  outline: 0;
  border: none;
}

img {
  width : 100%;
  height: 100px;
  margin-bottom: 1%;
}



</style>
</head>
<body>
<!-- <form>
    <h4>Enter your Information</h4>
    <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Username" name="log_n" id="log_n">
    </div>
    <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Password" name="log_p" id="log_p">
    </div>
    <input type="button" class="btn btn-primary pull-right" value="Login" id="btnlog" class="btn">
</form> -->
<div class="container-fluid">
  <div class="row justify-content-center">
    
    <div class="col-3 shadow p-4 bg-white rounded border">
    <img src="../images/2.png" alt="logo">
        <form style="width:100%;margin:auto;" class="mt-4">
          <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field border" type="text" placeholder="Username" name="log_n" id="log_n">
          </div>
          <div class="input-container">
              <i class="fa fa-key icon"></i>
              <input class="input-field border" type="password" placeholder="Password" name="log_p" id="log_p">
          </div>
          <button type="button" class="custom-btn mt-2" id="btnlog">Log In</button>
        </form>
    </div>
  </div>
</div>
</body>

</html>
<script>
$(document).ready(function(){
  console.log('wapo');
  $("#btnlog").click(function(){
        var uname = $("#log_n").val()
        var pwd = $("#log_p").val()
        if(uname == "" || pwd == ""){
          bs4pop.notice('Field Required',{
            type: 'danger',
            position: 'topright',
            appendType: 'append',
            closeBtn: false,
            className: ''
          })
        }
        else{
            $.ajax({
                dataType: "json",
                url:"../database/api/users/check-user.php",
                type: "GET",
                data:{uname:uname,pwd:pwd},
                success:function(data){
                    if(data.messege == "yes"){
                        window.location.replace("dashboard.php")
                    } else{
                        bs4pop.notice('user not register',{
                            type: 'danger',
                            position: 'topright',
                            appendType: 'append',
                            closeBtn: false,
                            className: ''
                        })
                        //$('.login-error').toast('show')
                    }
                }
            })
        }
    })
    $('#log_p').keypress(function(e) {
        var key = e.which
        if (key == 13) // the enter key code
        {
          $('#btnlog').click()
          return false
        }
      })
})
</script>
<?php require '../components/footer.php'?>
