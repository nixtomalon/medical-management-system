$(document).ready(function(){

    recordsDatatable()
    populateDatatable()

    function recordsDatatable() {
        var dataset
        $.ajax({
            url:"../database/api/diagnoses/get-all-diagnose.php",
            type:"GET",
            async: false,
            dataType:"json",
            success: function(data) {
                $.each(data,function(key,val){
                    val.action = "<center> <button type=\"button\" class=\"btn-circle shadow\"><i data-toggle=\"modal\" data-target=\"#record-patient-modal\" class=\"fa fa-info-circle record-patient fa-lg\" id=\""+val.diagnose_id+"\"></i></button></center>"
                })
                dataset = data
            }
        })
        return dataset
    }

    // console.log(recordsDatatable())

    function populateDatatable() {
        $('#patientRecordTable').DataTable( {
            destroy:true,
            data : recordsDatatable(),
            dom: "<'row'<'col-sm-6 para'B><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            columns: [
                {'data' : 'patient_id'},
                {'data' : 'fullname'},
                {'data' : 'contact_number'},
                {'data' : 'diagnose'},
                {'data' : 'date'},
                {'data' : 'action'},
            ],
            buttons: [
                {
                    extend:    'copy',
                    text: '<i class="fa fa-files-o"></i',
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
                }
            ]
        })
        $('#patientRecordTable').on('click','.record-patient',function(e){
            $("#details").empty()
            var hand = $("#details")                    
            $.ajax({
                url:"../database/api/prescriptions/get-prescription.php",
                type:"GET",
                dataType:"json",
                data:{id:e.target.id},
                success:function(data){
                    console.log(data)
                    $.each(data,function(key,val){
                        var row = $("<tr role=\"row\">")
                        row.html("<td>"+val.med_name+"</td>"
                        +"<td>"+val.med_brand+"</td>"
                        +"<td>"+val.miligram+"</td>"
                        +"<td>"+val.quantity+"</td>")
                        hand.append(row)
                    })                                     
                }
            })                                 
        })
    }

})