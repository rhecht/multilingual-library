<?php $this->view('admin/__includes/header'); ?> 
<div class="page-head">
    <h1 class="page-title"><?php echo lang('Category Update');?><small>update a category</small></h1>        
</div>

<div class="container-fluid">
<?php echo form_open();?>

<div class="row">
	<div class="col-lg-6 form-horizontal">
	
		<div class="form-row">            			                        
			<div class="form-group">
    			<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Category');?>*</span></label>
    			<div class="col-sm-9">
                    <input type="text" class="form-control" id="category" name="category" value="<?php echo set_value('category',$record->Category);?>" required/>
                </div>
			</div>                  			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Category (Hebrew)');?>*</span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="category_he" name="category_he" value="<?php echo set_value('category_he',$record->Category_he);?>" required/>
                </div>
			</div>        			
		</div>
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Category (Spanish)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="category_es" name="category_es" value="<?php echo set_value('category_es',$record->Category_es);?>" required/>
                </div>
			</div>        			
		</div>			
		<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Category (French)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="category_fr" name="category_fr" value="<?php echo set_value('category_fr',$record->Category_fr);?>" required/>
                </div>
			</div>        			
		</div>				<div class="form-row">        			
			<div class="form-group">
				<label class="col-sm-3 col-form-label control-label"><span ><?php echo lang('Category (Russian)');?> </span></label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="category_ru" name="category_ru" value="<?php echo set_value('category_ru',$record->Category_ru);?>" required/>
                </div>
			</div>        			
		</div>		
		
        <div class="form-row">
            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-edit"></i> 
                            <?php echo lang('Update Category');?>
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="action" value="edit_category"/>	
    </div>

    <?php /*author and categories*/ ?>

    

</div>

<?php echo form_close();?>
</div>


<?php $this->view('admin/__includes/footer'); ?>
	