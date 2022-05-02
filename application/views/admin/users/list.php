<?php $this->load->view('admin/__includes/header'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">

<div id="list" class="card">
	
	<div class="panel-header">		
		<div class="row justify-content-md-center">
			<div class="col col-12 col-md-6 mr-auto"><h4 class="panel-title">List of Users</h4></div>			
		</div>		
	</div>

	<div class="panel-body table-container">
		<div class="col-lg-12">
			<div class="table-mobile"> 
			<table id="datatable" class="table table-striped table-responsive">
				<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Access Allowed</th>
					<th class="no-search no-sort">Active</th>
					<th class="no-sort">Actions</th>
				</tr>
				</thead>
				<?php if(!empty($users)){?>
				<tbody>
				<?php foreach($users as $row){?>
				<?php //if ($row->is_admin){continue;} ?>
				<tr scope="row">
					<td>						
						<a href="<?php echo site_url('admin/users/details/'.$row->id);?>" class="user-editable" data-type="text" data-name="name" data-pk="<?php echo $row->id;?>" data-title="Update Name">
							<?php echo $row->name;?>	
						</a>
						
					</td>
					<td>
						<a href="<?php echo site_url('admin/users/details/'.$row->id);?>" class="user-editable" data-type="email" data-name="email" data-pk="<?php echo $row->id;?>" data-title="Update Email">
							<?php echo $row->email;?>
						</a>
					<?php #echo $row->email;?>
						
					</td>
					<td class="label-upper">
						<?php if($row->is_admin):?>							
							<span class="badge badge-info">Full Access</span>
						<?php else: ?>							
							<a href="<?php echo site_url('admin/users/details/'.$row->id);?>" id="permissions" 
								data-type="checklist" 
								data-pk="<?php echo $row->id;?>" 
								<?php if( $row->allowed_access ) :?>	
								data-value="<?php echo implode(',',$row->allowed_roles_ids); ?>" 
								<?php endif;?>
								data-title="Set Permissions" 
								class="permissions-editable" 
								data-original-title="" style="border-bottom:none;">						
								
								<?php if( $row->allowed_access ) :?>					
									
									<?php $allowed = array();?>
									<?php foreach( $row->allowed_access as $access ): ?>								
										<?php $allowed[] = '<span class="badge badge-default badge-'.$access.'">' . $access .'</span>' ; ?>
									<?php endforeach;?>									
									<?php echo implode(' ',$allowed);?>
								<?php else:?>	
									<span class="badge badge-warning">No Access</span>
								<?php endif;?>							
							</a>
						<?php endif;?>
					</td>
					<td>
					<a href="<?php echo site_url('admin/users/details/'.$row->id);?>" id="active" data-type="select" data-name="active" data-pk="<?php echo $row->id;?>" data-value="<?php echo $row->active;?>" data-title="Active" class="status-editable">
						<?php if ($row->active) :?>
							Yes
						<?php else:?>
							No
						<?php endif;?>
					</a>						
					</td>
					<td><a href="<?php echo site_url('admin/users/details/'.$row->id);?>" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				</tr>
				<?php }?>
				</tbody>
				<?php }?>
			</table>
			</div>
		</div>
	</div>

	<div class="panel-footer">        
         <div class="row">            
            <div class="col text-right">                                 
                 <a href="<?php echo site_url('admin/users/add');?>" class="btn btn-primary btn-sm" name="add"><i class="fa fa-user-plus"></i> Add User</a>
            </div>
        </div>
    </div>

</div>

		</div>
	</div>
</div>

<?php	$this->load->view('admin/__includes/footer'); ?>