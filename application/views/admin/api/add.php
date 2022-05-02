<?php $this->view('admin/__includes/header'); ?> 
<div class="page-head">
    <h1 class="page-title"><?php echo lang('API');?><small>add a new entry</small></h1>        
</div>

<div class="container-fluid">
<?php echo form_open();?>

<div class="row">
	<div class="col-lg-6 form-horizontal">
	
		<div class="form-row">            			                        
			<div class="form-group">
    			<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Domain');?>*</span></label>
    			<div class="col-sm-9">
                    <input type="text" class="form-control" id="domain" name="domain" value="<?php echo set_value('domain');?>" required/>
                </div>
			</div>                  			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('User');?>*</span></label>
				<div class="col-sm-9">
                    <?php if($users):?>
                    <select name="user" id="user" class="form-control">
                    <?php foreach($users as $user):?>
                        <option value="<?php echo $user->id;?>"><?php echo $user->name;?></option>
                    <?php endforeach;?>
                    </select>
                    <?php endif;?>
                </div>
			</div>        			
		</div>
			
		
        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-plus"></i> 
                            <?php echo lang('Generate API Key');?>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="add_api"/>	
    </div>

    <?php /*author and categories*/ ?>

    

</div>

<?php echo form_close();?>
</div>


<?php $this->view('admin/__includes/footer'); ?>
	