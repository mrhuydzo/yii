<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="header smaller lighter blue">Quản lý tin tức</h3>
                    <?php
                    if(Yii::app()->user->hasFlash('del_success')):
                        foreach(Yii::app()->user->getFlashes() as $key => $message) {
                            echo '<div class="help-block " style="color:palevioletred">' . $message . "</div>\n";
                        }
                    elseif(Yii::app()->user->hasFlash('success')):
                        echo 'Thêm thành công';
                    endif
                    ?>

                    <div class="table-header row">
                        <div class="col-md-7">
                            Danh sách Category
                        </div>
                        <div class="col-md-5">Lọc theo
                            <select name="slFilter" class="slFilter" id="slFilter">
                                <option>Lọc theo</option>
                                <?php foreach($listAllCat as $key => $value){ ?>
                                    <option value="<?php echo $value->in ?>"><?php echo $value->title_cat ?></option>
                                    <?php $listSubCat = Category::getAllSubCat($value->in) ?>
                                    <?php foreach($listSubCat as $subKey => $subValue){ ?>
                                        <option value="<?php echo $subValue['in'] ?>">--<?php echo $subValue['title_cat'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th width="5%">id</th>
                                <th width="10%">Thumbnail</th>
                                <th width="50%">Tiêu đề</th>
                                <th width="5%">Status</th>
                                <th width="10%">Ngày tạo</th>
                                <th width="10%">Người tạo</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //var_dump($list_model);die;
                            foreach($listNews as $key =>$model) {?>
                                <tr>
                                    <td><?php echo $key + 1 ;?></td>
                                    <td><?php echo $model->id ;?></td>
                                    <td><a href="" title=""><img src="upload/<?php echo $model->thumb ?>" width="50" alt="" /></a></td>
                                    <td><a href=""><?php echo $model->title ?></a></td>
                                    <td><a href="">Status</a></td>
                                    <td><?php echo $model->pub_time ?></td>
                                    <?php $user_info = User::getUsernameFromID($model->user_id); ?>
                                    <td><?php if($user_info) { echo $user_info[0]->display_name;}?></td>
                                    <td>
                                        <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
                                            <a class="blue" href="">
                                                <i class="icon-zoom-in bigger-130"></i>
                                            </a>
                                            <a class="green" href="">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>
                                            <a class="red"  href="javascript:void(0)">
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
                                                        <a href="" class="tooltip-info" data-rel="tooltip" title="View">
                                                            <span class="blue"><i class="icon-zoom-in bigger-120"></i></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                            <span class="green"><i class="icon-edit bigger-120"></i></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="" class="tooltip-error red" data-rel="tooltip" title="Delete">
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.red').hover(function(){
            console.log(<?php echo $idNews ?>);
        })


        $('#slFilter').change(function(){
            var catid = $(this).val();
            var dataString ='catid/'+catid;
            $.ajax({
                type:"POST",
                url: "<?php  echo Yii::app()->createUrl('AdminNews/FilterNews'); ?>/"+dataString,
                data: dataString,
                success:function(html){
                    $("#sample-table-2").html(html);
                },
                error:function(){
                    alert("Có lỗi xảy ra!");
                }
            });
        });
    });
</script>




