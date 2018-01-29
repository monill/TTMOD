<?php
foreach ($this->rules as $rule):
$blockId = 'f-' . sha1($rule->title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $rule->title; ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <?php echo $rule->content; ?>

    <!-- end content -->
    </div>
</div><br />

<?php
endforeach;
