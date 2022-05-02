<?php $this->load->view('admin/__includes/header'); ?>
<div class="page-head">
    <h1 class="page-title">Article Update<small>update an article</small></h1>        
</div>
<div class="container-fluid">
<?php echo form_open();?>    

<div class="row">
	<div class="col-lg-6 form-horizontal">
		

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Title');?></span></label>
        				<div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title',$record->Title);?>" required/></div>
    				</div>      
    			
			</div>

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Publication');?></span></label>
                        <div class="col-sm-10">
        				<input type="text" class="form-control" id="publication" name="publication" value="<?php echo set_value('publication',$record->Publication);?>"/></div>
    				</div>      
    			
			</div>

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('URL');?></span></label>
                        <div class="col-sm-10">
        				<div class="input-group">
                        <input type="text" class="form-control" id="url" name="url" value="<?php echo set_value('url',$record->URL);?>"/>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" href="#" data-toggle="modal" data-target="#uploadFile">
                                <i class="fa fa-upload"></i> &nbsp;<?php echo lang('Upload File');?>
                            </button>
                        </span>
                        </div>
                        </div>
    				</div>      
    			    
			</div>

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Abstract');?></span></label>
                        <div class="col-sm-10">
        				<input type="text" class="form-control" id="abstract" name="abstract" value="<?php echo set_value('abstract',$record->Abstract);?>"/></div>
    				</div>      
    			
			</div>

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Keyword');?></span></label>
                        <div class="col-sm-10">
        				<input type="text" class="form-control" id="keyword" name="keyword" value="<?php echo set_value('keyword',$record->Keywords);?>"/></div>
    				</div>      
    			
			</div>

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Publication Year');?></span></label>
                        <div class="col-sm-10">
        				<input type="text" class="form-control datepicker" id="datepicker" name="publicationyear" value="<?php echo set_value('publicationyear',date("m/d/Y",strtotime($record->PublicationYear)));?>"/></div>
    				</div>      
    			  
			</div>

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Size');?></span></label>
                        <div class="col-sm-10">
        				<input type="text" class="form-control" id="size" name="size" value="<?php echo set_value('size',$record->Size);?>"/></div>
    				</div>      
    			 
			</div>

           

			<div class="form-row">
    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Media Type');?></span></label>
                        <div class="col-sm-10">
        				<?php if($mediatypes):?>
        				<select name="mediatype" id="mediatype" class="form-control">
        				<?php foreach($mediatypes as $media):?>
        					<option <?php if($record->MediaTypeID == $media->MediaTypeID){ echo 'selected="selected"';} ?> value="<?php echo $media->MediaTypeID;?>"><?php echo $media->{'Media'.$this->language};?></option>
        				<?php endforeach;?>
        				</select>
        				<?php endif;?>
                        </div>
    				</div>      
    			
			</div>

			<div class="form-row">    			
    				<div class="form-group">
        				<label class="col-form-label col-sm-2"><span ><?php echo lang('Language');?></span></label>
                        <div class="col-sm-10">
        				<?php if($languages):?>
        				<select name="language" id="language" class="form-control">
        				<?php foreach($languages as $language):?>
        					<option <?php if($record->LanguageID == $language->LanguageID){ echo 'selected="selected"';} ?> value="<?php echo $language->LanguageID;?>"><?php echo $language->{'Language'.$this->language};?></option>
        				<?php endforeach;?>
        				</select>
        				<?php endif;?>
                        </div>
    				</div>      
    			
			</div>

            <div class="form-row">
                <div class="col-sm-10 col-sm-offset-2">                                 
                    <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">
                        <i class="fa fa-edit"></i> 
                            <?php echo lang('Update Article');?>
                    </button>
                </div>
            </div>

            <input type="hidden" name="action" value="edit_article"/>  

		
	</div>

    <div class="col-lg-6 form-horizontal">

        <div class="form-row">          
            <div class="form-group">
                <label class="col-sm-2 col-form-label control-label"><span ><?php echo lang('Author');?></span></label>
                <div class="col-sm-10">
                    <?php if($authors):?>
                    <select name="authors[]" id="author" class="form-control height-200" multiple="">
                    <?php foreach($authors as $author):?>
                        <option 
                            value="<?php echo $author->AuthorID;?>" 
                            <?php echo in_array($author->AuthorID, $record->Authors)?'selected="selected"':''; ?>
                        >
                            <?php echo $author->{"Name".$this->language};?>                            
                        </option>
                    <?php endforeach;?>
                    </select>
                    <?php endif;?>
                </div>
            </div>            
        </div>

        <div class="form-row">          
            <div class="form-group">
                <label class="col-sm-2 col-form-label control-label"><span ><?php echo lang('Category');?></span></label>
                <div class="col-sm-10">
                    <?php if($categories):?>
                    <select name="categories[]" id="category" class="form-control height-200" multiple="">
                    <?php foreach($categories as $category):?>
                        <option 
                            value="<?php echo $category->CategoryID;?>"
                            <?php echo in_array($category->CategoryID, $record->Categories)?'selected="selected"':''; ?>
                        >
                            <?php echo $category->{"Category".$this->language};?>                            
                        </option>
                    <?php endforeach;?>
                    </select>
                    <?php endif;?>
                </div>
            </div>            
        </div>
    </div>

</div>
<?php echo form_close();?>
</div>


<?php /*using modal to upload files*/ ?>
<div class="modal fade bs-example-modal-sm" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">    
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> <?php echo lang('Upload File');?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="row step-row">
                    <div class="col-sm-12">
                        <div class = "form-group">                            
                            <input type = "file" id="fileUploadElement" name="fileUploaded" class = "files-data form-control"/>
                            <p class="uploadError error"></p>
                        </div>                        
                    </div>                    
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">          
          <button type="submit" class="btn btn-primary btn-sm uploadThis"  name="uploadFile"><i class="fa fa-upload"></i> <?php echo lang('Upload');?></button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> <?php echo lang('Close');?></button>
        </div>
      </div>
    </div>
  
</div>


<?php	$this->load->view('admin/__includes/footer'); ?>

	