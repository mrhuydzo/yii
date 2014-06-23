<div class="footerInner row">
    <div class="col-lg-12">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div>
</div>
<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/jquery.bxslider.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider({
            auto: true,
            slideWidth: 1170,
            autoDelay: 8000,
            captions: true
        });
    });
</script>
