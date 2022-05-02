<?php
	$this->load->view('admin/__includes/table-header');
?>
                                        <table id="example2" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <?php foreach ($records_header as $item):?>
                                                    <th style="width:100px;word-wrap:break-word;"><?php echo $item;?></th>
                                                    <?php endforeach;?>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php
                                                ?>
                                                    <?php foreach ($records as $key => $items):?>
                                                    <tr>
                                                <?php foreach ($items as $keyspecific => $item):?>

                                                    <td style="width:100px;word-wrap:break-word;">
													<?php
														//print_r($items);
														if($keyid==$keyspecific){
													?>
                                                        <a href="admin/article/<?php echo $items->ArticleID ?>">
	                                                        <?php echo $item; ?>
                                                        </a>
                                                        <?php
														}
														else{
                                                    		echo $item;
														}
													?>
                                                    </td>
                                                    <?php endforeach;?>
                                                    <td>
                                                        <a href="admin/article/<?php echo $items->ArticleID ?>">
                                                        Edit
                                                        </a>
                                                    </td>
                                                    </tr>
                                                    <?php endforeach;?>

                                          </tbody>
                                          <tfoot>
                                            <tr>
                                                <td>
                                                    <?php echo $links; ?>
                                                </td>
                                            </tr>
                                          </tfoot>
                                    </table>

<?php
	$this->load->view('admin/__includes/table-footer');
?>