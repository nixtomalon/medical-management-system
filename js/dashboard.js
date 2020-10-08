$(document).ready(function(){

    getUsers()
    getPatients()
    getMedicines()
    getDiagnose()

    function getUsers() {
        $.ajax({
            url: "../database/api/users/get-all-users.php",
            type: "GET",
            dataType:"json",  
            success: function(data) {
                $('.user').html(data.length)
            }
        })
    }

    function getPatients() {
        $.ajax({
            url: "../database/api/patients/get-all-patient.php",
            type: "GET",
            dataType:"json",  
            success: function(data) {
                $('.patient').html(data.length)
            }
        })
    }

    function getMedicines() {
        $.ajax({
            url: "../database/api/medicines/get-all-medicine.php",
            type: "GET",
            dataType:"json",  
            success: function(data) {
                $('.medicine').html(data.length)
            }
        })
    }

    function getDiagnose() {
        $.ajax({
            url: "../database/api/diagnoses/get-all-diagnose.php",
            type: "GET",
            dataType:"json",  
            success: function(data) {
                console.log(data)
                $('.diagnose').html(data.length)
            }
        })
    }
    
})