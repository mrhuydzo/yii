<?php /* @var $this SiteController */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <?php $this->renderPartial('//layouts/all/all_head'); ?>
</head>

<body>

<div id="container" class="container">
    <div id="header">
        <div class="headerInner">
            <?php $this->renderPartial('//layouts/all/all_header'); ?>
        </div>
    </div><!-- header -->

    <div class="main">
        <div class="mainInner row cf">
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'htmlOptions' =>array('class'=>'breadcrumb')
                )); ?><!-- breadcrumbs -->
            <?php endif?>
            <div class="col-left col-md-3">
                <h2 class="tc-center">Col Left</h2>
            </div>
            <div class="col-main col-md-6">
                <h2 class="tc-center">Col Main</h2>
                <?php  echo $content; ?>
            </div>
            <div class="col-right col-md-3">
                <h2 class="tc-center">Col Right</h2>
            </div>
        </div>
    </div>

    <footer id="footer">
        <?php $this->renderPartial('//layouts/all/all_footer'); ?>
    </footer>
</div><!-- page -->



</body>
</html>
