<!-- header -->
<?php
	$this->load->view('admin/__includes/header');
?>
	<div class="wrapper">
		<!-- BEGIN LEFTSIDE -->
        <div class="leftside">
<!-- sidebar left -->
<?php
	$this->load->view('admin/__includes/sidebar-left');
?>
        </div>
		<!-- END LEFTSIDE -->
		<!-- BEGIN RIGHTSIDE -->
        <div class="rightside bg-grey-100">
			<!-- BEGIN PAGE HEADING -->
            <div class="page-head"><!-- END BREADCRUMB -->
			</div>
			<!-- END PAGE HEADING -->
			<div class="row">
				<div class="col-lg-12">
				  <div class="panel">
					    <div class="panel-title bg-transparent">						  </div>
							<div class="row">
								<div class="col-lg-8 col-lg-offset-2">
									<div class="text-center margin-bottom-20 border-bottom-1 border-grey-100">
										<h3 class="color-grey-700 margin-top-30">Sample Large Form</h3>
										<p class="text-light margin-bottom-40">Individual form controls automatically receive some global styling.</p>
									</div>
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'action' => $formsubmit);
echo form_open('form', $attributes);
?>
    <div class="panel-body padding-bottom-40">
			<?php foreach ($records as $key => $item):?>
              <div class="form-group">
              	<?php
					$attributes = array(
						'class' => 'control-label col-lg-2'
					);
				?>
				<?php echo form_label($key . ' :', $key, $attributes); ?><?php echo form_error($key); ?>
                <div class="col-lg-8">
                <?php
                if($keyid==$key){
					echo form_input(array('id' => $key, 'name' => $key, 'class' => 'form-control', 'value' => $item, 'disabled' => 'disabled' ));
				} else {
					$regularInput=1;
					$inputType="text";
					$arrayid=0;
					unset($ddarrayKey);
					unset($ddarrayKeyVal);
					
					if(is_array($DDList)){
						//Now we have fun with different data types.
						for($i=0; $i<=count($DDList); $i++){
							// if key matches variable name
							if($DDList[$i][0]==$key){
								$regularInput=0;
								$arrayid=$i;
								$inputType=$DDList[$i][2];
							}
						}
						switch($inputType){
							case "text":
								echo form_input(array('id' => $key, 'name' => $key, 'class' => 'form-control', 'value' => $item ));
							break;
							
							case "select":
								$ddarray=array();
								foreach ($DDList[$arrayid][1] as $key2 => $item2):
								array_push($ddarray, 2);
								endforeach;
							break;
							
							case "multiselect":
							
							break;
						}
					}
					else{
					}
								echo form_input(array('id' => $key, 'name' => $key, 'class' => 'form-control', 'value' => $item ));					
					}
?>
                </div>
              </div>
            <?php endforeach;?>


										<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">
											  <button type="submit" class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40">Cancel</button>
											  <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">Submit</button>
											</div>
	

	</div>
</form>
							</div>
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
<!-- footer -->
<?php
	$this->load->view('admin/__includes/footer');
?>