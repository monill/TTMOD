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

        <form method="post" action="<?= url("/torrents/advsearch"); ?>" autocomplete="off">
            <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />

            <div class="form-group">
                <label for="search"> Search </label>
                <input type="text" class="form-control" name="search" minlength="3" maxlength="25" placeholder="Search.." autofocus />
            </div>
            <br />

            <div class="form-group">
                <label for="categ"> Categories </label>
                <select name="categ" class="form-control">
                    <?php foreach (Torrent::categories() as $c): ?>
                        <option value="<?= $c->id; ?>"> <?= $c->name; ?> </option>
                    <?php endforeach; ?>
        		</select>
            </div>
            <br />

            <div class="form-group">
                <label for="incldead"> Deads </label>
                <select name="incldead" class="form-control">
        			<option value="yes"> Active </option>
        			<option value="no"> Only dead </option>
        		</select>
            </div>
            <br />

            <div class="form-group">
                <label for="freeleech"> Freeleech </label>
                <select name="freeleech" class="form-control">
                    <option value="no"> Not Freeleech </option>
                    <option value="yes"> Only Freeleech </option>
                </select>
            </div>
            <br />

            <div class="form-group">
                <label for="inclext"> L / E </label>
                <select name="inclext" class="form-control">
                    <option value="no"> Local only </option>
                    <option value="yes"> External only </option>
                </select>
            </div>
            <br />

            <button type="submit" class="btn btn-primary">Search</button>
        </form>
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
                    <th scope="col"> <i class="fa fa-heart"></i> </th>
                    <th scope="col"> Uploader </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (isset($this->torrents) ? $this->torrents : $this->torrents as $tor): ?>
                    <tr>
                        <th scope="row"> <a href="<?= url("/torrents/categ/") . $tor->cat_slug; ?>"> <?= $tor->cat_name; ?> </a> </th>
                        <th>
                            <a href="<?= url("/torrent/view/") . $tor->id; ?>"> <?= $tor->name; ?> </a>
                            <?php if ($tor->freeleech == "yes"): ?>
                                <img src="<?= URL; ?>/imgs/free.gif" alt="Freeleech" title="Freeleech" />
                            <?php endif; ?>
                        </th>
                        <th> <?= date("d-m-Y", strtotime($tor->created_at)); ?> </th>
                        <th> <?= Helper::makeSize($tor->size); ?> </th>
                        <th> <?= $tor->seeders; ?> </th>
                        <th> <?= $tor->leechers; ?> </th>
                        <th> <?= $tor->comments; ?> </th>
                        <th> <img src="<?= URL . '/imgs/health/health_' . Helper::health($tor->seeders, $tor->leechers) . '.gif'; ?>" alt="Health"/> </th>
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
