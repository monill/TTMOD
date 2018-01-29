<?php
$title = "Browse Torrents";
$blockId = 'b-' . sha1($title);
use App\Models\Torrent;
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <div class="list-group">
            <a href="<?= url('/torrents'); ?>" class="list-group-item">
                <i class="fa fa-folder-open"></i> Show all </a>
                <?php foreach (Torrent::categories() as $c): ?>
                    <a href="<?= url('/torrents/categ/' . $c->slug) ?>" class="list-group-item">
                        <i class="fa fa-folder-open"></i> <?= $c->name;?> </a>
                <?php endforeach; ?>
        </div>

	<!-- end content -->
    </div>
</div>
<br />
