</div><!--end of left content-->
<div class="right_content">
    <div class="languages_box">
        <span class="red">Languages:</span>
        <a href="#" class="selected"><img src="<?=ROOT_URL.'public/images/front/images/gb.gif'?>" alt="" title="" border="0" /></a>
        <a href="#"><img src="<?=ROOT_URL.'public/images/front/fr.gif'?>" alt="" title="" border="0" /></a>
        <a href="#"><img src="<?=ROOT_URL.'public/images/front/de.gif'?>" alt="" title="" border="0" /></a>
    </div>
    <div class="currency">
        <span class="red">Currency: </span>
        <a href="#">GBP</a>
        <a href="#">EUR</a>
        <a href="#" class="selected">USD</a>
    </div>



    <div class="cart">
        <!--cart info sub actions-->
   <?=HtmlHelper::renderStateAction(LinkHelper::createLinkURL('info','cart'))?>
    </div>

    <div class="title"><span class="title_icon"><img src="<?=ROOT_URL.'public/images/front/bullet3.gif'?>" alt="" title="" /></span>About Our Store</div>
    <div class="about">
        <p>
            <img src="images/about.gif" alt="" title="" class="right" />
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.
        </p>

    </div>

    <div class="right_box">
        <!--promotion sub actions-->
        <?=HtmlHelper::renderAction(LinkHelper::createLinkURL('promotions','book'))?>
   </div>

    <div class="right_box">
        <!--cateogry sub actions-->
        <?=HtmlHelper::renderAction(LinkHelper::createLinkURL('categories','category'))?>

        <?=HtmlHelper::renderAction(LinkHelper::createLinkURL('partners','partner'))?>

    </div>


</div><!--end of right content-->





<div class="clear"></div>
</div><!--end of center content-->


<div class="footer">
    <div class="left_footer"><img src="<?=ROOT_URL.'public/images/front/footer_logo.gif'?>" alt="" title="" /><br /> <a href="http://www.cssmoban.com/" title="free templates">cssmoban</a></div>
    <div class="right_footer">
        <a href="#">home</a>
        <a href="#">about us</a>
        <a href="#">services</a>
        <a href="#">privacy policy</a>
        <a href="#">contact us</a>

    </div>


</div>


</div>
<script type="text/javascript">

    var tabber1 = new Yetii({
        id: 'demo'
    });

</script>
</body>
</html>