<?php
use App\Libs\Database;
use App\Libs\Helper;

$title = "Newest Members";
$blockId = 'b-' . sha1($title);

$db = Database::getInstance();
$datetime = Helper::dateTime();
$user = $db->select("SELECT `id`, `username` FROM `users` WHERE status = 'confirmed' AND privacy != 'strong' ORDER BY id DESC LIMIT 7");
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->
        <?php if (!$user): ?>
            <p class="text-center"> Nothing found </p>
        <?php else: ?>
            <?php foreach ($user as $key => $u): ?>
                <a href="<?= url('/user/id/' . $u->id ); ?>" class="list-group-item"> <?= $u->username . " " ?> </a>
            <?php endforeach; ?>
        <?php endif; ?>
    <!-- end content -->
    </div>
</div>
<br />
