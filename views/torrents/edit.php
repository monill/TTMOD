<?php

$title = "Edit Torrent: " . $this->tor->name;
$blockId = "f-" . sha1($title);
?>
<div class="card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <form method="post" action="<?= url("/torrent/addupdate"); ?>">
            <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
            <input type="hidden" name="tid" value="<?= $this->tor->id; ?>" />

            <table class="table_table" cellspacing="0" cellpadding="4" width="586" align="center">
                <tr>
                    <td class="table_col1" align="right" width="60"> <b> Name: </b> </td>
                    <td class="table_col2" >
                        <input type="text" name="name" value="<?= $this->tor->name; ?>" maxlength="230" size="60" />
                    </td>
                </tr>

                <tr>
                    <td class="table_col1"  align="right"> <b> Image: </b> </td>
                    <td class="table_col2">
                        <b> Poster: </b>
                        <input type="text" name="poster" value="<?= $this->tor->poster; ?>" maxlength="230" size="45" />
                        <br />

                        <b> Image1: </b>
                        <input type="text" name="image1" value="<?= $this->tor->image1; ?>" maxlength="230" size="45" />
                        <br />

                        <b> Image2: </b>
                        <input type="text" name="image2" value="<?= $this->tor->image2; ?>" maxlength="230" size="45" />
                        <br />

                        <b> Image3: </b>
                        <input type="text" name="image3" value="<?= $this->tor->image3; ?>" maxlength="230" size="45" />
                        <br />
                    </td>
                </tr>

                <tr>
                    <td class="table_col1" align="right"> <b> Categories: </b> </td>
                    <td class="table_col2">
                        <select name="category">
                            <option selected disabled="disabled">Select a category</option>
                            <?php foreach (isset($this->categories) ? $this->categories : $this->categories as $categ): ?>
                                <option value="<?= intval($categ->id) ?>" <?= ($this->tor->category_id == $categ->id) ? " selected='selected'" : "" ?>"><?= $categ->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td class="table_col1" align="right"> <b> Banned: </b> </td>
                    <td class="table_col2">
                        <input type="checkbox" name="banned" value="yes" <?php echo ($this->tor->banned == "yes") ? " checked='checked'" : "" ?> /> Banned ? <br />
                    </td>
                </tr>

                <tr>
                    <td class="table_col1" align="right"> <b> Visible: </b> </td>
                    <td class="table_col2">
                        <input type="checkbox" name="visible" value="yes" <?php echo ($this->tor->visible == "yes") ? " checked='checked'" : "" ?> />
                        Note that the torrent will automatically become visible when there's a seeder, and will become
                        automatically invisible (dead) when there has been no seeder for a while. Use this switch to speed
                        the process up manually. Also note that invisible (dead) torrents can still be viewed or
                        searched for, it's just not the default. <br />
                    </td>
                </tr>

                <tr>
                    <td class="table_col1" align="right"> <b> Freeleech: </b> </td>
                    <td class="table_col2">
                        <input type="checkbox" name="freeleech" value="yes" <?php echo ($this->tor->freeleech == "yes") ? " checked='checked'" : "" ?> />
                        This torrent is free leech so only upload counts! <br />
                    </td>
                </tr>

                <tr>
                    <td class="table_col1" align="right"> <b> Anonymous Upload: </b> </td>
                    <td class="table_col2">
                        <input type="checkbox" name="anon" value="yes" <?php echo ($this->tor->anon == "yes") ? " checked='checked'" : "" ?> />
                        (Your username will not be associated with this torrent) <br />
                    </td>
                </tr>

                <tr>
                    <td class="table_head" align="center" colspan="2"> <b> Description: </b> </td>
                </tr>

            </table>

            <center>
                <textarea name="description" rows="6" cols="50"> <?= $this->tor->description; ?> </textarea>
            </center>

            <br />
            <center>
                <input type="submit" value="SUBMIT" />
                <input type="reset" value="UNDO" />
            </center>

        </form>

    <!-- end content -->
    </div>
</div>
<br />


<?php
$title = "Delete .torrent ";
$blockId = "f-" . sha1($title);
?>
<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <center>
            <form method="post" action="#">
                <input type="hidden" name="torrentid" value="" />
                <input type="hidden" name="torrentname" value="" />
                <b> Reason for deletion: </b>
                <input type="text" size="30" name="delreason" />
                <input type="submit" value="DELETE_TORRENT" />
            </form>
        </center>

    <!-- end content -->
    </div>
</div>
<br />