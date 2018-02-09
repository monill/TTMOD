<?php

use App\Libs\Helper;
use App\Models\Torrent;

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
            <a href="torrents.php?cat=1"> name </a>
            <br /><br />

            <div class="form-group col-sm-3">
                <input id="user" type="text" class="form-control" name="search" minlength="3" maxlength="25" placeholder="Search.." autofocus />
            </div>

            <select name="cat" class="form-control">
                <option selected disabled="disabled"> All Types </option>
                <?php foreach (Torrent::categories() as $c): ?>
                    <option value="<?= $c->id; ?>"> <?= $c->name; ?> </option>
                <?php endforeach; ?>
    		</select>
            <br />

            <select name="incldead" class="form-control">
    			<option value="0"> Active </option>
    			<option value="1"> Include dead </option>
    			<option value="2"> Only dead </option>
    		</select>
            <br />

            <select name="freeleech" class="form-control">
                <option value="0"> All </option>
                <option value="1"> Not Freeleech </option>
                <option value="2"> Only Freeleech </option>
            </select>
            <br />

            <select name="inclext" class="form-control">
    			<option value="0"> Local / External </option>
    			<option value="1"> Local only </option>
    			<option value="2"> External only </option>
    		</select>
            <br />

            <button type="submit" class="btn btn-primary">Search</button>
            <br />
        </form>
                SEARCH_RULES <br />
    </center>
    <br /><br />

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col"> Categ </th>
                <th scope="col"> Name </th>
                <th scope="col"> Added </th>
                <th scope="col"> Size </th>
                <th scope="col"> S. </th>
                <th scope="col"> L. </th>
                <th scope="col"> <i class="fa fa-comments"></i> </th>
                <th scope="col"> Uploader </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (isset($this->torrents) ? $this->torrents : $this->torrents as $tor): ?>
                <tr>
                    <th scope="row"> <a href="<?= url("/torrents/categ/") . $tor->cat_slug; ?>"> <?= $tor->cat_name; ?> </a> </th>
                    <th> <a href="<?= url("/torrent/view/") . $tor->id; ?>"> <?= $tor->name; ?> </a> </th>
                    <th> <?= date("d-m-Y", strtotime($tor->created_at)); ?> </th>
                    <th> <?= Helper::makeSize($tor->size); ?> </th>
                    <th> <?= $tor->seeders; ?> </th>
                    <th> <?= $tor->leechers; ?> </th>
                    <th> <?= $tor->comments; ?> </th>
                    <th>
                        <?php if ($tor->anon == "yes"): ?>
                            Authorless
                        <?php else: ?>
                            <a href="<?= url("/user/id/") . $tor->uploader_id; ?>"> <?= $tor->username; ?> </a>
                        <?php endif; ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- end content -->
    </div>
</div>
<br />
