<?php

$title = "this->user->username";
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
                        <div class="panel-heading"> Defina nova senha</div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" action="" method="post" autocomplete="off">


                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Senha atual</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control" name="senha" id="senha">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-lg-2 control-label">Nova senha</label>
                                    <div class="col-lg-4">
                                        <input type="password" class="form-control" name="novasenha" id="novasenha">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" name="updatesenha" class="btn btn-info">Save</button>
                                        <button type="button" class="btn btn-default">Cancel</button>
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
