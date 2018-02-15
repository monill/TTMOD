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
                                    as
                                    <?php  if ($this->tor->external == "yes"): ?>
                                        <a href="magnet:?xt=urn:btih:<?= $this->tor->info_hash; ?>&dn=<?= $this->tor->filename; ?>&tr=udp://tracker.openbittorrent.com&tr=udp://tracker.publicbt.com"> Magnet </a>
                                    <?php else: ?>
                                        <a href="magnet:?xt=urn:btih:<?= $this->tor->info_hash; ?>&dn=<?= $this->tor->filename; ?>&tr=<?= url("/announce/passkey/") . $user->passkey; ?>"> Magnet </a>
                                    <?php endif; ?>
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

                                    <b> Completed: </b> <?= $this->tor->times_completed; ?>

                                    <?php if ($this->tor->external != "yes" && $this->tor->times_completed > 0): ?>
                                         [ <a href="<?= url("/torrents/completes/") . $this->tor->id; ?>"> Who's Completed </a> ]
                                        <?php if ($this->tor->seeders <= 1): ?>
                                            [ <a href="<?= url("/torrents/reseed/") . $this->tor->id; ?>"> Request a Re-Seed </a> ]
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($this->tor->external != "yes" && $this->tor->freeleech == "yes"): ?>
                                        <b> Freeleech: </b><font color="#ff0000"> This torrent is free leech so only upload counts! </font>
                                    <?php endif; ?>

                                    <b> Last Checked: </b> <?= date("d-m-Y H:i", strtotime($this->tor->updated_at)); ?>
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

        <br /><br />
        <b> File List:</b>

        <img src="<?= URL; ?>/images/plus.gif" id="pic1" onclick="klappe_torrent(1)" alt="" />
        <div id="k1" style="display: none;">
            <table align="center" cellpadding="0" cellspacing="0" class="table_table" border="1" width="100%">
                <tr>
                    <th class="table_head" align="left"> File </th>
                    <th width="80" class="table_head"> Size </th>
                </tr>
                <?php
                    if ($this->files) {
                        foreach ($this->files as $key => $files) {
                            echo "<tr><td class='table_col1'>" . htmlspecialchars($files->path) . "</td><td class='table_col2'>" . Helper::makeSize($files->length) . "</td></tr>";
                        }
                    } else {
                       echo "<tr><td class='table_col1'>" . htmlspecialchars($this->tor->name) . "</td><td class='table_col2'>" . Helper::makeSize($this->tor->size) . "</td></tr>";
                    }
                ?>
            </table>
        </div>
        <br />

        <?php if ($this->userRts): ?>
            <br /> <i> ("You rated this torrent with <?= $this->userRts->rating ?> - Stars") </i>
        <?php else: ?>
            <br /> <i> You Not Rated Yet </i>
            <form style="display:inline;" method="post" action="<?= url("/torrent/addrating"); ?>">
                <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
                <input type="hidden" name="tid" value="<?= $this->tor->id; ?>">
                <select name="value">
                    <option selected disabled="disabled"> Add Rating </option>
                    <option value="1"> 1 - Sucks </option>
                    <option value="2"> 2 - Pretty Bad </option>
                    <option value="3"> 3 - Decent </option>
                    <option value="4"> 4 - Pretty Good </option>
                    <option value="5"> 5 - Cool </option>
                </select>
                <input type="submit" value="Submit" />
            </form>
        <?php endif; ?>

        <br /><br />
        <div class="col-xs-12 col-md-6">
            <div class="well well-sm">

                <div class="rating-card">
            		<div> <b> Ratings </b> </div>
                    <br />
            		<div class="rating">
            			<h3> <?php echo $this->ratings['rating']; ?> / 5 </h3>
                        <?php echo ratingpic($this->ratings['rating']); ?>
            			<p> <i class="fa fa-users" aria-hidden="true"> </i> <?php echo $this->ratings['votes']; ?> total of votes </p>
            		</div>

            		<div style="clear:both;"></div>
            	</div>

            </div>
        </div>

    <!-- end content -->
    </div>
</div>
<br />

<?php
$title = "Comments";
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
            <form name="comment" method="post" action="<?= url("/torrent/addcomment"); ?>">
                <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
                <input type="hidden" name="tid" value="<?= $this->tor->id; ?>">
                <input type="hidden" name="comt" value="<?= $this->tor->comments; ?>">
                <textarea name="comment" placeholder="Give us a comment" rows="6" cols="50" required></textarea>
                <br />
                <button type="submit"> Send </button>
            </form>
        </center>

        <?php if ($this->comments): ?>

            <?php foreach ($this->comments as $comment): ?>

                <div class="postContainer">
                    <div class="postUserInfo">
                        <div class="postAvatarDiv">
                            <a href="<?= url("/user/id/") . $comment->user_id; ?>">
                                <img class="postAvatar" src="<?= $comment->avatar; ?>"/>
                            </a>
                        </div>
                        <div>
                            <p class="postUsername">
                                <a class="forumLatestLink" href="<?= url("/user/id/" . $comment->user_id); ?>"><?= $comment->username; ?></a>
                            </p>
                            <p class="textCenter"> <?= $comment->class; ?></p>
                        </div>
                    </div>
                    <div class="postContentContainer">
                        <div class="postContents"> <?= $comment->comment; ?> </div>
                    </div>
                </div>
                <div class="postFooterRow">
                    <div class="postBlankDiv"></div>
                    <div class="postFooter">
                        <div class="postFooterContainer">
                            <div class="postInfo"> <?= date("d-m-Y", strtotime($comment->created_at)); ?></div>
                            <div class="postButtons">
                                [ <a href=""> Edit </a> ] &nbsp;
                                [ <a href=""> Delete </a> ] &nbsp;
                                [ <a href="<?= url("/report/comment/") . $comment->id; ?>"> Report </a> ]
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

            <?php endforeach; ?>

        <?php else: ?>
            <p> No comments at moment </p>
        <?php endif; ?>

    <!-- end content -->
    </div>
</div>
<br />
