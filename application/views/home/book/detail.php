<div class="crumb_nav">
    <a href="index.html">home</a> &gt;&gt; <?=$book['name']?>
</div>
<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span><?=$book['name']?></div>

<div class="feat_prod_box_details">

    <div class="prod_img"><a href="details.html"><img src="images/prod1.gif" alt="" title="" border="0" /></a>
        <br /><br />
        <a href="images/big_pic.jpg" rel="lightbox"><img src="<?=ROOT_URL.'public/images/front/zoom.gif'?>" alt="" title="" border="0" /></a>
    </div>

    <div class="prod_det_box">
        <div class="box_top"></div>
        <div class="box_center">
            <div class="prod_title"><?=$book['name']?></div>
            <p class="details"> <?=strlen($book['content'])<=200?$book['content']:substr($book['content'],200)."..." ?>                 </p>
            <div class="price"><strong>PRICE:</strong> <span class="red"><?=$book['price']?> $</span></div>
            <div class="price"><strong>COLORS:</strong>
                <span class="colors"><img src="images/color1.gif" alt="" title="" border="0" /></span>
                <span class="colors"><img src="images/color2.gif" alt="" title="" border="0" /></span>
                <span class="colors"><img src="images/color3.gif" alt="" title="" border="0" /></span>                    </div>
            <a href="<?=LinkHelper::createLinkURL('add','cart').'/'.$book['id']?>" class="more"><img src="<?=ROOT_URL.'public/images/front/order_now.gif'?>" alt="" title="" border="0" /></a>
            <div class="clear"></div>
        </div>

        <div class="box_bottom"></div>
    </div>
    <div class="clear"></div>
</div>


<div id="demo" class="demolayout">

    <ul id="demo-nav" class="demolayout">
        <li><a class="active" href="#tab1">More details</a></li>
        <li><a class="" href="#tab2">Related books</a></li>
        <li><a class="" href="#tab3">comment</a></li>
    </ul>

    <div class="tabs-container">

        <div style="display: block;" class="tab" id="tab1">
            <p class="more_details">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
            </p>
            <ul class="list">
                <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
                <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
                <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
                <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit</a></li>
            </ul>
            <p class="more_details">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
            </p>
        </div>

        <div style="display: none;" class="tab" id="tab2">
            <div class="new_prod_box">
                <a href="details.html">product name</a>
                <div class="new_prod_bg">
                    <a href="details.html"><img src="images/thumb1.gif" alt="" title="" class="thumb" border="0" /></a>
                </div>
            </div>

            <div class="new_prod_box">
                <a href="details.html">product name</a>
                <div class="new_prod_bg">
                    <a href="details.html"><img src="images/thumb2.gif" alt="" title="" class="thumb" border="0" /></a>
                </div>
            </div>

            <div class="new_prod_box">
                <a href="details.html">product name</a>
                <div class="new_prod_bg">
                    <a href="details.html"><img src="images/thumb3.gif" alt="" title="" class="thumb" border="0" /></a>
                </div>
            </div>

            <div class="new_prod_box">
                <a href="details.html">product name</a>
                <div class="new_prod_bg">
                    <a href="details.html"><img src="images/thumb1.gif" alt="" title="" class="thumb" border="0" /></a>
                </div>
            </div>

            <div class="new_prod_box">
                <a href="details.html">product name</a>
                <div class="new_prod_bg">
                    <a href="details.html"><img src="images/thumb2.gif" alt="" title="" class="thumb" border="0" /></a>
                </div>
            </div>

            <div class="new_prod_box">
                <a href="details.html">product name</a>
                <div class="new_prod_bg">
                    <a href="details.html"><img src="images/thumb3.gif" alt="" title="" class="thumb" border="0" /></a>
                </div>
            </div>



            <div class="clear"></div>
        </div>
        <div style="display: block;" class="tab" id="tab3">
            <?=HtmlHelper::renderAction(LinkHelper::createLinkURL('add','comment').'/'.$book['id'])?>
            </div>
    </div>


</div>



<div class="clear"></div>