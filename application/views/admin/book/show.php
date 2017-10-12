<h4><?=$book["name"]?></h4>
<h4><?=$book["price"]?></h4>
<h4><?=$book["count"]?></h4>

<p><?=$book["content"]?></p>

<a class="btn btn-info" href="<?=isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:LinkHelper::createLinkURL("all")?>"> Return</a>