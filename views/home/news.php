<?php
$title = "News";
$blockId = "b-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?php foreach (isset($this->news) ? $this->news : $this->news as $nw): ?>
            <b><?= $nw->title; ?></b><br />
            <?php echo date("d-m-Y", strtotime($nw->created_at)); ?>
            <p><?= $nw->content; ?></p>
        <?php endforeach; ?>

    <!-- end content -->
    </div>
</div>
<br />
