<?php
$title = "Upload/Import Torrents";
$blockId = "f-" . sha1($title);
?>
<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <form name="upload" enctype="multipart/form-data" action="<?= url("/torrent/import"); ?>" method="post">
        <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
        <table border="0" cellspacing="0" cellpadding="6" align="center">
            <tr>
                <td align="right" valign="top">
                    <b>File List:</b>
                </td>
                <td align="left">
                <?php
                    if (!count($this->files)) {
                        echo "Nothing to show.<br />Place files to import in data/import/";
                    } else {
                        foreach ($this->files as $f) {
                            echo htmlspecialchars($f) . "<br />";
                        }
                        echo "<br />Total files: " . count($this->files);
                    }
                    ?>
                </td>
            </tr>
            <br />

            <tr>
                <td align="right">Category: </td>
                <td align="left">
                    <select name="type">
                        <option selected disabled="disabled">Select a category</option>
                        <?php foreach (isset($this->categories) ? $this->categories : $this->categories as $categ): ?>
                            <option value="<?= intval($categ->id); ?>"><?= $categ->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <br />

            <tr>
                <td align="right"> Upload Anonymous: </td>
                <td>
                    <input name="anonycheck" value="yes" type="radio" />Yes &nbsp;
                    <input name="anonycheck" value="no" type="radio" />No
                </td>
            </tr>
            <br />

            <tr>
                <td align="center" colspan="2">
                    <input type="submit" value="Upload" /><br />
                    <i> Click Once! - Uploading a lot files may take longer. </i>
                </td>
            </tr>
        </table>
    </form>

    <!-- end content -->
    </div>
</div>
<br />
