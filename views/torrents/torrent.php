<?php
use App\Libs\Helper;

$title = "Torrent Details For: " . $this->tor->name;
$blockId = "f-" . sha1($title);
?>
<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?//php var_dump($this->tor); ?>

        <div align="right">
            [ <a href="<?= url("/report/torrent/" . $this->tor->id); ?>"> <b> Report this Torrent </b> </a> ] &nbsp;
            [ <a href="<?= url("/torrent/edit/" . $this->tor->id); ?>"> <b> Edit this torrent </b> </a> ]
        </div>

        <center> <h3> <?= $this->tor->name; ?> </h3> </center>

        <center>
            <table border="0" width="100%">
                <tr>
                    <td>
                        <div id="downloadbox">
                            <table border="0" cellpadding="0" width="100%">

                                <center>
                                    Download as <a href="<?= url("/torrent/download/" . $this->tor->id); ?>"> Torrent </a> or
                                    as <a href="magnet:?xt=urn:btih:<?= $this->tor->info_hash; ?>"> Magnet </a>
                                    <br />

                                    <b> Health: </b>
                                    <img src="<?= URL . '/imgs/health/health_' . Helper::health($this->tor->seeders, $this->tor->leechers) . '.gif'; ?>" alt="Health"/>

                                    <b> Seeds: </b>
                                    <font color="green"> <?= $this->tor->seeders; ?> </font>

                                    <b> Leechers: </b>
                                    <font color="#ff0000"> <?= $this->tor->leechers; ?> </font>

                                    <?php if ($this->tor->external != "yes"): ?>
                                        <b> Speed: </b> <?= $this->tor->totalspeed; ?>
                                    <?php endif; ?>

                                    <b> Completed:</b> <?= $this->tor->times_completed; ?>

                                    <?php if ($this->tor->external != "yes" && $this->tor->times_completed > 0): ?>
                                         [ <a href="torrents-completed.php?id=$id"> Who's Completed </a> ]
                                        <?php if ($this->tor->seeders <= 1): ?>
                                            [ <a href="torrents-reseed.php?id=$id"> Request a RE-Seed </a> ]
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($this->tor->external != "yes" && $this->tor->freeleech == "yes"): ?>
                                        <b> Freeleech: </b><font color="#ff0000"> This torrent is free leech so only upload counts! </font>
                                    <?php endif; ?>

                                    <b> Last Checked: </b> <?= date("d-m-Y H:i", strtotime($this->tor->update_at)); ?>
                                </center>

                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </center>
        <br /><br />

        <fieldset class="download">
            <legend> <b> Details: </b> </legend>

            <table cellpadding="3" border="0" width="100%">
                <tr>
                    <td align="left"> <b> Name:</b> </td>
                    <td> <?= $this->tor->name; ?> </td>
                </tr>

                <tr>
                    <td align="left" colspan="2"> <b> Description:</b> <br />
                        <?= Helper::escape($this->tor->description); ?>
                    </td>
                </tr>

                <tr>
                    <td align="left"> <b> Category:</b> </td>
                    <td> <?= $this->tor->cat_name; ?> </td>
                </tr>

                <tr>
                    <td align="left"> <b> Total Size:</b> </td>
                    <td> <?= Helper::makeSize($this->tor->size); ?> </td>
                </tr>

                <tr>
                    <td align="left"> <b> Info Hash:</b> </td>
                    <td> <?= $this->tor->info_hash; ?> </td>
                </tr>

                <tr>
                    <td align="left"> <b> Added By:</b> </td>
                    <td>
                        <?php if ($this->tor->anon == "yes"): ?>
                            Authorless
                        <?php else: ?>
                            <a href="<?= url("/user/id/") . $this->tor->uploader_id; ?>"> <?= $this->tor->username; ?> </a>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td align="left"> <b> Date Added:</b> </td>
                    <td> <?= date("d-m-Y H:i", strtotime($this->tor->created_at)); ?> </td>
                </tr>

                <tr>
                    <td align="left"> <b> Views:</b> </td>
                    <td> <?= intval($this->tor->views); ?> </td>
                </tr>
                <tr>
                    <td align="left"> <b> Downs:</b> </td>
                    <td> <?= intval($this->tor->downs); ?> </td>
                </tr>
            </table>
        </fieldset>
        <br>

        <?php if ($this->tor->poster != ""): ?>
            <center> <img src="<?= $this->tor->poster; ?>" width="200" border="0" alt="Poster" /> </center><br />
        <?php endif; ?>
        <?php if ($this->tor->image1 != ""): ?>
            <center> <img src="<?= $this->tor->image1; ?>" width="200" border="0" alt="Image 1" /> </center><br />
        <?php endif; ?>
        <?php if ($this->tor->image2 != ""): ?>
            <center> <img src="<?= $this->tor->image2; ?>" width="200" border="0" alt="Image 2" /> </center><br />
        <?php endif; ?>
        <?php if ($this->tor->image3 != ""): ?>
            <center> <img src="<?= $this->tor->image3; ?>" width="200" border="0" alt="Image 3" /> </center><br />
        <?php endif; ?>

        <?php if ($this->tor->external == "yes"): ?>
            <br /> <b> Tracker: </b> <br /> <?= Helper::escape($this->tor->announce); ?> <br />
        <?php endif; ?>



    <!-- end content -->
    </div>
</div>
<br />
