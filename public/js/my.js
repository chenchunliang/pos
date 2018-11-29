// JavaScript Document
$(function(){
	$('.deletebtn').click(function() {
		//console.log('你確定刪除此項目?');
		var ans =confirm("你確定刪除此項目?");
		
		if(ans){
			var formid=$(this).data('formid');
			console.log(formid);
			$('#'+formid).submit();
		}
	});

	$('#changePassword').click(function() {
		if($('#changePassword_tr').css('display')=="none"){
			$('#admin_password').prop('disabled',false);
		}else{
			$('#admin_password').prop('disabled',true);
		}
		$('#changePassword_tr').toggle(1000);		
	});
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
});