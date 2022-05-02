<?php if($records):?>
	<?php foreach($records as $record):?>
	<?php 
		if($record->filtered_articles <= 0){ 
			#continue;
		}
		$select = '';					
		if( $record->table == 'author' && !empty($query['authors']) ){			
			if( in_array( $record->{$primary}, explode(',',$query['authors'])) ){
				$select='selected="selected"';
			}
		}
	?>	
	<option value="<?php echo $record->{$primary}; ?>" <?php echo $select;?>>
		<?php echo $record->{$label.$this->language};?>
		(<?php echo $record->filtered_articles;?>)
	</option>
	<?php endforeach;?>
<?php else:?>	
<?php endif;?>