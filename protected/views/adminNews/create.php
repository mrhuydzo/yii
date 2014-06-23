<div class="page-content">
    <div class="page-header">
        <h1>Viết bài<small><i class="icon-double-angle-right"></i>Common form elements and layouts</small></h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                foreach($message as $key2 => $value){
                    echo '<div class="help-block " style="color:palevioletred">' . $value . "</div>\n";
                }
            }
            ?>
            <form class="form-horizontal" role="form" action="<?php echo $this->createUrl('adminNews/save') ?>" method="post">
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right" for="form-field-2"> Title News </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-2" placeholder="Title Article" name="title" class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right" for="form-field-3"> Content News </label>
                    <div class="col-sm-9">
                        <textarea class="col-xs-10 col-sm-5 editor1" id="form-field-3" placeholder="Content Article" name="content"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right"> User </label>
                    <div class="col-sm-5">
                        <select class="col-sm-5 chosen-select" name="slUser">
                            <?php foreach($listUser as $key=>$value){ ?>
                                <option value="<?php echo $value->user_id ?>"><?php echo $value->display_name; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right"> Category </label>
                    <div class="col-sm-5">
                        <select class="col-sm-5 chosen-select" name="slParent" data-placeholder="Choose a Country...">
                            <option value="">Gốc</option>
                            <?php foreach($listCat as $key2=>$value2){ ?>
                                <option value="<?php echo $value2->in ?>"><?php echo $value2->title_cat; ?></option>
                                <?php $listSubCat = Category::getAllSubCat($value2->in); ?>
                                <?php foreach ($listSubCat as $key3 => $value3){ ?>
                                    <option value="<?php echo $value3['in'] ?>">---<?php echo $value3['title_cat'] ?></option>
                                <?php } ?>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right"> Ngày xuất bản </label>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <input class="form-control date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" name="pubdate" />
                            <span class="input-group-addon">
                                <i class="icon-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-1 control-label no-padding-right"> Thumb </label>
                    <div class="col-sm-9">
                        <input type="file" class="" name="thumbNews" />
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button  class="btn btn-info" type="submit">
                            <i class="icon-ok bigger-110"></i>
                            Submit
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="icon-undo bigger-110"></i>
                            Reset
                        </button>
                    </div>
                </div>
                <div class="hr hr-24"></div>
            </form>

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->

