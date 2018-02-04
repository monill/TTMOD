<?php
$title = "Navigation";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <div class="list-group">
    	<a href="<?= url("/home"); ?>" class="list-group-item"><i class="fa fa-chevron-right"></i> Home </a>
    	<a href="<?= url("/torrents"); ?>" class="list-group-item"><i class="fa fa-chevron-right"></i> Torrents </a>
    	<a href="torrents-today.php" class="list-group-item"><i class="fa fa-chevron-right"></i> Todays Torrents </a>
    	<a href="torrents-search.php" class="list-group-item"><i class="fa fa-chevron-right"></i> Search </a>
    	<a href="torrents-needseed.php" class="list-group-item"><i class="fa fa-chevron-right"></i> Torrents Need Seed </a>
    	<a href="torrents-import.php" class="list-group-item"><i class="fa fa-chevron-right"></i> Mass Torrent Import </a>
    	<a href="teams-view.php" class="list-group-item"><i class="fa fa-chevron-right"></i> Teams </a>
    	<a href="<?= url("/members"); ?>" class="list-group-item"><i class="fa fa-chevron-right"></i> Members </a>
    	<a href="<?= url("/rules"); ?>" class="list-group-item"><i class="fa fa-chevron-right"></i> Rules </a>
    	<a href="<?= url("/faq"); ?>" class="list-group-item"><i class="fa fa-chevron-right"></i> F.A.Q </a>
    	<a href="<?= url("/staff"); ?>" class="list-group-item"><i class="fa fa-chevron-right"></i> Staff </a>
    </div>

    <!-- end content -->
    </div>
</div>
<br />
