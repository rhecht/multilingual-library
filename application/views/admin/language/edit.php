<?php $this->view('admin/__includes/header'); ?> 
<div class="page-head">
    <h1 class="page-title"><?php echo lang('Language Update');?><small>update a language</small></h1>        
</div>

<div class="container-fluid">
<?php echo form_open();?>

<div class="row">
	<div class="col-lg-6 form-horizontal">
	
		<div class="form-row">            			                        
			<div class="form-group">
    			<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Language');?>*</span></label>
    			<div class="col-sm-9">
                    <input type="text" class="form-control" id="language" name="language" value="<?php echo set_value('language',$record->Language);?>" required/>
                </div>
			</div>                  			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Language (Hebrew)');?>*</span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="language_he" name="language_he" value="<?php echo set_value('language_he',$record->Language_he);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Language (Spanish)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="language_es" name="language_es" value="<?php echo set_value('language_es',$record->Language_es);?>" required/>
                </div>
			</div>        			
		</div>			
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Language (French)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="language_fr" name="language_fr" value="<?php echo set_value('language_fr',$record->Language_fr);?>" required/>
                </div>
			</div>        			
		</div>			
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Language (Russian)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="language_ru" name="language_ru" value="<?php echo set_value('language_ru',$record->Language_ru);?>" required/>
                </div>
			</div>        			
		</div>			
		
        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-edit"></i> 
                            <?php echo lang('Update Language');?>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="edit_language"/>	
    </div>

    <?php /*author and categories*/ ?>

    

</div>

<?php echo form_close();?>
</div>


<?php $this->view('admin/__includes/footer'); ?>
	