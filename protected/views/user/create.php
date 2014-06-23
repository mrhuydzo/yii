<?php  ?>
<div class="page-content">
    <div class="page-header">
        <h1>Tạo  User<small><i class="icon-double-angle-right"></i>Common form elements and layouts</small></h1>
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
            <form class="form-horizontal" role="form" action="<?php echo $this->createUrl('user/save') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> User name </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-2" placeholder="User name" name="display_name" class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Password </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-3" placeholder="Password" name="password" class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-4"> Email </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-4" placeholder="Email" name="email" class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"> Avatar </label>
                    <div class="col-sm-9">
                        <input type="file" name="avatar" class="col-xs-10 col-sm-5" multiple />
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