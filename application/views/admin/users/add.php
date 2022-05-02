<?php $this->load->view('admin/__includes/header'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 form-horizontal">
            <h1>Users</h1>
            <?php echo form_open();?>
            <div id="addUser" class="panel">        
                <div class="panel-header">
                    <div class="col"><h4 class="panel-title h5">Create New User</h4></div>          
                </div>          
                <div class="panel-body">
                    <div class="row">
                        <div class="col"><h5 class="panel-title h5"><i class="fa fa-user"></i> User Details</h5></div>
                    </div>                
                    <div class="form-row">
                        
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label control-label"><span >Name*</span></label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="" name="name" value="<?php echo set_value('name');?>" required/>
                            </div>
                        </div>      
                        
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label control-label"><span>Email*</span></label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="" name="email" value="<?php echo set_value('email');?>" required/>                </div>
                        </div>
                        
                    </div>        
                    <div class="form-row">                        
                        
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label control-label"><span>Password*</span></label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="" name="password" required/>                
                        </div>
                        </div>
                        
                    </div>                 
                    <div class="form-row">                        
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label control-label"><span>Active*</span></label>
                            <div class="col-sm-10">
                            <select class="form-control" name="isActive" required>
                                <option value="1" <?php echo set_select('isActive', '1') ?>>YES</option>
                                <option value="0" <?php echo set_select('isActive', '0') ?>>NO</option>
                            </select>              
                            </div>  
                        </div>                        
                    </div>   
                  
                    <div class="form-row">
                    <label class="col-sm-2 col-form-label control-label"><span>Role*</span></label>
                        <div class="col-sm-10">
                        <?php foreach($this->roles as $role): ?>                    
                            <div class="checkbox checkbox-theme">                            
                                <input 
                                    class="form-check-input"
                                    type="checkbox" <?php echo set_checkbox($role->name, $role->id); ?> 
                                    name="<?php echo $role->name; ?>" 
                                    value="<?php echo $role->id; ?>"
                                    id="checkbox<?php echo $role->id; ?>"/> 
                                <label class="form-check-label" for="checkbox<?php echo $role->id; ?>">
                                    <?php echo ucwords($role->description)?>
                                </label>
                            </div>
                        <?php endforeach; ?>  
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="form-row">
                        <div class="col-sm-10 col-sm-offset-10">                                 
                            <button type="submit" class="btn btn-primary btn-sm" name="add"><i class="fa fa-user-plus"></i> Add User</button>
                        </div>
                    </div>        
                </div>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>

<?php   $this->load->view('admin/__includes/footer'); ?>