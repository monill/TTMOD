<?php

use App\Libs\Database;
use App\Libs\Helper;

$title = "Latest Torrents";
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

        <?php $latestuploadsquery = $db->select("SELECT `id`, `name`, `size`, `seeders`, `leechers` FROM `torrents` WHERE `banned` = 'no' AND `visible` = 'yes' ORDER BY `id` DESC LIMIT 5"); ?>

	<?php if ($latestuploadsquery): ?>
		<?php foreach ($latestuploadsquery as $row): ?>
				<?php $smallname = htmlspecialchars(substr($row->name, 0, 30)) . "..."; ?>
				<div class="pull-left">
					<a href="<?= url("/torrent/view/") . $row->id; ?>" title="<?= htmlspecialchars($row->name); ?>"> <?= $smallname; ?> </a>
				</div>
				<div class="pull-left"> Size:
					<span class="label label-success"> <?= Helper::makeSize($row->size); ?> </span>
				</div>
		<?php endforeach; ?>
	<?php else: ?>
			<p class="text-center"> Nothing found </p>
	<?php endif; ?>

	<!-- end content -->
    </div>
</div>
<br />
