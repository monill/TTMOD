
<div class="card">
    <div class="card-header">
        <?php
        echo $NOTICE = "NOTICE";
        $blockN = 'b-' . sha1($NOTICE);
        ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockN; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?= $blockN; ?>">
    <!-- content -->

    Welcome To TTMOD<br /><br />The complete open source torrent tracter view our <a href="<?= url('/forum'); ?>">forum</a> for support

    <!-- end content -->
    </div>
</div>
<br />

<div class="card">
    <div class="card-header">
        <?php
        echo $News = "News";
        $blockNw = 'b-' . sha1($News);
        ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockNw; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?= $blockNw; ?>">
    <!-- content -->

        <?php foreach ($this->news as $nw): ?>
            <b><?= $nw->title; ?></b><br />
            <?php echo date("d-m-Y", strtotime($nw->created_at)); ?>
            <p><?= $nw->content; ?></p>
        <?php endforeach; ?>

    <!-- end content -->
    </div>
</div>
<br />

<div class="card">
    <div class="card-header">
        <?php
        echo $Disclaimer = "Disclaimer";
        $blockId = 'b-' . sha1($Disclaimer);
        ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?= $blockId; ?>">
    <!-- content -->

    <p>None of the files shown here are actually hosted on this server. The links are provided
        solely by this sites users. The administrator of this site cannot be held responsible for
        what its users post, or any other actions of its users. You may not use this site to
        distribute or download any material when you do not have the legal rights to do so. It is
        your own responsibility to adhere to these terms.</p>

    <!-- end content -->
    </div>
</div>
<br />
