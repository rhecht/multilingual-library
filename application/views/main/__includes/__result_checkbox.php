<?php if($records):?>
<?php foreach($records as $record):?>
<div class="form-check form-check-inline">			      			
	<?php 
		if($record->filtered_articles <= 0){ 
			#continue;
		}
		$checked = '';
		if($record->table == 'category'  && !empty($query['categories'])){if( in_array($record->{$primary}, $query['categories'])){$checked="checked";}}
		if($record->table == 'language'  && !empty($query['languages'] )){if( in_array($record->{$primary}, $query['languages']) ){ $checked="checked";}}
		if($record->table == 'mediatype' && !empty($query['mediatypes'])){if( in_array($record->{$primary}, $query['mediatypes'])){$checked="checked";}}
	?>
	<input class="form-check-input filter-input" type="checkbox" <?php echo $checked;?> id="checkbox<?php echo $label.$record->{$primary}; ?>" value="<?php echo $record->{$primary}; ?>">
	<label class="form-check-label" for="checkbox<?php echo $label.$record->{$primary}; ?>">
		<?php echo $record->{$label.$this->language};?> 
		(<?php echo $record->filtered_articles;?>)
	</label>			      			
</div>
<?php endforeach;?>
<?php else:?>	
<?php endif;?>