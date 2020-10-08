$(document).ready(function(){

   // var dataset = getAllmedicines()

    function getAllmedicines() {

        var medData = []

        $.ajax({
            url:"../database/api/medicines/get-all-medicine.php",
            type:"GET",
            dataType:"json",
            async: false,
            success:function(data){
                $.each(data,function(key,val){ 
                    val.action = "<center><button type=\"button\" class=\"btn-circle\"><i data-toggle=\"modal\" data-target=\"#myModal1\" class=\"fa fa-pencil modal-edit-med\" id=\""+val.medID+"\"></i></button><button type=\"button\" class=\"btn-circle\"><i class=\"fa fa-trash modal-remove-med\" id=\""+val.medID+"\"></i></button></center>"
                })
                medData = data
            }
        })
         return medData
    }

    $('#medTable').DataTable( {
        destroy: true,
        data: getAllmedicines(),
        dom: "<'row'<'col-sm-6 para'B><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",   // dataset    
        columns: [
            {'data' : 'medID'},
            {'data' : 'medName'},
            {'data' : 'medBrand'},
            {'data' : 'medMiligram'},
            {'data' : 'medExpdate'},
            {'data' : 'medStock'},
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
            },
            {
                text: '<i class="fa fa-plus"></i>',
                action: function(e, dt, node, config) {
                    $('#myModal').modal('show')
                }
            }
        ]
    })

    $('#medTable').on('click','.modal-edit-med',function(e){
        var editID = e.target.id, data = getAllmedicines()
        $.each(data,function(key,val){
            if(editID == val.medID){
                $('.udpatemed').attr('id',editID)
                $('#mName1').attr('value',val.medName)
                $('#mBrand1').attr('value',val.medBrand)
                $('#mMg1').attr('value',val.medMiligram)
                $('#mDate1').attr('value',val.medExpdate)
                $('#mStock1').attr('value',val.medStock)
            }
        })
    })

    $('#medTable').on('click','.modal-remove-med',function(e){
        var removeID = e.target.id, data = getAllmedicines()
        
        $.each(data,function(key,val){
            if(removeID == val.medID){
                $.confirm({
                    columnClass: 'col-md-4 col-md-offset-4',
                    title: 'Warning',
                    icon: 'fa fa-warning',
                    content: 'Remove ' +val.medName+ ' ?' ,
                    type: 'red',
                    typeAnimated: true,
                    theme:'bootstrap',
                    buttons: {
                        OK: {
                            text: 'OK',
                            btnClass: 'btn-danger btn-sm',
                            action: function() {
                                removeMedicine(removeID)

                                //reset TABLE
                                var mytable = $('#medTable').DataTable()
                                mytable.clear().rows.add(getAllmedicines()).draw()
                            }
                        },
                        CANCEL: function () {
                        }
                    }
                })
            }
        })
    })

    function removeMedicine(removeID) {
        var removeMed = JSON.stringify({ remove: removeID }) 
        $.ajax({
            url:"../database/api/medicines/remove-medicine.php",
            type:"DELETE",
            dataType:"json",
            async:false,
            data: removeMed,
            success:function(data){
                bs4pop.notice(data.messege,{
                    type: 'info',
                    position: 'topright',
                    appendType: 'append',
                    closeBtn: false,
                    className: ''
                })
            }
        })
    }

    $('.udpatemed').on('click',function(e){
        var medicine = {}
        medicine['id'] = e.target.id
        medicine['name'] = $('#mName1').val()
        medicine['brand'] = $('#mBrand1').val()
        medicine['mg'] = $('#mMg1').val()
        medicine['date'] = $('#mDate1').val()
        medicine['stock'] = $('#mStock1').val()
        $.ajax({
            url :"../database/api/medicines/update-medicine.php",
            type:"PUT",
            dataType:"json",
            async:true,
            data:JSON.stringify(medicine),
            success:function(data){
                bs4pop.notice(data.messege,{
                    type: 'info',
                    position: 'topright',
                    appendType: 'append',
                    closeBtn: false,
                    className: ''
                })
                $('.udpatemed').attr('id',"")
                $('.frmupdate')[0].reset()
                $("#myModal1").modal('hide')
                
                //reset TABLE
                var mytable = $('#medTable').DataTable()
                mytable.clear().rows.add(getAllmedicines()).draw()
            }
        })
    })
    $("#save").on('click',function(){
        var medicineData = {}
        medicineData['mname'] = $("#mName").val();
        medicineData['mbrand'] = $("#mBrand").val();
        medicineData['mmg'] = $("#mMg").val();
        medicineData['mdate'] = $("#mDate").val();
        medicineData['mstock'] = $("#mStock").val();
        console.log(JSON.stringify(medicineData))
        if(medicineData['mname'] == "" || medicineData['mbrand'] == "" || medicineData['mmg'] == "" || medicineData['mdate'] == "" || medicineData['mstock'] == ""){
            bs4pop.notice('Please enter required field',{
                type: 'warning',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }
        else{
            $.ajax({
                dataType: "json",
                url:"../database/api/medicines/new-medicine.php",
                type: "POST",
                async:false,
                data:JSON.stringify(medicineData),
                success:function(res){
                    $("#myModal").find(':input').each(function(){
                        switch(this.type){
                            case 'text':
                            case 'date': $(this).val("");
                            break;
                            }
                    })
                    $('#myModal').modal('hide')
                    bs4pop.notice(res.messege,{
                        type: 'info',
                        position: 'topright',
                        appendType: 'append',
                        closeBtn: false,
                        className: ''
                    })
                    $("#myModal").modal('hide')
                    //reset TABLE
                    var mytable = $('#medTable').DataTable()
                    mytable.clear().rows.add(getAllmedicines()).draw()
                }
            })
        }
    });
})