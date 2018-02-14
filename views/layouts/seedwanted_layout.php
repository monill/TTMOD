<?php

use App\Libs\Database;

$title = "Seeders Wanted";
$blockId = "b-" . sha1($title);
$db = Database::getInstance();
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?php $res = $db->select("SELECT `id`, `name`, `seeders`, `leechers` FROM `torrents` WHERE `seeders` = 0 AND `leechers` > 0 AND `banned` = 'no' AND `external` = 'no' ORDER BY `leechers` DESC LIMIT 5"); ?>

        <?php if ($res): ?>
            <?php foreach ($res as $row): ?>
                <?php $smallname = htmlspecialchars(substr($row->name, 0, 30)) . "..."; ?>
                <div class="pull-left">
                    <a href="<?= url("/torrent/view/") . $row->id; ?>" title="<?= htmlspecialchars($row->name); ?>"> <?= $smallname; ?> </a>
                </div>
                <div class="pull-left"> Leechers:
                    <span class="label label-warning"> <?= number_format($row->leechers); ?> </span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
                <p class="text-center"> Nothing found </p>
        <?php endif; ?>

    <!-- end content -->
    </div>
</div>
<br />
