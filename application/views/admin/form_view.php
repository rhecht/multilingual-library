<!-- header -->
<?php
	$this->load->view('admin/__includes/form-header');
?>




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
						for($i=0; $i<count($DDList); $i++){
							// if key matches variable name
						
							if($DDList[$i]['idkey']==$key){
								$regularInput=0;
								$arrayid=$i;
								$inputType=$DDList[$i]['inputtype'];
//							echo $DDList[$i][0] . "==" . $key . " == " . $inputType . "<br />"; 
	
							}
						}
						switch($inputType){
							case "text":
								echo form_input(array('id' => $key, 'name' => $key, 'class' => 'form-control', 'value' => $item ));
							break;
							
							case "select":
								$ddarray=array();
								for($i=0;$i<count( $DDList[$arrayid]['allrecords'] ); $i++){
								
								$temp_idkey=$DDList[$arrayid]['allrecords'][$i]->{$DDList[$arrayid]['idkey']};
								$temp_valkey=$DDList[$arrayid]['allrecords'][$i]->{$DDList[$arrayid]['namekey']};
								
								$ddarray[$temp_idkey]=$temp_valkey;
								}							
								//display dropdown here
								
								if(isset($item)){
									echo form_dropdown($key, $ddarray, $item); //if single select, only value
								}
								else{
									echo form_dropdown($key, $ddarray); //if single select, only value	
								}
								

							break;
							
							case "multiselect":
								$ddarray=array();
								for($i=0;$i<count( $DDList[$arrayid]['allrecords'] ); $i++){
								
								$temp_idkey=$DDList[$arrayid]['allrecords'][$i]->{$DDList[$arrayid]['idkey']};
								$temp_valkey=$DDList[$arrayid]['allrecords'][$i]->{$DDList[$arrayid]['namekey']};
								
								$ddarray[$temp_idkey]=$temp_valkey;
								}							
								//display multi dropdown here
								
								if(is_array($DDList[$arrayid]['allrecordsselected']) ){
									echo form_dropdown($key, $ddarray, $DDList[$arrayid]['allrecordsselected']); //if single select, only value
								}
								else{
									echo form_dropdown($key, $ddarray); //if single select, only value
								}
								
						
							break;
						}
					}
					else{
							echo form_input(array('id' => $key, 'name' => $key, 'class' => 'form-control', 'value' => $item ));					
					}
					
				}
?>

                </div>
              </div>
            <?php endforeach;?>

<h3>
One to Many Relationships
</h3>

<?php
				// One to manys will be multiselect
				for($i=0; $i<count($onetomanyitems); $i++){
					//from here get all records and loop foreach, which is different from regular records.
?>
              <div class="form-group">
              	<?php $attributes = array('class' => 'control-label col-lg-2' ); ?>
				<?php //echo form_label($key . ' :', $key, $attributes); ?><?php //echo form_error($key); ?>
                <div class="col-lg-8">
<?

//									echo form_dropdown($key, $ddarray, $DDList[$arrayid]['specificrecordsselected']); //if single select, only value
?>
                </div>
              </div>
<?php
				}
?>
										<div class="text-center margin-top-20 padding-top-20 border-top-1 border-grey-100">
											  <button type="submit" class="btn bg-orange-500 color-white btn-dark margin-right-10 padding-left-40 padding-right-40">Cancel</button>
											  <button type="submit" class="btn bg-green-500 color-white btn-dark padding-left-40 padding-right-40">Submit</button>
											</div>
	

	</div>
</form>

<?php
	$this->load->view('admin/__includes/form-footer');
?>