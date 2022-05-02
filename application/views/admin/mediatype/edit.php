<?php $this->view('admin/__includes/header'); ?> 
<div class="page-head">
    <h1 class="page-title"><?php echo lang('Media Type Update');?><small>update author</small></h1>        
</div>

<div class="container-fluid">
<?php echo form_open();?>

<div class="row">
	<div class="col-lg-6 form-horizontal">
	
		<div class="form-row">            			                        
			<div class="form-group">
    			<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media');?>*</span></label>
    			<div class="col-sm-9">
                    <input type="text" class="form-control" id="media" name="media" value="<?php echo set_value('media',$record->Media);?>" required/>
                </div>
			</div>                  			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media (Hebrew)');?>*</span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_he" name="media_he" value="<?php echo set_value('media_he',$record->Media_he);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media (Spanish)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_es" name="media_es" value="<?php echo set_value('media_es',$record->Media_es);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media (French)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_fr" name="media_fr" value="<?php echo set_value('media_fr',$record->Media_fr);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Media (Russian)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="media_fr" name="media_fr" value="<?php echo set_value('media_fr',$record->Media_fr);?>" required/>
                </div>
			</div>        			
		</div>

        <div class="form-row">                  
            <div class="form-group">
                <label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Icon URL');?>*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="icon_url" name="icon_url" value="<?php echo set_value('icon_url',$record->IconURL);?>" required/>

                </div>
                <div class="col-sm-3">
                    <?php if(!empty($record->IconURL)):?>
                    <img class="img-responsive img-fluid" src="<?php echo $record->IconURL;?>"/>
                    <?php endif;?>
                </div>
            </div>                  
        </div>

        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-edit"></i> 
                            <?php echo lang('Update Media Type');?>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="edit_media"/>	
    </div>

    <?php /*author and categories*/ ?>

    

</div>

<?php echo form_close();?>
</div>


<?php $this->view('admin/__includes/footer'); ?>
	