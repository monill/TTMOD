<?php
use App\Libs\Session;
?>


<?php if (Session::exist('success')): ?>
    <div class="alert alert-success">
        <?php echo Session::flash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Session::exist('info')): ?>
    <div class="alert alert-info">
        <?php echo Session::flash('info'); ?>
    </div>
<?php endif; ?>

<?php if (Session::exist('warning')): ?>
    <div class="alert alert-warning">
        <?php echo Session::flash('warning'); ?>
    </div>
<?php endif; ?>

<?php if (Session::exist('danger')): ?>
    <div class="alert alert-danger">
        <?php echo Session::flash('danger'); ?>
    </div>
<?php endif; ?>