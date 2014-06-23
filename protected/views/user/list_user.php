<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->

            <div class="row">
                <div class="col-xs-12">
                <h3 class="header smaller lighter blue">jQuery dataTables</h3>
                    <?php
                        if(Yii::app()->user->hasFlash('del_success')):
                        foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                echo '<div class="help-block " style="color:palevioletred">' . $message . "</div>\n";
                        }
                        endif;
                    ?>
                    <div class="table-header">Danh sách User</div>
                    <div class="table-responsive">
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>id</th>
                                    <th>User Name</th>
                                    <th>Pass</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        //var_dump($list_model);die;
                        foreach($list_model as $key =>$model) {?>
                            <tr>
                                <td><?php echo $key + 1;?></td>
                                <td><a href="<?php echo $this->createUrl('type/view',array("id"=>$model->user_id)); ?>"><?php echo $model->user_id ?></a></td>
                                <td align="center">
                                    <?php
                                    $srcImg = $model->avatar;
                                    if(!$srcImg){
                                        $avarta = '<img src="upload/default_avatar.jpg" alt="" width="50" />';
                                    }else{
                                        $avarta = '<img src="upload/'.$srcImg.'" alt"" width="50" />';
                                    }
                                    ?>
                                    <?php echo $model->display_name ?> <br />
                                    <?php echo $avarta; ?>
                                </td>
                                <td><?php echo $model->password ?></td>
                                <td><?php echo $model->email ?></td>
                                <td>
                                    <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                        <a class="blue" href="<?php echo $this->createUrl('user/view',array("user_id"=>$model->user_id)); ?>">
                                            <i class="icon-zoom-in bigger-130"></i>
                                        </a>
                                        <a class="green" href="<?php echo $this->createUrl('user/edit',array("user_id"=>$model->user_id)); ?>">
                                            <i class="icon-pencil bigger-130"></i>
                                        </a>
                                        <a class="red" href="<?php echo $this->createUrl('user/delete',array("user_id"=>$model->user_id)); ?>">
                                            <i class="icon-trash bigger-130"></i>
                                        </a>
                                    </div>

                                    <div class="visible-xs visible-sm hidden-md hidden-lg">
                                        <div class="inline position-relative">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-caret-down icon-only bigger-120"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="<?php echo $this->createUrl('type/view',array("user_id"=>$model->user_id)); ?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                        <span class="blue"><i class="icon-zoom-in bigger-120"></i></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $this->createUrl('type/edit',array("user_id"=>$model->user_id)); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green"><i class="icon-edit bigger-120"></i></span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                        <span class="red"><i class="icon-trash bigger-120"></i></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }?>


                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

<!-- basic scripts -->

<!--[if !IE]> -->

<!--<script src="../../../../ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->

<!-- <![endif]-->

<!--[if IE]>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='admin/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='admin/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<!--<script src="admin/assets/js/bootstrap.min.js"></script>-->
<!--<script src="admin/assets/js/typeahead-bs2.min.js"></script>-->

<!-- page specific plugin scripts -->

<script src="admin/assets/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/js/jquery.dataTables.bootstrap.js"></script>

<!-- ace scripts -->

<!--<script src="admin/assets/js/sexy-elements.min.js"></script>-->
<!--<script src="admin/assets/js/sexy.min.js"></script>-->

<!-- inline scripts related to this page -->

<script type="text/javascript">
    jQuery(function($) {
        var oTable1 = $('#sample-table-2').dataTable( {
            "aoColumns": [
                { "bSortable": false },
                null,
                { "bSortable": false }
            ] } );


        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
    })
</script>

