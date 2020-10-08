$(document).ready(function() {

    getAllPatient()
    function getAllPatient() {
        var patientData = []

        $.ajax({
            url:"../database/api/patients/get-all-patient.php",
            type:"GET",
            dataType:"json",
            async: false,
            success:function(data){
                $.each(data,function(key,val){ 
                    val.action = "<center><button type=\"button\" class=\"btn-circle\"><i data-toggle=\"modal\" data-target=\"#edit-modal-patient\" class=\"fa fa-pencil modal-edit-patient\" id=\""+val.patient_id+"\"></i></button><button type=\"button\" class=\"btn-circle\"><i class=\"fa fa-paper-plane messege-patient\" id=\""+val.patient_id+"\"></i></button></center>"
                })
                patientData = data
            }
        })
         return patientData
    }

    $('#patientTable').DataTable( {
        destroy: true,
        data: getAllPatient(),
        dom: "<'row'<'col-sm-6 para'B><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",   // dataset    
        columns: [
            {'data' : 'patient_id'},
            {'data' : 'fullname'},
            {'data' : 'gender'},
            {'data' : 'birthdate'},
            {'data' : 'contact_number'},
            {'data' : 'address'},
            {'data' : 'action'},
        ],
        buttons: [
            {
                extend:    'copy',
                text: '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'csv',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'print'
            },
            {
                text: '<i class="fa fa-registered"></i>',
                action: function(e, dt, node, config) {
                    $('#add-patient-modal').modal('show')
                }
            }
        ]
    })

    $('#psubmit').click(function(){
        var newPatient = {}
        newPatient['fullname'] = $('#fullname').val()
        newPatient['birthdate'] = $('#birthdate').val()
        newPatient['gender'] = $('#gender').val()
        newPatient['address'] = $('#paddress').val()
        newPatient['number'] = $('#pnumber').val()
        if(newPatient['fullname'] == "" || newPatient['birthdate'] == "" || newPatient['gender'] == "" || newPatient['address'] == "" || newPatient['number'] == "") {
            bs4pop.notice('Please enter required field',{
                type: 'warning',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }else{
            $.ajax({
                url :"../database/api/patients/new-patient.php",
                type:"POST",
                dataType:"json",
                async:true,
                data:JSON.stringify(newPatient),
                success:function(data){
                    console.log(data)
                    bs4pop.notice(data.messege,{
                        type: 'info',
                        position: 'topright',
                        appendType: 'append',
                        closeBtn: false,
                        className: ''
                    })
                    $("#add-patient-modal").modal('hide')
                    //reset TABLE
                    var mytable = $('#patientTable').DataTable()
                    mytable.clear().rows.add(getAllPatient()).draw()
                }
            })
        }
    })

    $('#patientTable').on('click','.modal-edit-patient',function(e){
        $.each(getAllPatient(),function(key,val){
            if(e.target.id == val.patient_id){
                $('.e_psubmit').attr('id',e.target.id)
                $('#e_fullname').attr('value',val.fullname)
                $('#e_birthdate').attr('value',val.birthdate)
                $('#e_gender option[value='+val.gender+']').attr('selected','selected')
                $('#e_pnumber').attr('value',val.contact_number)
                $('#e_paddress').attr('value',val.address)
            }
        })
    })

    $('.e_psubmit').click(function(e){
        var editPatient = {}
        editPatient['id'] = e.target.id
        editPatient['fullname'] = $('#e_fullname').val()
        editPatient['birthdate'] = $('#e_birthdate').val()
        editPatient['gender'] = $('#e_gender').val()
        editPatient['address'] = $('#e_paddress').val()
        editPatient['number'] = $('#e_pnumber').val()
        if(editPatient['fullname'] == "" || editPatient['birthdate'] == "" || editPatient['gender'] == "" || editPatient['address'] == "" || editPatient['number'] == "") {
            bs4pop.notice('Please enter required field',{
                type: 'warning',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }else{
            $.ajax({
                url :"../database/api/patients/update-patient.php",
                type:"PUT",
                dataType:"json",
                async:true,
                data:JSON.stringify(editPatient),
                success:function(data){
                    console.log(data)
                    bs4pop.notice(data.messege,{
                        type: 'info',
                        position: 'topright',
                        appendType: 'append',
                        closeBtn: false,
                        className: ''
                    })
                    $("#edit-modal-patient").modal('hide')
                    //reset TABLE
                    var mytable = $('#patientTable').DataTable()
                    mytable.clear().rows.add(getAllPatient()).draw()
                }
            })
        }
    })

    // $('#patientTable').on('click','.modal-remove-patient',function(e){
    //     $.each(getAllPatient(),function(key,val){
    //         if(e.target.id == val.patient_id) {
    //             $.confirm({
    //                 columnClass: 'col-md-4 col-md-offset-4',
    //                 title: 'Warning',
    //                 icon: 'fa fa-warning',
    //                 content: 'Remove ' +val.fullname+ '?',
    //                 type: 'red',
    //                 typeAnimated: true,
    //                 theme:'bootstrap',
    //                 buttons: {
    //                     OK: {
    //                         text: 'OK',
    //                         btnClass: 'btn-danger btn-sm',
    //                         action: function() {
    //                             removePatient(e.target.id)

    //                             //reset TABLE
    //                             var mytable = $('#patientTable').DataTable()
    //                             mytable.clear().rows.add(getAllPatient()).draw()
    //                         }
    //                     },
    //                     CANCEL: function () {
    //                     }
    //                 }
    //             })
    //         }
    //     })
    // })

    // function removePatient(id) {
    //     $.ajax({
    //         url:"../database/api/medicines/remove-medicine.php",
    //         type:"DELETE",
    //         dataType:"json",
    //         async:false,
    //         data: JSON.stringify({ remove: id }) ,
    //         success:function(data){
    //             bs4pop.notice(data.messege,{
    //                 type: 'info',
    //                 position: 'topright',
    //                 appendType: 'append',
    //                 closeBtn: false,
    //                 className: ''
    //             })
    //         }
    //     })
    // }
})