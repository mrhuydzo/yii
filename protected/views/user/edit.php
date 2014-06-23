<div class="page-content">
    <div class="page-header">
        <h1>
            Form Elements
            <small>
                <i class="icon-double-angle-right"></i>
                Common form elements and layouts
            </small>
        </h1>
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
            <form class="form-horizontal" role="form" action="<?php echo $this->createUrl('user/update',array('user_id'=>$model->user_id)) ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $model->user_id ?>">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> User name </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-2" placeholder="User name" name="display_name" value="<?php echo $model->display_name; ?>"  class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Password </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-2" placeholder="Password" name="password" value="<?php echo $model->password; ?>"  class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Email </label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-2" placeholder="Email" name="email" value="<?php echo $model->email; ?>"  class="col-xs-10 col-sm-5" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"> Avatar </label>
                    <div class="col-sm-9">
                        <input type="file" name="avatar" class="col-xs-10 col-sm-5" multiple value="<?php echo $model->avatar; ?>" />
                    </div>
                    <div class="col-sm-9">
                        <img src="upload/<?php echo $model->avatar; ?>" alt="" width="200" />
                    </div>
                </div>

                <div class="space-4"></div>

                <div class="clearfix form-actions">
                    <div  class="col-md-offset-3 col-md-9">
                        <button  class="btn btn-info" type="submit">
                            <i class="icon-ok bigger-110"></i>update
                        </button>
                    </div>
                </div>
                <div class="hr hr-24"></div>
            </form>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->