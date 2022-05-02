<?php $this->load->view('admin/__includes/header'); ?>   
    
<div class="page-head">
   	<h1 class="page-title"><?php echo lang('Articles');?><small>view all articles</small></h1>        
</div>
<div class="container-fluid">
<div class="row">
	<div class="col-md-12">
		<table id="table" class="table table-bordered table-striped  table-sm table-responsive table-hover">
			<thead>
				<tr>
					<th class="">ID#</th>
					<th>Title</th>
					<th>Publication</th>
					<th>Language</th>
					<th>URL</th>
					<th>Media Type</th>
					<th class="no-search">Size</th>
					<th>Publication Year</th>
					<th class="no-search no-sort">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
</div>

	<script type="text/javascript"> 
	var table;		 
	jQuery(document).ready(function($) {		 
	    //datatables
	    table = $('#table').DataTable({  
	        "processing": true, 
	        "serverSide": true, 
	        "order": [[0, 'desc']], //Initial no order.
	       
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('admin/article/ajax_list')?>",
	            "type": "POST"
	        }, 
	        //Set column definition initialisation properties.
	        "columnDefs": [ 
				{"targets"  : 'no-sort', "orderable": false,},
				{"targets"  : 'no-search', "searchable": false,}				
			], 
	    }); 
	});
	</script>			
<?php $this->load->view('admin/__includes/footer'); ?>

	