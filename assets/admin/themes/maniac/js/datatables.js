$(document).ready(function(){

	
    //$('#book-table').DataTable();
	//console.log('yeah'); 

/*
	//$.fn.dataTable.ext.classes.sPageButton = 'page-link';
	//$.fn.dataTable.ext.classes.sPaging = 'col pagination pagination-sm justify-content-center ';
	//$.fn.dataTable.ext.classes.sInfo = 'col my-2 justify-content-center text-center text-muted '; 

	var checkTable = document.getElementById('datatable');
	var checkControls  = document.getElementsByClassName('datatablefilter');
	var textFilter  = document.getElementsByClassName('listsearch');

	if (checkTable){		
		var oTable = $('#datatable').DataTable({
			paging : true,			
			stateSave : false,
			ordering : true,
			"order": [[ 0, "desc" ]],
			"columnDefs": [ 
				{"targets"  : 'no-sort', "orderable": false,},
				{"targets"  : 'no-search', "searchable": false,}				
			],
			rowReorder: {
            	selector: 'td:nth-child(2)'
        	},
        	responsive: true,
        	"fnDrawCallback": function() {
               biEditables();
            }
			
		});
		
		if(checkControls.length){			
			$('.datatablefilter').each(function(){
				$(this).change(function(){ 
					//Redraw to apply filters
					filter = $(this);					
					find = filter.children('option').filter(':selected').text();					
					match = filter.attr('data-find-exact');					
					if (typeof(match) == "undefined"){
						match=true;
					}else{
						match=false;
					}					
					if ( filter.val() == 0 ){						
						oTable.column(filter.data('colnum')).search('').draw();						
					}else{
						if (match == true){
							find = '^' + find +'$'; // exact match												
							oTable.columns(filter.data('colnum')).search(find,true,false).draw();
						}else{ // don't match exact							
							oTable.columns(filter.data('colnum')).search(find,false,true).draw();
						}
					}					
				});
			});	
		}
		if(textFilter){
			$('#listsearch').on('change keyup click', function () {oTable.search($(this).val(), false, true).draw();});
		}
		
	}

	*/
console.log('im ready');
	$('body').on('click', '.upload-form .btn-upload', function(e){
		        e.preventDefault;

		        var fd = new FormData();
		        var files_data = $('.upload-form .files-data'); // The <input type="file" /> field
		       
		        // Loop through each data and create an array file[] containing our files data.
		        $.each($(files_data), function(i, obj) {
		            $.each(obj.files,function(j,file){
		                fd.append('files[' + j + ']', file);
		            })
		        });
		       
		        // our AJAX identifier
		        fd.append('action', 'cvf_upload_files');  
		       
		        // Remove this code if you do not want to associate your uploads to the current page.
		        fd.append('post_id', <?php echo $post->ID; ?>);

		        $.ajax({
		            type: 'POST',
		            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
		            data: fd,
		            contentType: false,
		            processData: false,
		            success: function(response){
		                $('.upload-response').append(response); // Append Server Response
		                checkoutSummary();
		            }
		        });
		    });

});

/*
$(document).ready(function(){
	$('#checkall').click(function () {    
    	$('input:checkbox').prop('checked', this.checked);    
    	console.log('checked');
	});
});
*/