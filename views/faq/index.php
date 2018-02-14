
<?php foreach ($this->categs as $categ): ?>
<?php $blockId = "b-" . sha1($categ->name); ?>

<div class="card">
    <div class="card-header <?= $categ->style; ?>">
        <b><?= $categ->name; ?></b>
        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?= $blockId; ?>">
    <!-- content -->

        <?php foreach ($this->answers as $answer): ?>
            <?php if ($answer->categ_id == $categ->id): ?>
                <?php $blockd = "b-" . sha1($answer->question); ?>
                <div class="card">
                    <div class="card-header <?= $answer->style; ?>">
                        <b><?= $answer->question ?></b>
                        <a data-toggle="collapse" href="#" class="showHide" id="<?= $blockd; ?>" style="float: right;"></a>
                    </div>
                    <div class="card-body slidingDiv<?= $blockd; ?>">
                    <!-- content -->

                        <?= $answer->answer ?>

                    <!-- end content -->
                    </div>
                </div>
                <br/>
            <?php endif; ?>
        <?php endforeach; ?>

    <!-- end content -->
    </div>
</div>
<br />
<?php endforeach; ?>
