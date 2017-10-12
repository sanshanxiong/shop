

    <h3><?=$title?></h3>
    <table class="table ">
        <thead>
        <td>序号</td><td>编号</td><td>书名</td><td>价钱</td><td>数量</td>
        </thead>
       <tbody>
       <?php $i=1; ?>
       <?php foreach($books as $book) :?>
           <tr>
               <td><span class="badge"> <?=$i++?> </span></td>
               <td><?=$book["id"]?> </td>
               <td> <?=$book["name"]?></td>
               <td><?=$book["price"]?> </td>
               <td><?=$book["count"]?> </td>
               <td><a class="btn btn-danger" href="<?=LinkHelper::createLinkURL('delete').DS.$book['id']?>" onclick="return confirm('Are you sure?') " >delete</a>
                <a class="btn btn-primary" href="<?=LinkHelper::createLinkURL('update').DS.$book['id']?>" >update</a> </td>
           </tr>
       <?php endforeach  ?>
       </tbody>

    </table>
   <a href="<?=LinkHelper::createLinkURL('add')?>"class="btn btn-success">Add a New Book</a>


