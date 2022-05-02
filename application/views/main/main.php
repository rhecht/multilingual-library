<div class="container-fluid" role="main">
<div class="row">
	<div class="col-lg-12 bg-light form-horizontal">		
        <div class="main-search-form"> 
	    	<div class="form-group form-inline">	    			    		
	    		<input type="text" id="term" placeholder="<?php echo lang('Search Placeholder');?>" class="form-control form-control-lg w-75 mr-1"/>    				    		
	    		<button class="btn btn-primary mr-1" id="searchme" type="button">	    			
	    			<i class="fa fa-search" aria-hidden="true"></i> <?php echo lang('Search');?>
	    		</button>	    		
	    		<button class="btn btn-dark w-15" id="searchall" type="button"><?php echo lang('View All');?></button>	    		
	    		<!--<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#refineCollapse">Refine Search</button>-->
	    	</div>
	    </div>
	</div>
</div>
<div class="row">
    <div class="filter-form left-side col-lg-3">	    	
    	<div id="accordion">				
    		<div class="card">
    			<div class="card-body">
    				<div class="form-inline">
	    			<label class="form-label"><?php echo lang('Sort By');?></label>	    			
		    		<select id="filter-sort" class="form-control">
		    			<option value="Title-ASC" selected="selected"><?php echo lang('Title');?></option>
		    			<option value="PublicationYear-ASC"><?php echo lang('Date (Oldest First)');?></option>
		    			<option value="PublicationYear-DESC"><?php echo lang('Date (Newest First)');?></option>
		    			<option value="Name-ASC"><?php echo lang('Author');?></option>
		    			<option value="Category-ASC"><?php echo lang('Category');?></option>
		    		</select>
		    		</div>		    		
    			</div>
    		</div>
			<?php if($categories):?>
			<div class="card">
				<div class="card-header p-0 bg-info " id="headingOne">
				  <h5 class="mb-0">
				    <button class="btn text-white btn-block text-left btn-link" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
				      <?php echo lang('Category'); ?> 
				      <?php /*(<span id="count-category" data-id="category" class="num-count-box"><?php echo count($categories);?></span>)*/?>
				    </button>
				  </h5>
				</div>
				<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
				  <div class="card-body filter-category" data-table="category" data-primary="CategoryID" data-label="Category" data-type="checkbox">
				    <?php foreach($categories as $record):?>
		      			<div class="form-check form-check-inline">			      			
						<input class="form-check-input filter-input" type="checkbox" id="checkboxCat<?php echo $record->CategoryID; ?>" value="<?php echo $record->CategoryID; ?>">
							<label class="form-check-label" for="checkboxCat<?php echo $record->CategoryID; ?>">
								<?php echo $record->{'Category'.$this->language};?> 
								(<?php echo $record->total_articles;?>)
							</label>			      			
		      			</div>
		      		<?php endforeach;?>
				  </div>
				  <div class="card-footer border-top-0 form-inline">
				  	<button class="btn btn-sm mr-1 btn-primary select-all"><?php echo lang('Select All');?></button>
				  	<button class="btn btn-sm btn-primary deselect-all"><?php echo lang('Clear All');?></button>
				  </div>
				</div>
			</div>
			<?php endif;?>
			<?php if($languages):?>
			<div class="card">
				<div class="card-header p-0 bg-info " id="headingTwo">
				  <h5 class="mb-0">
				    <button class="btn text-white btn-block text-left btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
				      <?php echo lang('Language'); ?>
				      <?php /*(<span id="count-language" data-id="language" class="num-count-box"><?php echo count($languages);?></span>)*/?>
				    </button>
				  </h5>
				</div>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
				  <div class="card-body filter-language" data-table="language" data-primary="LanguageID" data-label="Language" data-type="checkbox">
				    <?php foreach($languages as $record):?>
		      			<div class="form-check form-check-inline">			      			
						<input class="form-check-input filter-input" type="checkbox" id="checkboxLang<?php echo $record->LanguageID; ?>" value="<?php echo $record->LanguageID; ?>">
							<label class="form-check-label" for="checkboxLang<?php echo $record->LanguageID; ?>">
								<?php echo $record->{'Language'.$this->language};?>
								(<?php echo $record->total_articles;?>)									
							</label>			      			
		      		</div>
		      		<?php endforeach;?>
				  </div>
				   <div class="card-footer border-top-0 form-inline">
				  	<button class="btn btn-sm mr-1 btn-primary select-all"><?php echo lang('Select All');?></button>
				  	<button class="btn btn-sm btn-primary deselect-all"><?php echo lang('Clear All');?></button>
				  </div>
				</div>
			</div>
			<?php endif;?>
			<?php if($mediatypes):?>
			<div class="card">
				<div class="card-header p-0 bg-info " id="headingThree">
				  <h5 class="mb-0">
				    <button class="btn text-white btn-block text-left btn-link" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree">
				      <?php echo lang('Media Type'); ?>
				      <?php /*(<span id="count-mediatype" data-id="mediatype" class="num-count-box"><?php echo count($mediatypes);?></span>)*/?>
				    </button>
				  </h5>
				</div>
				<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
				  <div class="card-body filter-mediatype" data-table="mediatype" data-primary="MediaTypeID" data-label="Media" data-type="checkbox">
				    <?php foreach($mediatypes as $record):?>
		      			<div class="form-check form-check-inline">			      			
						<input class="form-check-input filter-input" type="checkbox" id="checkboxMedia<?php echo $record->MediaTypeID; ?>" value="<?php echo $record->MediaTypeID; ?>">
							<label class="form-check-label" for="checkboxMedia<?php echo $record->MediaTypeID; ?>">
								<?php echo $record->{'Media'.$this->language};?>
								(<?php echo $record->total_articles;?>)										
							</label>			      			
		      		</div>
		      		<?php endforeach;?>
				  </div>
				   <div class="card-footer border-top-0 form-inline">
				  	<button class="btn btn-sm mr-1 btn-primary select-all"><?php echo lang('Select All');?></button>
				  	<button class="btn btn-sm btn-primary deselect-all"><?php echo lang('Clear All');?></button>
				  </div>
				</div>
			</div>
			<?php endif;?>
			<?php if($authors):?>
			<div class="card">
				<div class="card-header p-0 bg-info " id="headingFour">
				  <h5 class="mb-0">
				    <button class="btn text-white btn-block text-left btn-link" data-toggle="collapse" data-target="#collapseFour" aria-controls="collapseFour">
				      <?php echo lang('Author'); ?>
				      <?php /*(<span id="count-author" data-id="author" class="num-count-box"><?php echo count($authors);?></span>)*/?>
				    </button>
				  </h5>
				</div>
				<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
				  <div class="card-body">
				    <select class="form-control filter-author filter-input" multiple="multiple" data-table="author" data-primary="AuthorID" data-label="Name" data-type="select" size="20">
		      		<?php foreach($authors as $record):?>								
						<option value="<?php echo $record->AuthorID; ?>">
							<?php echo $record->{'Name'.$this->language};?>
							(<?php echo $record->total_articles;?>)
						</option>
		      		<?php endforeach;?>
		      		</select>
				  </div>
				</div>
			</div>
			<?php endif;?>
		</div><!-- accordion-->
	</div><!--filter-form left-side-->
	
	<div class="result-area col-lg-6">    	
    	<div id="loading" style="width:100%; height:50px; background:url('<?php echo base_url();?>assets/main/ajax-loader.gif'); background-size: 350px auto; display: block;background-repeat: no-repeat;background-position: center center; display:none;"></div>
    	<div id="result-area"></div>
    	<!-- this is the result area, it will be populated by ajax -->	
    </div>
