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

        <center>
            <b>Categories:</b> <a href="<?= url("/torrents"); ?>">Show all</a> - <a href="#">Freeleech</a>
            <hr />
            <?php $table = '<table class="table table-striped"><tbody><tr>'; ?>
            <?php foreach (Torrent::categories() as $key => $c): ?>
                <?php $table .= '<td> <a href="' . url("/torrents/categ/") . $c->slug .'">' . $c->name . '</a> </td>'; ?>
                <?php if (($key + 1) % 4 == 0): ?>
                <?php $table .= '</tr><tr>'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php $table .= "</tr></tbody></table>"; ?>
            <?php echo $table; ?>
        </center>

        <form method="post" action="<?= url("/torrents/search"); ?>" autocomplete="off">
            <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
            <div class="form-group">
                <label for="search"> </label>
                <input type="text" class="form-control" name="search" minlength="3" maxlength="25" placeholder="Search.." autofocus />
            </div>
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
                </tr>
            </thead>
            <tbody>
                <?php if (count($this->torrents) > 0): ?>
                    <?php foreach (isset($this->torrents) ? $this->torrents : $this->torrents as $tor): ?>
                        <tr>
                            <th scope="row"> <a href="<?= url("/torrents/categ/") . $tor->cat_slug; ?>"> <?= $tor->cat_name; ?> </a> </th>
                            <td>
                                <a href="<?= url("/torrent/view/") . $tor->id; ?>"> <?= $tor->name; ?> </a>
                                <?php if ($tor->freeleech == "yes"): ?>
                                    <img src="<?= URL; ?>/imgs/free.gif" alt="Freeleech" title="Freeleech" />
                                <?php endif; ?>
                            </td>
                            <td> <?= date("d-m-Y", strtotime($tor->created_at)); ?> </td>
                            <td> <?= Helper::makeSize($tor->size); ?> </td>
                            <td> <?= $tor->seeders; ?> </td>
                            <td> <?= $tor->leechers; ?> </td>
                            <td> <?= $tor->comments; ?> </td>
                            <td> <img src="<?= URL . '/imgs/health/health_' . Helper::health($tor->seeders, $tor->leechers) . '.gif'; ?>" alt="Health"/> </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <th colspan="9"> <p class="text-center"> No files uploaded yet. </p> </th>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    <!-- end content -->
    </div>
</div>
<br />
