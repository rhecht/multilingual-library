<!-- header -->
<?php
	$this->load->view('admin/__includes/header');
?>
			<!-- BEGIN PAGE HEADING -->
            <div class="page-head">
				<h1 class="page-title">Data Tables<small>small text goes here</small></h1>
				<!-- BEGIN BREADCRUMB -->
				<ol class="breadcrumb">
					<li><a href="#"><i class="ion-home margin-right-5"></i> Dashboard</a></li>
					<li><a href="#">Tables</a></li>
					<li class="active">Data Tables</li>
				</ol>
				<!-- END BREADCRUMB -->
			</div>
			<!-- END PAGE HEADING -->

            <div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
                           <div class="panel no-border ">
                                <div class="panel-title bg-white no-border">
									<div class="panel-head">Data Table</div>
									<div class="panel-tools">
									<a href="#" data-toggle="dropdown"><i class="ion-gear-a"></i></a>  
									<ul class="dropdown-menu pull-right margin-right-10">
										<li>
											<a href="#"><i class="ion-gear-a"></i> Settings </a>
										</li>
										<li>
											<a href="#"><i class="ion-ios-printer"></i> Print </a>
										</li>
										<li>
											<a href="#"><i class="ion-refresh"></i> Refresh </a>
										</li>
                                    </ul>
									<a href="#" class="panel-refresh"><i class="ion-refresh"></i></a>
									<a href="#" class="panel-close" data-effect="fadeOutDown"><i class="ion-close"></i></a>
								</div>
								</div>
                                <div class="panel-body no-padding-top bg-white">
									<h3 class="color-grey-700">Basic example</h3>
									<p class="text-light margin-bottom-30">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table.</p>