</div>
    

</div>

<script>
// script for search
$(document).ready(function(){	
	var timeoutId;



	$("#term").keypress(function(e) {
    	if(e.which == 13) {
	        $('#searchme').click();
    	}
    	clearTimeout(timeoutId); // doesn't matter if it's 0
		//timeoutId = setTimeout(update_all_count, 1500);  
		timeoutId = setTimeout(do_search_trigger, 1500);  

		 
	});

	function do_search_trigger(){
		$('#searchme').click();		
		update_all_count();
	}

	function update_all_count(){		
//		update_count('.filter-category');
//		update_count('.filter-language');
//		update_count('.filter-mediatype');
//		update_count('.filter-author'); 
	}

	$('body').on('click','#searchall', function(e){
		e.preventDefault();

		//var fd= new FormData();
		var xsort = $('#filter-sort').val();
		//fd.append('action', 'searchall');
		//fd.append('type','html');
		//fd.append('sort',sort);
		
		$.ajax({
            //type: 'POST',
            url: baseUrl+'/main/search',
            //async : true,
            data:{
            	lang : '<?php echo $this->languageCode;?>',
            	action : 'searchall',            	
            	//term : xterm,
            	type : 'html',
            	sort : xsort,							
			},
            //contentType: false,
            //processData: false,
            beforeSend: function() {
    			$('#loading').show();
  			},
            success: function(response){            	
            	//console.log(response);
            	$('#result-area').html(response);
            	// update the filters number           				
				//update_all_count();          	    	
            },
            complete: function(){
            	$('#loading').hide();
            }
        });

	});

	$('body').on('change','.filter-input',function(e){
		//$('#searchme').click();
		clearTimeout(timeoutId); // doesn't matter if it's 0
		//timeoutId = setTimeout(update_all_count, 1500);  
		timeoutId = setTimeout(do_search_trigger, 1500);  
	});

	$('body').on('click', '#searchme', function(e){
        e.preventDefault;
        var fd = new FormData();
        var xterm = $('#term').val();	
        var xsort = $('#filter-sort').val();
        // our AJAX identifier
        //fd.append('action', 'search');        	
       	//fd.append('term',term);
       	//fd.append('type','html');
       	//fd.append('sort',sort);

       	fd = apply_filters(fd);
       	
       	$.ajax({
            //type: 'POST',
            url: baseUrl+'/main/search',
            //async : true,
            //data: fd,
            //contentType: false,
            //processData: false,
            data:{
            	lang : '<?php echo $this->languageCode;?>',
            	action : 'search',            	
            	term : xterm,
            	type : 'html',
            	sort : xsort,			
				categories: fd.getAll('categories[]'),
				mediatypes: fd.getAll('mediatypes[]'),
				languages: fd.getAll('languages[]'),
				authors: fd.getAll('authors'),
			},
            beforeSend: function() {
    			$('#loading').show();
  			},
            success: function(response){            	
            	//console.log(response);
            	$('#result-area').html(response);
            	// update the filters number           				
				//update_all_count();
            	/*r = $.parseJSON( response );
            	if(r.error === 'true'){
            		console.log('error');
            		//$('.uploadError').html(r.message);
            	}else{
                	//$('.upload-response').append(response); // Append Server Response
            	} */           	
            },
            complete: function(){
            	$('#loading').hide();     	
            }
        });
    });

    $(".select-all").click(function(){
		$(this).parent().parent().find('input:checkbox').prop('checked', 'checked');
	});

	$(".deselect-all").click(function(){
		$(this).parent().parent().find('input:checkbox').prop('checked', '');
	});

	function apply_filters(fd){
		// do filters
       	$('.filter-category input').each(function(){
       		//console.log(obj.prop('checked'));
       		var obj = $(this);
       		if(obj.is(":checked")){				
				fd.append('categories[]',obj.val());
       		}      		
       	});

       	// do filters
       	$('.filter-mediatype input').each(function(){
       		//console.log(obj.prop('checked'));
       		var obj = $(this);
       		if(obj.is(":checked")){				
				fd.append('mediatypes[]',obj.val());
       		}      		
       	});

       	// do filters
       	$('.filter-language input').each(function(){
       		//console.log(obj.prop('checked'));
       		var obj = $(this);
       		if(obj.is(":checked")){				
				fd.append('languages[]',obj.val());
       		}      		
       	});

       	// do filters       			
		fd.append('authors',$('.filter-author').val());	

		return fd;
	}

	function update_count(box){
		// loop to each count-box and then update the count
		var fd = new FormData();
		var sort = $('#filter-sort').val();
		var container = $(box);		
		fd.append('term', $('#term').val());
		fd.append('table',container.attr('data-table'));
		fd.append('type',container.attr('data-type'));
		fd.append('label',container.attr('data-label'));
		fd.append('primary',container.attr('data-primary'));
		fd.append('sort',sort);

		fd = apply_filters(fd);

		$.ajax({
            //type: 'GET',
            url: baseUrl+'/main/update_filter',
            data:{
            	lang : '<?php echo $this->languageCode;?>',
            	term : $('#term').val(),
				table: container.attr('data-table'),
				type: container.attr('data-type'),
				label: container.attr('data-label'),
				primary: container.attr('data-primary'),
				xsort: sort,
				categories: fd.getAll('categories[]'),
				mediatypes: fd.getAll('mediatypes[]'),
				languages: fd.getAll('languages[]'),
				authors: fd.getAll('authors'),
			},
            //contentType: false,
            //processData: false,
            //async: true,
            beforeSend: function(){
            	container.html('<?php echo lang('loading');?>');
            },            
            success: function(response){
            	//console.log(response);
            	container.html(response);           	
            }
        });
	}

});






</script>