$(document).ready(function(){

    var dataset=[],temp=[],count=0,globaldata=[]

    prescripDatatable()
    populateDatatable()

    function prescripDatatable() {

        $.ajax({
            url:"../database/api/prescriptions/get-all-prescription.php",
            type:"GET",
            dataType:"json",
            async:false,
            success:function(data) {
                console.log(data)
                dataset = data
               
            }
        })
        return dataset
    }
    function populateDatatable() {
        $('#medicinetRecordTable').DataTable({
            destroy:true,
            data : prescripDatatable(),
            dom: "<'row'<'col-sm-3'l><'col-sm-6 para'B><'col-sm-3'f>>" +
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
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns:[ 0, 1, 2, 3, 4 ]
                    }
                },
            ]
        })

        $('#medicinetRecordTable').on('click','.prescription',function(e){
            var pID = e.target.id;
            console.log(pID)
            $("#presDetails").empty();
            var hand = $("#presDetails");
            $.each(globaldata,function(key,val){
                if(pID == val.medID){
                    $('#presModal').html(val.medName);
                }
            });
            $.ajax({
                url:"querypost.php",
                type:"POST",
                dataType:"json",
                data:{medmore:pID},
                success:function(data){
                    console.log(data)
                    $.each(data,function(key,val){
                        var row = $("<tr role=\"row\">");
                    row.html("<td>"+val.p_fname+"</td>"+
                    "<td>"+val.mr_quantity+"</td>"
                    +"<td>"+val.pr_date+"</td>");
                    hand.append(row);
                    });                                       
                }
            });
            })
    }

})