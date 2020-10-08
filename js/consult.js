$(document).ready(function(){

    getmedicines()
    var allMedicines = []
    //save patient
    $("#savePatient").click(function(){
        var newPatient = {}
        newPatient['fullname'] = $("#fullname").val()
        newPatient['address'] = $("#address").val()
        newPatient['birthdate'] = $("#birthdate").val()
        newPatient['gender'] = $("#gender").val()

        if(newPatient['fullname'] == "" || newPatient['address'] == "" || newPatient['birthdate'] =="" || newPatient['gender'] == ""){
            bs4pop.notice('Field required',{
                type: 'danger',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }
        else{
            $.ajax({
                type:"POST",
                url:"../database/api/patients/new-patient.php",
                dataType:"json",               
                data:JSON.stringify(newPatient),
                success:function(data){
                    bs4pop.notice(data.messege,{
                        type: 'info',
                        position: 'topright',
                        appendType: 'append',
                        closeBtn: false,
                        className: ''
                    })
                    $("#myModal").find(':input').each(function(){
                        switch(this.type){
                            case 'text':
                            case 'date': $(this).val("")
                            break
                        }
                    })
                    $("#myModal").modal('hide')
                }
            })
        }
    })


    //cancel patient
    $("#btncancel").click(function(){
        $('#presTable1').empty();
        $(".col-xs-12").find(':input').each(function(){
            switch(this.type){
                case 'text':
                case 'textarea': $(this).val("");
                break;
                }
        });
        if ($("#presTable1").children().length == 0) {
            $("#presTable").html("<tr id =\"dont\" style=\"text-align:center\"><th colspan=\"6\">No Prescription</th></tr>");
        }
    });

    $('#p_idnum').keypress(function(e){
        var key = e.which;
        if (key == 13) // the enter key code
        {
            $("#p_idnum").focusout();
            return false;
        }
    })

    

    //patient searching
    $("#p_idnum").focusout(function(){
        var id = $("#p_idnum").val()
        if(id != ""){
            $.ajax({
                type:"GET",
                url:"../database/api/patients/check-patient.php",
                dataType:"json",               
                data:{id:id},
                success:function(data){
                    if(data.id){
                        $("#pwarning").css("color","black")
                        $("#pwarning").css("background-color","#E8ECEF")
                        $("#pwarning").html("PATIENT INFORMATION")
                        $("#pname").val(data.fullname)
                        $("#purpose").focus()
                    }else{
                        $("#pwarning").css("background-color","#ca5154")
                        $("#pwarning").css("color","white")
                        $("#pwarning").html("PATIENT RECORD NOT REGISTER")
                        $("#p_idnum").val('')
                        $("#pname").val('')
                    }
                }
            })
        }
    })

    //searching medicine
    var medid;
    $("#p_med").typeahead({
        displayText: function(item) {
            return item.name+" "+item.brand;
        },
        afterSelect: function(item) {
            $('#p_med').val(item.name);
            $("#p_mg").val(item.mg);
            $("#p_brand").val(item.brand);
            medid = item.id;
        },
        items: 4,
        hint: true,
        highlight: true,
        minLength: 1,
        source:function(query,result){
            $.ajax({
                url:"../database/api/medicines/get-medicine.php",
                type:"GET",
                dataType:"json",
                data:{data:query},
                success:function(data){
                    var medID=[],medNames = [],medBrand=[],medMiligram = [], allmed=[];
                    if(data.messege){
                        $('#mwarning').html("NO MEDICINE AVAILABLE")
                        $('#mwarning').css('background-color','#ca5154')
                        $("#mwarning").css("color","white")
                    } 
                    else {
                        $('#mwarning').html("PRESCRIPTION")
                        $("#mwarning").css("color","black")
                        $('#mwarning').css('background-color','#E8ECEF')
                        $.each( data, function ( key, val ){
                            medID.push(val.medID);
                            medNames.push(val.medName);
                            medBrand.push(val.medBrand);
                            medMiligram.push(val.medMiligram);
                        });
                        for(var i = 0 ; i < medID.length ; i++){
                            allmed.push({id : medID[i], name : medNames[i],brand : medBrand[i] ,mg : medMiligram[i]});
                        }                          
                    }
                    console.log(allmed);
                    return result(allmed);
                }
            })
        }
    });

    //adding medicine to list

    var presItem = 0
    $('#p_quan').keypress(function(e) {
        var key = e.which;
        if (key == 13) // the enter key code
        {
            $('#addpres').click();
            return false;
        }
    })
    $("#addpres").click(function(){
        var pmedID = medid
        var pmedname = $("#p_med").val();
        var pmedBrand = $("#p_brand").val();
        var pmili = $("#p_mg").val();
        var pquan = $("#p_quan").val();
        if($("#p_med").val() == "" || $("#p_mg").val() == "" || $("#p_quan").val() == "" || $('#p_idnum').val() == "" || $('#purpose').val() == ""){
            bs4pop.notice('Prescription field required',{
                type: 'danger',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }
        else if($("#p_quan").val() <= 0){
            bs4pop.notice('Please enter a valid quantity',{
                type: 'danger',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }
        else{
            $.each(allMedicines,function(key,val){
                if(pmedID == val.medID){
                    var quan = parseInt(pquan)
                    var medStock = parseInt(val.medStock)
                    if(medStock < quan) {
                        bs4pop.notice(medStock+' Tablet/Capsule left',{
                            type: 'danger',
                            position: 'topright',
                            appendType: 'append',
                            closeBtn: false,
                            className: ''
                        })
                    }else {
                        $('#presTable').empty()
                        var but = $('<center><i class=\"fa fa-trash fa-lg pres-remove icon p-0\"></i></center>').click(function(){
                            presItem--
                            $('#item-num').html(presItem)
                            $(this).parent().parent().remove();
                            if ($("#presTable1").children().length == 0) {        
                                counter=0;                                
                                $("#presTable").html("<tr id =\"dont\" style=\"text-align:center\"><th colspan=\"6\">No Prescription</th></tr>");                      
                            }
                        })
                        var buttontd = $('<td></td>').append(but);
                        var tr = $("<tr><td>"+pmedID+"</td><td>"+pmedname+"</td><td>"+pmedBrand+"</td><td>"+pmili+"</td><td class=\"td w-25\" id=\""+quan+"\">"+quan+"</td></tr>").append(buttontd)
                        presItem++
                        $('#item-num').html(presItem)
                        $("#presTable1").append(tr),$("#presTable1").append(tr),$("#p_med").val(''),$("#p_mg").val('')
                        $("#p_brand").val(''),$("#p_quan").val(''),$('#p_med').focus()
                    }
                }
            })
        }           
    })

    $('#theTable').on('dblclick','.td',function (e) {
        var currentEle = $(this)
        var value = $(this).html()
        updateVal(currentEle, value)
    })

    function updateVal(currentEle, value){
        $(currentEle).html('<input class="thVal" type="text" value="' + value + '" />')
        $(".thVal").focus()
        $(".thVal").keyup(function (event) {
            if (event.keyCode == 13) {
                $(currentEle).html($(".thVal").val().trim())
            }
        })
      
        $(document).click(function () {
              $(currentEle).html($(".thVal").val())
        })
    } 

    var tdid
    $('#modifiedQuantity').on('keypress',function(e){
        e.stopPropagation()
        if(e.which == 13) {
            //$('.',tdid).val($(this).val())
            console.log(tdid)
            $('#',tdid).html($(this).val())
        }
    })

        
    $("#btnnext").click(function(){
        var diagnoseData = {}
        diagnoseData['patientid']= $("#p_idnum").val()
        diagnoseData['diagnose'] = $("#purpose").val()
        diagnoseData['date'] = output
        diagnoseData['medicine'] = storeinJson()
        if($('#p_idnum').val() == "" || $('#purpose').val() == "" || diagnoseData['medicine'].length <= 0) {
            bs4pop.notice('Please enter patient or prescription information',{
                type: 'danger',
                position: 'topright',
                appendType: 'append',
                closeBtn: false,
                className: ''
            })
        }
        else{
            $.confirm({
                columnClass: 'col-md-4 col-md-offset-4',
                title: 'Confirmation',
                icon: 'fa fa-info',
                content: 'Proceed to next patient ?' ,
                type: 'blue',
                typeAnimated: true,
                theme:'bootstrap',
                buttons: {
                    OK: {
                        text: 'OK',
                        btnClass: 'btn-info btn-sm',
                        action: function() {
                            presItem = 0
                            $('#item-num').html(presItem)
                            $.ajax({
                                url:"../database/api/diagnoses/new-diagnose.php",
                                type:"POST",
                                dataType:"json",
                                data:JSON.stringify(diagnoseData),
                                success:function(ms){
                                    bs4pop.notice(ms.messege,{
                                        type: 'info',
                                        position: 'topright',
                                        appendType: 'append',
                                        closeBtn: false,
                                        className: ''
                                    })
                                    $("#presTable1").empty()
                                    if ($("#presTable1").children().length == 0) {                                        
                                        $("#presTable").html("<tr id =\"dont\" style=\"text-align:center\"><th colspan=\"6\">No Prescription</th></tr>")                      
                                    }
                                    $("#c1").find(':input').each(function(){
                                        switch(this.type){
                                            case 'text':
                                            case 'textarea':
                                            case 'date': $(this).val("")
                                            break
                                            }
                                    })                                                                           
                                }                                   
                            })
                        }
                    },
                    CANCEL: function() {}
                }
            })
        }
    })
    if ($("#presTable1").children().length == 0) {                                        
        $("#presTable").html("<tr id =\"dont\" style=\"text-align:center\"><th colspan=\"6\">No Prescription</th></tr>")                     
    }
    function storeinJson(){
        var TableData = new Array();
        $("#theTable tr").each(function(row, tr){
            TableData[row]={
                "medid" : $(tr).find('td:eq(0)').text(),
                "medname" : $(tr).find('td:eq(1)').text(), 
                "medmg" :$(tr).find('td:eq(3)').text(),
                "medquan" : $(tr).find('td:eq(4)').text()
            }
        })
        TableData.shift()
        return TableData
    }

    function getmedicines(){
        $.ajax({
            url:"../database/api/medicines/get-all-medicine.php",
            type:"POST",
            dataType:"json",
            success:function(data){
                console.log(data)
                allMedicines = data
            }
        })
    }   

    $(".dropdown-toggle").dropdown()
    var d = new Date()
    var month = d.getMonth()+1
    var day = d.getDate()
    var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day
    $("#accept").click(function(){
        alert(output)
    })
})