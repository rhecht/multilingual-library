<?php $this->view('admin/__includes/header'); ?> 
<div class="page-head">
    <h1 class="page-title"><?php echo lang('Author Update');?><small>update author</small></h1>        
</div>

<div class="container-fluid">
<?php echo form_open();?>

<div class="row">
	<div class="col-lg-6 form-horizontal">
	
		<div class="form-row">            			                        
			<div class="form-group">
    			<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Name');?>*</span></label>
    			<div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name',$record->Name);?>" required/>
                </div>
			</div>                  			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Name (Hebrew)');?>*</span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="name_he" name="name_he" value="<?php echo set_value('name_he',$record->Name_he);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Name (Spanish)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="name_es" name="name_es" value="<?php echo set_value('name_es',$record->Name_es);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Name (French)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="name_fr" name="name_fr" value="<?php echo set_value('name_fr',$record->Name_fr);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Name (Russian)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="name_ru" name="name_ru" value="<?php echo set_value('name_ru',$record->Name_ru);?>" required/>
                </div>
			</div>        			
		</div>

        <div class="form-row">                  
            <div class="form-group">
                <label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Picture URL');?>*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="picture_url" name="picture_url" value="<?php echo set_value('picture_url',$record->PictureURL);?>" required/>

                </div>
                <div class="col-sm-3">
                    <?php if(!empty($record->PictureURL)):?>
                    <img class="img-responsive img-fluid" src="<?php echo $record->PictureURL;?>"/>
                    <?php endif;?>
                </div>
            </div>                  
        </div>

        <div class="form-row">                  
            <div class="form-group">
                <label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Bio');?>*</span></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="bio" name="bio" required><?php echo set_value('bio',$record->Bio);?></textarea>
                </div>
            </div>                  
        </div>
			
		
        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-edit"></i> 
                            <?php echo lang('Update Author');?>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="edit_author"/>	
    </div>

    <?php /*author and categories*/ ?>

    

</div>

<?php echo form_close();?>
</div>


<?php $this->view('admin/__includes/footer'); ?>
	