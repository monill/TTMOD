<?php
$title = "Users online";
$blockId = 'b-' . sha1($title);

$db = Database::getInstance();
$user = $db->select("SELECT `id`, `username` FROM `users` WHERE enable = 'yes' AND status = 'confirmed' AND privacy != 'strong'");
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->
        <?php if (!$user): ?>
            <p class="text-center"> No Users Online </p>
        <?php else: ?>
            <?php foreach ($user as $key => $u): ?>
                <a href="<?= url('/user/id/', $u->id); ?>">
                    <?= $u->username . " " ?>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    <!-- end content -->
    </div>
</div>
<br />
