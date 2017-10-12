<div class="title"><span class="title_icon">
        <img src="<?=ROOT_URL.'public/images/front/bullet1.gif'?>" alt="" title="" /></span>My cart</div>

<div class="feat_prod_box_details">

    <table class="cart_table">
        <tr class="cart_title">
            <td>Item pic</td>
            <td>Book name</td>
            <td>Unit price</td>
            <td>Qty</td>
            <td>Total</td>
            <td>Action</td>
        </tr>
        <?php if($cart['allGoods']==null) :?>
        <?php else :?>
        <?php foreach($cart['allGoods'] as $row) :?>
        <tr>
            <td><a href="details.html"><img src="<?=ROOT_URL.'public/images/front/cart_thumb.gif'?>" alt="" title="" border="0" class="cart_thumb" /></a></td>
            <td><a href="<?=LinkHelper::createLinkURL('detail','book').'/'.$row['id']?>"><?=$row['name']?></a></td>
            <td><?=$row['price']?>$</td>
            <td><?=$row['count']?></td>
            <td><?=$row['price']*$row['count']?> $</td>
            <td>
                <form method="post" action="<?=LinkHelper::createLinkURL('add','cart').'/'.$row['id']?>">

                    <input type="submit" value="+"   />
                </form>
                <form method="post" action="<?=LinkHelper::createLinkURL('remove','cart').'/'.$row['id']?>">
                    <input type="submit" value="-"     />
                </form>
            </td>
        </tr>
        <?php endforeach ?>
        <?php endif ?>
        <tr>
            <td colspan="4" class="cart_total"><span class="red">TOTAL SHIPPING:</span></td>
            <td> <?=$cart['totalCount']?></td>
        </tr>

        <tr>
            <td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
            <td> <?=$cart['totalPrice']?>$</td>
        </tr>

    </table>
    <a href="#" class="continue">&lt; continue</a>
    <a href="<?=LinkHelper::createLinkURL('checkout','order')?>" class="checkout">checkout &gt;</a>




</div>




<div class="clear"></div>