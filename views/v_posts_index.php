
<?php foreach ($posts as $post): ?>
<div><img src = "<?=$post['imagepath']?>" alt="Smiley face" width="42" height="42"><strong><?=$post['firstname']?></strong> <strong><?=$post['lastname']?></strong><br></div>
<?=$post['content']?> <br><br>
<?php endforeach;?>
