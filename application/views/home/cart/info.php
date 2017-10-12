
<div class="title"><span class="title_icon"><img src=" <?=ROOT_URL.'public/images/front/cart.gif'?>" alt="" title="" /></span>My cart</div>
<div class="home_cart_content">
    <?=$cart['totalCount']?> x items | <span class="red">TOTAL: <?=$cart['totalPrice']?>$</span>
</div>
<a href="<?=LinkHelper::createLinkURL('index','cart')?>" class="view_cart">view cart</a>

