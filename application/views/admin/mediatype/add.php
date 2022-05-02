<?php $this->view('admin/__includes/header'); ?> 
<div class="page-head">
    <h1 class="page-title"><?php echo lang('Media Type Entry');?><small>add a new entry</small></h1>        
</div>

<div class="container-fluid">
<?php echo form_open();?>

<div class="row">
	<div class="col-lg-6 form-horizontal">
	
		<div class="form-row">            			                        
			<div class="form-group">
    			<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media Type');?>*</span></label>
    			<div class="col-sm-9">
                    <input type="text" class="form-control" id="media" name="media" value="<?php echo set_value('media');?>" required/>
                </div>
			</div>                  			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media Type (Hebrew)');?>*</span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_he" name="media_he" value="<?php echo set_value('media_he');?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media Type (Spanish)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_es" name="media_es" value="<?php echo set_value('media_es');?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media Type (French)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_fr" name="media_fr" value="<?php echo set_value('media_fr');?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media Type (Russian)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_ru" name="media_ru" value="<?php echo set_value('media_ru');?>" required/>
                </div>
			</div>        			
		</div>
		
        <div class="form-row">                  
            <div class="form-group">
                <label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Icon URL');?>*</span></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="icon_url" name="icon_url" value="<?php echo set_value('icon_url');?>" required/>
                </div>
            </div>                  
        </div>
     
        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-plus"></i> 
                            <?php echo lang('Add Media Type');?>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="add_media"/>	
    </div>

    <?php /*author and categories*/ ?>

    

</div>

<?php echo form_close();?>
</div>


<?php $this->view('admin/__includes/footer'); ?>
	