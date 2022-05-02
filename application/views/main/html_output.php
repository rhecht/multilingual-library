<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if($records): ?>
<div class="row">
	<div class="col-12">

		<?php
		if($query['action'] == 'searchall' OR empty($query['term'])):
		    $lang_search_results_searchall=str_replace('{{numrecords}}',count($records),lang('Search Results Searchall'));
		?>
		<h3><?php echo $lang_search_results_searchall;?></h3>	
		<?php
		    else:
		    
		    $lang_search_results_text=str_replace('{{searchterm}}',$query['term'],lang('Search Results Text'));

		    $lang_search_results_text=str_replace('{{numrecords}}',count($records),$lang_search_results_text);		    
				?>
		<h3><?php echo $lang_search_results_text;?></h3>
		<?php endif;?>

	</div>
</div>
<?php foreach($records as $row):?>	

	<div class="row py-2">		
		<div class="col-12">
			<?php #print_r($row);?>
			<div class="card">			  
			  <div class="card-body">
			    <h5 class="card-title">			    	
			    	<a href="<?php echo $row->URL;?>" target="_blank">			    		
			    		<img src="<?php echo $row->IconURL;?>" class="icon-img d-inline img-fluid"/>			    					    		
			    		<?php echo $row->Title;?>			    		
			    	</a>
			    </h5>
			    <div class="row">
			    	<div class="col-9">
			    		<ul class="list-group">
				    		<li class="list-group-item p-1"><?php echo lang('Media Type');?> : <?php echo $row->{"Media".$this->language};?></li>
				    		<li class="list-group-item p-1"><?php echo lang('Language');?> : <?php echo $row->{"Language".$this->language};?></li>
				    		<li class="list-group-item p-1"><?php echo lang('Publication');?> : <?php echo $row->Publication;?></li>
				    		<li class="list-group-item p-1"><?php echo lang('Date');?> : <?php echo $row->PublicationYear;?></li>
				    		<li class="list-group-item p-1"><?php echo lang('Size');?> : <?php echo $row->Size;?></li>
				    		<li class="list-group-item p-1"><?php echo lang('Category');?> : 
				    			<?php #echo $row->Category;?>				    			
				    			<?php $cat = array(); foreach($row->Categories as $category):?>
				    				<?php $cat[] = $category->{"Category".$this->language};?>
				    			<?php endforeach;?>
				    			<?php echo implode(', ',$cat);?>
				    		</li>				    		
			    		</ul>
			    	</div>
			    	<div class="col-3">
			    		<div class="row">
			    			<div class="col-12">
					    		<?php if(empty($row->PictureURL)):?>
					    		<img class="img-fluid" src="<?php echo $this->config->item('admin_theme') ?>/img/avatar.jpg"/>
					    		<?php else:?>
					    		<img class="img-fluid" src="<?php echo $row->PictureURL;?>"/>
					    		<?php endif;?>
				    		</div>
			    		</div>
			    		<p class="card-text">			    			
			    			<?php echo lang('Author');?> : <?php echo $row->{"Name".$this->language};?>
			    		</p>
			    	</div>
			    </div>			    			    
			  </div>			  
			</div>
		</div>



	</div>
<?php endforeach;?>
<?php else: ?>
	<p>No Records found</p>
<?php endif;?>