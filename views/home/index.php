


Page Home






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
