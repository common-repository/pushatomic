(function( $ ) {
	'use strict';


	 $(function() {

		var sending = false;

		var isPuhsatomicActive = isValidPushatomicId(pushatomic_back_js['pushatomic-id'])

		if(isPuhsatomicActive){
			$("#pushatomic-activate-btn").hide();
            $("#pushatomic-change-btn").show();
			$(".pushatomic-config").show();
			$(".pushatomic-account-alert").hide();
			$(".pushatomic-id-description").hide();
		}else {
			$("#pushatomic-activate-btn").show();
            $("#pushatomic-change-btn").hide();
			$(".pushatomic-config").hide();
			$(".pushatomic-id-description").show();
		}
		

		$(".pushatomic-activate").click(function(event){
	  		event.preventDefault();
	  		
	  		isPuhsatomicActive = isValidPushatomicId($('#pushatomic-id').val())
	  		if(isPuhsatomicActive) {
            	showNotification(NOTIFICATION_TYPE.success, pushatomic_back_js['txt-pushatomic-is-active']);
            	$(".pushatomic-config").show()
            	$(".pushatomic-account-alert").hide()
            	$(".pushatomic-id-description").hide()

            	$("#pushatomic-activate-btn").hide();
            	$("#pushatomic-change-btn").show();
            	promptSectionShow()
            	saveData();
            }else{
            	showNotification(NOTIFICATION_TYPE.error, pushatomic_back_js['txt-pushatomic-is-incorrect']);
            	$(".pushatomic-config").hide()
            	$(".pushatomic-account-alert").show()
            	$(".pushatomic-id-description").show()

            	$("#pushatomic-activate-btn").show();
            	$("#pushatomic-change-btn").hide();

            	promptSectionShow()
            	saveData();
            }
	  	})
 

		function isValidPushatomicId(token){
			try{
				var id = atob(token)
				return id == parseInt(id, 10);
			}catch(e){
				return false
			}
		}


		$('.pushatomic-custom-icon-upload').click(function() {
		    var send_attachment_bkp = wp.media.editor.send.attachment;
		    wp.media.editor.send.attachment = function(props, attachment) {
		       
		        $('.pushatomic-custom-icon-preview').attr('src', attachment.url);
		        $('#pushatomic-custom-icon').val(attachment.url);
		        $('.pushatomic-preview-icon').attr('src', attachment.url);

		        wp.media.editor.send.attachment = send_attachment_bkp;
		    }
		    wp.media.editor.open();
		    return false;
		});


		$('.pushatomic-custom-icon-remove').click(function() {

		    $('.pushatomic-custom-icon-preview').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D');
		    $('#pushatomic-custom-icon').val('data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D');
		    $('.pushatomic-preview-icon').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D');

		    return false;
		});




		function saveData() {
		  	if(sending) {
		  		return
		  	}


		  	var data = {
		  		'action': pushatomic_back_js.action_save_settings,
		  		'nonce' : pushatomic_back_js.nonce,
		  		'pushatomic-enabled' : $('#pushatomic-enabled').val(),
		  		'pushatomic-id' : $('#pushatomic-id').val(),
		  		'pushatomic-prompt' : $('#pushatomic-prompt').val(),
		  		'pushatomic-z-index' : $('#pushatomic-z-index').val(),
		  		'pushatomic-closed-days' : $('#pushatomic-closed-days').val(),
		  		'pushatomic-title' : $('#pushatomic-title').val(),
		  		'pushatomic-accept-button' : $('#pushatomic-accept-button').val(),
		  		'pushatomic-decline-button' : $('#pushatomic-decline-button').val(),
		  		'pushatomic-show-custom-icon' : $('#pushatomic-show-custom-icon').val(),
		  		'pushatomic-custom-icon' : $('#pushatomic-custom-icon').val(),
		  		'pushatomic-position' : $('#pushatomic-position').val(),
		  		'pushatomic-background-color' : $('#pushatomic-background-color').val(),
		  		'pushatomic-text-color' : $('#pushatomic-text-color').val(),
		  		'pushatomic-accept-button-background-color' : $('#pushatomic-accept-button-background-color').val(),
		  		'pushatomic-accept-button-text-color' : $('#pushatomic-accept-button-text-color').val(),
		  		'pushatomic-decline-button-background-color' : $('#pushatomic-decline-button-background-color').val(),
		  		'pushatomic-decline-button-text-color' : $('#pushatomic-decline-button-text-color').val(),
		  		'pushatomic-devices' : $('#pushatomic-devices').val(),
		  		'pushatomic-trigger-mode' : $('#pushatomic-trigger-mode').val(),
		  		'pushatomic-trigger-timeout' : $('#pushatomic-trigger-timeout').val(),
		  		'pushatomic-trigger-scroll' : $('#pushatomic-trigger-scroll').val(),
		  	}



		  	sending = true;
			 $.ajax({
	           type: "POST",
	           url: pushatomic_back_js.ajaxurl,
	           dataType: "json",
	           data: data,
	           success: function(data)
	           {
	           		sending = false;
	                if(data.error == false) {
	                	showNotification(NOTIFICATION_TYPE.success, data.message);
	                }else{
	                	showNotification(NOTIFICATION_TYPE.error, data.message);
	                }

	           },
	           error: function(data) {
	            	sending = false;
	            	showNotification(NOTIFICATION_TYPE.error, 'CONNECTION ERROR');
	            }
	         });

		}


		$(".pushatomic-submit").click(function(event){
		  	event.preventDefault();
		  	saveData()  
		});

		$('.pushatomic-checkbox').on("change", function() {
			if($(this).is(':checked')) {
				$(this).val(1);
			}else{
				$(this).val(0);
			}
		});

		var NOTIFICATION_TYPE = {
			error: 'error',
			warning: 'warning',
			success: 'success',
		}

		function showNotification(type, text) {
			switch(type) {
				case NOTIFICATION_TYPE.success:
				$.growl.notice({ title:'', message: text});
				break;
				case NOTIFICATION_TYPE.error:
				$.growl.error({  title:'', message: text});
				break;
				case NOTIFICATION_TYPE.warning:
				$.growl.warning({ title:'', message: text});
				break
			}
		}



		$('#pushatomic-title').on("change keyup paste", function() {
		    $('.pushatomic-prompt-preview-title').html($(this).val())
		});

		$('#pushatomic-accept-button').on("change keyup paste", function() {
		    $('.pushatomic-prompt-preview-accept-button').html($(this).val())
		});

		$('#pushatomic-decline-button').on("change keyup paste", function() {
		    $('.pushatomic-prompt-preview-decline-button').html($(this).val())
		});


		$('input.pushatomic-input-color').colorPicker({
			opacity: true,
		    renderCallback: function($elm, toggled) {
		      changeElementsColor($elm)
		    }
		});


		$("#pushatomic-prompt").on("change", function() {

			if($( this ).val() == 1) {
				$('.pushatomic-prompt-settings').show()
				$(".pushatomic-prompt-preview").sticky({topSpacing:$('#wpadminbar').height() - 5});

				$('.pushatomic-prompt-0').hide()
				$('.pushatomic-prompt-1').show()

			}else{
				$('.pushatomic-prompt-settings').hide()
				$('.pushatomic-prompt-0').show()
				$('.pushatomic-prompt-1').hide()
			}
			
		});

		

		function promptSectionShow(){
			

			if($("#pushatomic-prompt").val() == 1 && isPuhsatomicActive) {
				$('.pushatomic-prompt-settings').show()
				$(".pushatomic-prompt-preview").sticky({topSpacing:$('#wpadminbar').height() - 5});

				$('.pushatomic-prompt-0').hide()
				$('.pushatomic-prompt-1').show()
			}else{
				$('.pushatomic-prompt-settings').hide()

				$('.pushatomic-prompt-0').show()
				$('.pushatomic-prompt-1').hide()
			}


		}

		promptSectionShow()

		$("#pushatomic-show-custom-icon").on("change", function() {
			if($(this).is(':checked')) {
				$('.pushatomic-preview-icon').attr('src', pushatomic_back_js['pushatomic-custom-icon']);
				$('.pushatomic-custom-icon').show()	
			}else{

				$('.pushatomic-preview-icon').attr('src', pushatomic_back_js['bell-icon']);

				$('.pushatomic-custom-icon').hide()
			}
		});

		if($("#pushatomic-show-custom-icon").is(':checked')) {
			$('.pushatomic-preview-icon').attr('src', pushatomic_back_js['pushatomic-custom-icon']);
			$('.pushatomic-custom-icon').show()
		}else{
			$('.pushatomic-preview-icon').attr('src', pushatomic_back_js['bell-icon']);
			$('.pushatomic-custom-icon').hide()
		}


		$("#pushatomic-trigger-mode").on("change", function() {
			formatTriggerInputs($( this ).val())
		});
		

		function formatTriggerInputs(val){
			switch(val){
				case 'timeout':
				$('#pushatomic-trigger-timeout-row').show()
				$('#pushatomic-trigger-scroll-row').hide()
				break;

				case 'scroll':
				$('#pushatomic-trigger-timeout-row').hide()
				$('#pushatomic-trigger-scroll-row').show()
				break;

				default:
				$('#pushatomic-trigger-timeout-row').hide()
				$('#pushatomic-trigger-scroll-row').hide()
				break;
			}
		}

		formatTriggerInputs(pushatomic_back_js['pushatomic-trigger-mode'])

		function changeElementsColor($elm) {
			 var id = $elm.attr('id');
		      if ($elm.text) {
		      	switch(id){

		      		case 'pushatomic-background-color':
		      		 $('.pushatomic-prompt-preview-wrap').css({'background-color':$elm.text});
		      		break;

		      		case 'pushatomic-text-color':
		      		 $('.pushatomic-prompt-preview-title').css({'color':$elm.text});
		      		break;

		      		case 'pushatomic-accept-button-background-color':
		      		 $('.pushatomic-prompt-preview-accept-button').css({'background-color':$elm.text});
		      		break;

		      		case 'pushatomic-accept-button-text-color':
		      		 $('.pushatomic-prompt-preview-accept-button').css({'color':$elm.text});
		      		break;

		      		case 'pushatomic-decline-button-background-color':
		      		 $('.pushatomic-prompt-preview-decline-button').css({'background-color':$elm.text});
		      		break;

		      		case 'pushatomic-decline-button-text-color':
		      		 $('.pushatomic-prompt-preview-decline-button').css({'color':$elm.text});
		      		break;
		      		 
		      		break;

		      		
		      	}
			}
		}
		var protocol = window.location.href.indexOf("https://")==0?"https":"http";
		if(protocol == "http"){
			$('#pushatomic-https-warning').show();
		}
		$('.pushatomic-admin').show();
})
})( jQuery );