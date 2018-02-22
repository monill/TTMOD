<?php

$title = $this->user->username;
$blockId = "f-" . sha1($title);

?>

<div class="card">
    <div class="card-header">
        User: <?php echo $title ?> - (Account Profile)
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?php include_once 'body.php'; ?>

        <div class="row">
            <aside class="profile-nav col-lg-3">
                <section class="panel">

                </section>
            </aside>

            <aside class="profile-info col-lg-9">
                <section class="panel">
                    <div class="panel-body bio-graph-info">

                        <form class="form-horizontal" role="form" action="<?= url("/account/saveedit"); ?>" method="post" autocomplete="off">
                            <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />

                            <div class="form-group">
                                <label for="info" class="col-lg-2 control-label">Info</label>
                                <div class="col-lg-7">
                                    <textarea name="info" id="info" class="form-control" maxlength="1000" cols="7" rows="4"><?= $this->user->info; ?></textarea>
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label for="acceptpms" class="col-sm-2 control-label col-lg-2" for="inputSuccess">Accept PMs</label>
                                <div class="col-lg-10">

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="acceptpms" value="yes" <?php if ($this->user->acceptpms == 'yes'): ?> checked <?php endif; ?>> From All
                                        </label>

                                        <label>
                                            <input type="radio" name="acceptpms" value="no" <?php if ($this->user->acceptpms == 'no'): ?> checked <?php endif; ?>> From staff members only
                                        </label>
                                        <p class="small">Determines what users can send you private messages.</p>
                                    </div>

                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Profile</label>
                                <div class="col-lg-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="privacy" value="private" <?php if ($this->user->privacy == 'private'): ?> checked <?php endif; ?>> Private
                                        </label>

                                        <label>
                                            <input type="radio" name="privacy" value="friends" <?php if ($this->user->privacy == 'friends'): ?> checked <?php endif; ?>> Friends
                                        </label>

                                        <label>
                                            <input type="radio" name="privacy" value="public" <?php if ($this->user->privacy == 'public'): ?> checked <?php endif; ?>> Public
                                        </label>
                                        <p class="small">Determines where your username and details are displayed.</p>
                                    </div>

                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Reset Passkey</label>
                                <div class="col-lg-10">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="resetkey" value="yes"> Yes
                                    </label>
                                    <p class="small">Any active torrents must be downloaded again to continue leeching/seeding.</p>
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label  class="col-lg-2 control-label">Avatar</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="avatar" id="avatar" value="<?= $this->user->avatar; ?>">
                                    <p class="small">The width should be 200px-300px (will be resized if necessary). <br>
                                        If you need a HOST for the image, use the: <a href="https://imgur.com/" target="_blank">ImgUr</a>.</p>
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="title" maxlength="240" value="<?= $this->user->title; ?>">
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Signature</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="signature" maxlength="240" value="<?= $this->user->signature; ?>">
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label class="control-label col-lg-2">Estate</label>
                                <div class="col-lg-4">
                                    <select class="form-control" name="estate_id">
                                        <?php foreach ($this->estates as $estate): ?>
                                            <option value="<?= $estate->id; ?>"
                                            <?php if ($this->user->estate_id && intval($estate->id) == $this->user->estate_id): ?>
                                                selected
                                            <?php endif; ?>> <?= $estate->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <label for="gender" class="col-lg-2 control-label"> Gender </label>
                                <div class="col-lg-4">
                                    <select name="gender" id="gender" class="form-control" size="1">
                                        <option value="na" <?php if ($this->user->sex == 'na'): ?> selected <?php endif; ?>>N/A</option>
                                        <option value="male" <?php if ($this->user->sex == 'male'): ?> selected <?php endif; ?>>Male</option>
                                        <option value="female" <?php if ($this->user->sex == 'female'): ?> selected <?php endif; ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <br />

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </aside>
        </div>

    <!-- end content -->
    </div>
</div>
<br />
