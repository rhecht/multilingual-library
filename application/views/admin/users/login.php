<div class="auth-page height-auto bg-blue-600">
<!-- BEGIN CONTENT -->
	<div class="wrapper animated fadeInDown">
		<div class="panel overflow-hidden">
			<div class="bg-light-blue-500 padding-top-25 no-margin-bottom font-size-20 color-white text-center text-uppercase">
				<i class="ion-log-in margin-right-5"></i> Sign In
			</div>

			<?php $this->view('admin/__includes/error_message');?>
			
			<?php echo form_open();?>

				<div class="box-body padding-md">
				
					<div class="form-group">
						<input type="text" name="email" class="form-control input-lg" placeholder="<?php echo lang('Username');?>"/>
					</div>
					
					<div class="form-group">
						<input type="password" name="password" class="form-control input-lg" placeholder="<?php echo lang('Password');?>"/>
					</div>        
					
					<div class="form-group margin-top-20">
						<input type="checkbox" class="js-switch" id="checkbox" checked /><label for="checkbox" class="font-size-12 normal margin-left-10"><?php echo lang('Remember Me');?></label>
					</div>       
					
					<button type="submit" name="login" class="btn btn-dark bg-light-green-500 padding-10 btn-block color-white"><i class="ion-log-in"></i> <?php echo lang('Sign In');?></button>  
					<div class="form-group text-right">
						<a href="<?php echo site_url('admin/users/reset_password');?>" class="btn btn-link">Forgot Password?</a>
					</div>
				</div>
			<?php echo form_close();?>  

			<div class="panel-footer padding-md no-margin no-border bg-light-blue-500 text-center color-white">Tekhelet &copy; 2018</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div> 
