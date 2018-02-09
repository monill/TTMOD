<?php
$title = "Torrents";
$blockId = "f-" . sha1($title);
?>
<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <center><b>Categories:</b></center> <br /><br />

    <center>
    <form method="get" action="#">
        <table border="0" align="center">
            <tr align='right'>


            </tr>
            <tr align="right">
                <td style="padding-bottom: 2px; padding-left: 2px">
                    <a href="torrents.php?cat=1">
                        cat-name
                    </a>
                    <input name="" type="checkbox" value="1" />
                </td>
            </tr>
        </table>

        <br /><br />
        <b> YOU_ARE_IN :</b>
        <a href="torrents.php?parent_cat=1">
            parent_cat
        </a>
        <br /><b> SUB_CATS :</b>
            <a href="torrents.php?cat=1"> name </a>
            <br /><br />

            SEARCH
            <input type="text" name="search" size="40" value="" />

            IN
            <select name="cat">
                <option value="0"> ( ALL TYPES )</option>
            </select>

            <br /><br />
            <select name="incldead">
                <option value="0"> ACTIVE_TRANSFERS </option>
                <option value="1"> INC_DEAD </option>
                <option value="2"> ONLY_DEAD </option>
            </select>

            <select name="freeleech">
                <option value="0"> ALL </option>
                <option value="1"> NOT_FREELEECH </option>
                <option value="2"> ONLY_FREELEECH </option>
            </select>

            <select name="inclexternal">
                <option value="0"> LOCAL_EXTERNAL </option>
                <option value="1"> LOCAL_ONLY </option>
                <option value="2"> EXTERNAL_ONLY </option>
            </select>

            <select name="lang">
                <option value="0"> ALL </option>
                <option value="1"> lang-name </option>
            </select>

            <input type="submit" value="SEARCH" />
            <br />
        </form>
                SEARCH_RULES <br />
    </center>
    <br /><br />



    <table class="table table-hover">
        <thead>
            <tr>
                <th>Categ</th>
                <th>Name</th>
                <th>Added</th>
                <th>Size</th>
                <th>S.</th>
                <th>L.</th>
                <th>Ccs</th>
                <th>Uploader</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (isset($this->torrents) ? $this->torrents : $this->torrents as $torrent): ?>
                <tr>
                    <th> <a href="<?= url("/user/id/") . $torrent->cat_name; ?>"> <?= $torrent->cat_name; ?> </a> </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- end content -->
    </div>
</div>
<br />
