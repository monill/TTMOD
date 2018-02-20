
<div class="card">
    <div class="card-header">
        <?php
        echo $News = "News";
        $blockNw = "b-" . sha1($News);
        ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockNw; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?= $blockNw; ?>">
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
