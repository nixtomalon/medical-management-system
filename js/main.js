$(document).ready(function () {
    $('#mDate').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    })
    $('#mDate1').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    })
    $('#birthdate').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    })
    $("#menu-toggle").click(function(e) {
        e.preventDefault()
        $("#wrapper").toggleClass("toggled")
    })
   
//     var enrollType;
//   //  $("#div_id_As").hide();
//     $("input[name='As']").change(function() {
//         memberType = $("input[name='select']:checked").val();
//         providerType = $("input[name='As']:checked").val();
// 		toggleIndividInfo();
//     });
    
//     $("input[name='select']").change(function() {
// 		memberType = $("input[name='select']:checked").val();
// 		toggleIndividInfo();
// 		toggleLearnerTrainer();
// 	});
	
// 	function toggleLearnerTrainer() {

// 	if (memberType == 'P' || enrollType=='company') {
// 		$("#cityField").hide();
// 		$("#providerType").show();
// 		$(".provider").show();
// 		$(".locationField").show();
// 		if(enrollType=='INSTITUTE'){
// 			$(".individ").hide();
// 		}
	
// 	} 
//     else {
// 		$("#providerType").hide();
// 		$(".provider").hide();
// 		$('#name').show();
// 		$("#cityField").hide();
// 		$(".locationField").show();
// 		$("#instituteName").hide();
// 		$("#cityField").show();
		
// 	}
//     }
//     function toggleIndividInfo(){

// 	if(((typeof memberType!=='undefined' && memberType == 'TRAINER')||enrollType=='INSTITUTE') && providerType=='INDIVIDUAL'){
// 		$("#instituteName").hide();
// 		$(".individ").show();
// 		$('#name').show();
// 	}
//     else if((typeof memberType!=='undefined' && memberType == 'TRAINER')|| enrollType=='INSTITUTE'){
// 		$('#name').hide();
// 		$("#instituteName").show();
// 		$(".individ").hide();
// 	}
//     }
});