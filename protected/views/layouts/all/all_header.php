<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Start Bootstrap</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php $this->widget('zii.widgets.CMenu',array(
                'htmlOptions' => array('class' => 'nav navbar-nav'),
                'id' => 'nav',
                //'actionPrefix'=>'nav navbar-nav',
                'items'=>array(
                    array('label'=>'Home', 'url'=>array('/site/index','active'=>Yii::app()->controller->id=='site')),
                    array('label'=>'Tin tức', 'url'=>array('/news'),'active'=>Yii::app()->controller->id=='news'),
                    array('label'=>'About', 'url'=>array('/site/page', 'active'=>Yii::app()->controller->id=='news', 'view'=>'about')),
                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            )); ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>