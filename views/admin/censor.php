<?php
include "menus.php";
?>

<?php
$title = $this->title;
$blockId = "f-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <form action="<?= url("/admin/censor"); ?>" method="post" autocomplete="off">
            <table width="100%" align="center">
                <tr>
                    <td align="center">Write <b>one word per line</b> to ban it (will be changed into *censored*)</td>
                </tr>
                <tr>
                    <td align="center">
                        <textarea name="badwords" rows="20" cols="60"><?= $this->badwords; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <input type="submit" value="Confirm" />
                    </td>
                </tr>
            </table>
        </form><br />


    <!-- end content -->
    </div>
</div>
<br />
