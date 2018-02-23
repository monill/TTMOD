<?php

use App\Libs\Database;

$title = "Most Active Torrents";
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

        <?php $activetor = $db->select("SELECT `id`, `name`, `seeders`, `leechers` FROM `torrents` WHERE `banned` = 'no' AND `visible` = 'yes' ORDER BY `seeders` + `leechers` DESC, `seeders` DESC, `created_at` ASC LIMIT 10"); ?>

    <?php if ($activetor): ?>
		<?php foreach ($activetor as $row): ?>
            <?php $smallname = htmlspecialchars(substr($row->name, 0, 30)) . "..."; ?>
            <div class="pull-left">
                <a href="<?= url("/torrent/view/") . $row->id; ?>" title="<?= htmlspecialchars($row->name); ?>"> <?= $smallname; ?> </a>
            </div>
            <div class="pull-left">
                <span class="label label-success"> S: <?php echo number_format($row->seeders); ?></span>
                <span class="label label-warning"> L: <?php echo number_format($row->leechers); ?></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
            <p class="text-center"> Nothing found </p>
    <?php endif; ?>

    <!-- end content -->
    </div>
</div>
<br />
