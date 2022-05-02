		<!-- BEGIN LEFTSIDE -->
        <div class="leftside">
<!-- sidebar left -->
			<div class="sidebar">
				<!-- BEGIN RPOFILE -->
				<div class="nav-profile">
					<div class="thumb">
						<img src="<?php echo $this->config->item('admin_theme') ?>/img/avatar.jpg" class="img-circle" alt="" />
						<span class="label label-danger label-rounded">0</span>
					</div>
					<div class="info">
						<a href="<?php echo site_url('admin/users/profile/'.$this->user->id);?>"><?php echo $this->user->name;?></a>
						<?php /*
                        <ul class="tools list-inline">
							<li><a href="#" data-toggle="tooltip" title="Settings"><i class="ion-gear-a"></i></a></li>
							<li><a href="#" data-toggle="tooltip" title="Events"><i class="ion-earth"></i></a></li>
							<li><a href="#" data-toggle="tooltip" title="Downloads"><i class="ion-archive"></i></a></li>
						</ul>
                        */ ?>
					</div>
					<a href="<?php echo site_url('admin/users/logout');?>" class="button"><i class="ion-log-out"></i></a>
				</div>
				<!-- END RPOFILE -->
				<!-- BEGIN NAV -->
				<div class="title">Navigation</div>
					<ul class="nav-sidebar">
						<li class="active">
                            <a href="<?php echo site_url('admin');?>">
                                <i class="ion-home"></i> <span><?php echo lang('Dashboard'); ?></span>
                        </a></li>
                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/api');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('API'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('admin/api');?>"><?php echo lang('View API'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/api/add');?>"><?php echo lang('Add API'); ?></a></li>                            
                            </ul>
                        </li>

                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/article');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('Articles'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                            	<li><a href="<?php echo site_url('admin/article');?>"><?php echo lang('View Articles'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/article/add');?>"><?php echo lang('Add Article'); ?></a></li>                            
                            </ul>
                        </li>
                        
                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/category');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('Categories'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('admin/category');?>"><?php echo lang('View Categories'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/category/add');?>"><?php echo lang('Add Category'); ?></a></li>                            
                            </ul>
                        </li>   

                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/author');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('Authors'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('admin/author');?>"><?php echo lang('View Authors'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/author/add');?>"><?php echo lang('Add Authors'); ?></a></li>
                            </ul>
                        </li>        

                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/language');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('Language'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('admin/language');?>"><?php echo lang('View Language'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/language/add');?>"><?php echo lang('Add Language'); ?></a></li>                            
                            </ul>
                        </li>       

                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/mediatype');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('Media Type'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('admin/mediatype');?>"><?php echo lang('View Media Type'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/mediatype/add');?>"><?php echo lang('Add Media Type'); ?></a></li>                            
                            </ul>
                        </li>   

                        <li class="nav-dropdown">
                            <a href="<?php echo site_url('admin/users');?>">
                                <i class="ion-compose"></i> <span><?php echo lang('Users'); ?></span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('admin/users');?>"><?php echo lang('View Users'); ?></a></li>
                                <li><a href="<?php echo site_url('admin/users/add');?>"><?php echo lang('Add User'); ?></a></li>                            
                            </ul>
                        </li>                        

                    </ul>
					<!-- END NAV -->
					
					<!-- BEGIN WIDGET -->
					<div class="widget">

				    </div>
					<!-- END WIDGET -->
			</div><!-- /.sidebar -->
        </div>
		<!-- END LEFTSIDE -->

