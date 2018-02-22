<?php

$title = \App\Libs\Session::get("username"); //username
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
            <aside class="profile-info col-lg-9">
                <section>
                    <div class="panel panel-primary">
                        <div class="panel-heading"> Set new password </div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" action="<?= url("/account/updatepass"); ?>" method="post" autocomplete="off">
                                <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"> New password </label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control" minlength="6" maxlength="16" name="passwd" id="passwd">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"> Repeat password </label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control" minlength="6" maxlength="16" name="repasswd" id="repasswd">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-info">Save</button>
                                        <button class="btn btn-default">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </aside>
        </div>

    <!-- end content -->
    </div>
</div>
<br />
