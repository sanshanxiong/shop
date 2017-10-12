<h3><?=$title?></h3>
<p>name:<?=$user['name']?></p>
<p>address:<?=$user['address']?></p>
<p>level:<?=$user['level']?></p>
<p>money:<a href="<?=LinkHelper::createLinkURL('deposit','user')?>"><?=$user['account']?></a></p>