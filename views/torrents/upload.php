<?php
$title1 = "Upload Rules";
$blockId1 = "f-" . sha1($title1);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title1 ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId1; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId1; ?>">
    <!-- content -->

        You should also include a .nfo file wherever possible<br />
        Try to make sure your torrents are well-seeded for at least 24 hours<br />
        Do not re-release material that is still active

    <!-- end content -->
    </div>
</div>
<br />

<?php
$title = "Upload";
$blockId = "f-" . sha1($title);
?>
<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <form class="form-horizontal" enctype="multipart/form-data" action="<?= url("/torrent/upload"); ?>" method="post" autocomplete="off">
            <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />

            <div class="form-group">
                <div class="col-md-5">
                    <b> Announce Url: </b> <?= ANNOUNCE; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="torrentfile">Torrent file:</label>
                <div class="col-md-5">
                    <input type="file" class="form-control-file" name="torrent" id="torrentfile">
                </div>
            </div>

            <div class="form-group">
                <label for="nfofile">NFO file:</label>
                <div class="col-md-5">
                    <input type="file" class="form-control-file" name="nfo" id="nfofile">
                </div>
            </div>

            <div class="form-group">
                <label for="tname">Torrent name:</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="tname" id="tname">
                </div>
            </div>

            <div class="form-group">
                <label for="tname"> Poster: </label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="poster" id="poster">
                </div>
            </div>

            <div class="form-group">
                <label for="tname"> Image 1:</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="image1" id="image1">
                </div>
            </div>

            <div class="form-group">
                <label for="tname"> Image 2:</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="image2" id="image2">
                </div>
            </div>

            <div class="form-group">
                <label for="tname"> Image 3:</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="image3" id="image3">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 col-sm-2" for="category">Category:</label>
                <div class="col-md-3">
                    <select name="category" id="category" class="form-control" required>
                        <option selected disabled="disabled">Select a category</option>
                        <?php foreach (isset($this->categories) ? $this->categories : $this->categories as $categ): ?>
                            <option value="<?= intval($categ->id); ?>"><?= $categ->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 col-sm-4 custom-control"> Annonymous Upload? </label>
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="showuploader" id="yes" value="yes">
                        <label class="form-check-label" for="yes"> Yes </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="showuploader" id="no" value="no" checked>
                        <label class="form-check-label" for="no"> No </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 col-sm-2" for="descr"> Description: </label>
                <div class="col-md-6">
                    <textarea class="form-control" name="descr" id="descr" rows="4" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-offset-5 col-lg-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    <!-- end content -->
    </div>
</div>
<br />
