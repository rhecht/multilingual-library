$(document).ready(function(){
	console.log('im ready');
	console.log(baseUrl);
	$('body').on('click', '.uploadThis', function(e){
        e.preventDefault;

        var fd = new FormData();
        var file = $('#fileUploadElement')[0].files[0];
               
             
        // our AJAX identifier
        fd.append('action', 'cvf_upload_files');        	
       	fd.append('fileuploaded',file);
        // Remove this code if you do not want to associate your uploads to the current page.
        
        $('.uploadError').html('uploading');

        $.ajax({
            type: 'POST',
            url: baseAdminUrl+'/article/upload',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	r = $.parseJSON( response );
            	if(r.error === 'true'){
            		console.log('error');
            		$('.uploadError').html(r.message);
            	}else{

                //$('.upload-response').append(response); // Append Server Response                
               		$('#url').val(r.file_name);
               		$('#size').val(r.file_size);
               		$('#uploadFile').modal('hide');
            	}
            	
            }
        });
    });

});
