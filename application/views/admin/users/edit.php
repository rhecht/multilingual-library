<?php $this->load->view('admin/__includes/header'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 form-horizontal">

<?php echo form_open();?>
<div id="addUser" class="card">        
  <div class="panel-header">
      <div class="col"><h4 class="panel-title h5">User Information for <?php echo ucwords($row->name); ?></h4></div>          
  </div>
   
  <div class="panel-body">          
    <div class="row">
        <div class="col"><h5 class="panel-title h5"><i class="fa fa-user"></i> User Details</h5></div>
    </div>
          
    <div class="form-row">
      <div class="col">
        <div class="form-group">
            <label class="col-form-label col-sm-2"><span >Name*</span></label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="" name="name" value="<?php echo set_value('name',$row->name);?>" required/>
          </div>
        </div>
      </div>     
    </div>

    <div class="form-row">
      <div class="col">
        <div class="form-group">
          <label class="col-form-label col-sm-2"><span>Email*</span></label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="" name="text" value="<?php echo set_value('email',$row->email);?>" required>            
        </div>
        </div>
      </div>  
    </div>

    <div class="form-row">
      <div class="col-auto">                       
        <div class="form-group">
            <label class="col-form-label col-sm-2"><span>Password*</span></label>                           
            <div class="col-sm-10">
            <a class="form-control btn btn-sm bg-red-400 btn-outline-warning" href="#" data-toggle="modal" data-target="#changePass">
              <i class="fa fa-pencil"></i> &nbsp;Change Password
            </a>                  
          </div>
            <script>$(document).ready(function() {  $('#changePass').on('show.bs.modal', function (event) {});} );</script>            
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="col">                      
        <div class="form-group">
          <label class="col-form-label col-sm-2"><span>Active*</span></label>
          <div class="col-sm-10">
          <select class="form-control" name="isActive" required >
            <option value="1" <?php echo set_select('isActive', '1', ($row->active >= 1?TRUE:FALSE) ) ?>>YES</option>
            <option value="0" <?php echo set_select('isActive', '0', ($row->active <= 0?TRUE:FALSE) ) ?>>NO</option>
          </select>              
          </div>    
        </div>        
      </div>      
    </div>
       

    <?php if($this->user->is_admin):?>    
    <div class="form-row">
      <div class="form-group">
        <label class="col-form-label col-sm-2"><i class="fa fa-lock"></i> User Restrictions</label>
        <div class="col-sm-10">
        <?php foreach($this->roles as $role): ?>                    
          <div class="checkbox checkbox-theme">             
            <input 
              type="checkbox" 
              class="form-check-input" 
              <?php echo set_checkbox($role->name, $role->id, in_array($role->name, $row->allowed_access)); ?> 
              name="<?php echo $role->name; ?>" 
              value="<?php echo $role->id; ?>"
              id="checkbox<?php echo $role->id; ?>"> 
            <label class="form-check-label" for="checkbox<?php echo $role->id; ?>"><?php echo ucwords($role->description)?></label>
          </div>           
        <?php endforeach; ?>  
        </div>
      </div>          
    </div>
    <?php endif;?>    

    <div class="panel-footer">                 
      <div class="form-row">
        <div class="col text-right">                                 
          <button type="submit" class="btn btn-primary btn-sm" name="update"><i class="fa fa-user-plus"></i> Update</button>
          <button type="submit" class="btn btn-danger btn-sm" name="discard"><i class="fa fa-ban"></i> Cancel</button>
        </div> 
      </div>       
    </div>
</div>
<?php echo form_close();?>


<div class="modal fade bs-example-modal-sm" id="changePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <form method="POST">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i> Change Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <label>New Password:</label>
              <input type="password" class="form-control" id="newPass" name="newPass"/>
              <br />

              <label>New Password (again):</label>
              <input type="password" class="form-control" id="newPassCheck" name="newPassCheck" />
              <br />
            </div>
          </div>
        </div>
        <div class="modal-footer">      	
          <button type="submit" class="btn btn-primary btn-sm" name="changePassword"><i class="fa fa-check"></i> Update</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
        </div>
      </div>
    </div>
  </form>
</div>

</div>
    </div>
</div>

<?php   $this->load->view('admin/__includes/footer'); ?>
