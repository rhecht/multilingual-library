<?php $this->load->view('admin/__includes/header'); ?>   
    
<div class="page-head">
   	<h1 class="page-title"><?php echo lang('Authors');?><small>view all authors</small></h1>        
</div>
<div class="container-fluid">
<div class="row">
	<div class="col-lg-6">
		<table id="table" class="table table-bordered table-striped  table-sm table-responsive table-hover">
			<thead>
				<tr>
					<th class="no-search">ID#</th>
					<th><?php echo lang('Name');?></th>
					<th><?php echo lang('Name (Hebrew)');?></th>
					<th><?php echo lang('Name (Spanish)');?></th>
					<th><?php echo lang('Name (French)');?></th>
					<th><?php echo lang('Name (Russian)');?></th>
					<th class="no-search"><?php echo lang('Total Articles');?></th>									
					<th class="no-search no-sort"><?php echo lang('Action');?></th>
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
	            "url": "<?php echo site_url('admin/author/ajax_list')?>",
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

	