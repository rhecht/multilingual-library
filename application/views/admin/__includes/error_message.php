<?php if( !empty($this->message) || validation_errors() ):?>	

<div class="row error-display-row">
	<div class="col-sm-12 container-session session-message">		
		<?php if( !empty($this->message) ):?>			
		<div class="alert alert-<?php echo $this->message_type;?>">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php #echo $this->message_icons[$this->message_type];?>
			<?php echo $this->message;?>
		</div>
		<?php endif;?>

		<?php if( validation_errors() ):?>
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>					
			<ul class="error-list">
				<?php echo validation_errors(); ?>
			</ul>
		</div>
		<?php endif;?>					
	</div>
</div>

<?php endif;?>
