<?php /* @var $this Controller */ ?>
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

    <div class="main pageListNews">
        <div class="mainInner row cf">
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                //'homeLink'=>true,
                'tagName'=>'ul',
                 //'separator'=>'',
                'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
                'htmlOptions' =>array('class'=>'breadcrumb')
            )); ?><!-- breadcrumbs -->
            <?php endif?>
            <div class="col-main col-md-12">
                <div id="contentNews">
                    <?php echo $content; ?>
                </div><!-- content -->
            </div>
        </div>
    </div>

    <footer id="footer">
        <?php $this->renderPartial('//layouts/all/all_footer'); ?>
    </footer>
</div><!-- page -->

</body>
</html>
