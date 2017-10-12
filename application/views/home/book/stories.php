<table class="table ">
    <thead>
    <td>序号</td><td>编号</td><td>书名</td><td>价钱</td><td>数量</td>
    </thead>
    <tbody>
    <?php  $i=1;  ?>
    <?php  foreach($books as $book) :?>
    <tr>
        <td><span class="badge"> <?=$i++ ?> </span></td>
        <td><?=$book["id"] ?> </td>
        <td> <?=$book["name"] ?></td>
        <td><?=$book["price"] ?> </td>
        <td><?=$book["count"] ?> </td>

    </tr>
    <?php  endforeach   ?>
    </tbody>

</table>