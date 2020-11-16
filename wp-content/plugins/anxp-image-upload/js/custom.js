jQuery(document).ready(function(e) {
	
jQuery('#addimage').click(function(e) {
		jQuery( "#msg" ).html('');
		var packagename = jQuery('#packagename').val();
		var packagephoto_data = jQuery('#packagephoto').prop('files')[0];
		var packagephoto2_data = jQuery('#packagephoto2').prop('files')[0];

		var form_data = new FormData();

		form_data.append('packagephoto_name', packagephoto_data);
		form_data.append('packagephoto2_name', packagephoto2_data);
		form_data.append('packagename', packagename);
		form_data.append('action', 'anxp_add_image_ajax');
		
		jQuery.ajax({
			url: action_url_ajax.ajax_url,
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,
			success: function(data){
				if(data != '') {
				jQuery( "#msg" ).append(data);
				} else {
				jQuery( "#msg" ).append('No Data Found');       
				}
			}

		});
	});	
	
});   