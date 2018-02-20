<?php
$title = "Poll";
$blockId = "f-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <?php if (!empty($this->questions)) { ?>
        <p class="text-center"> <strong> <?= $this->questions->question; ?> </strong> </p> <br />

        <?php $voted = true; ?>

        <?php if ($voted) { ?>

            <?php $total_rating = $db->select1("SELECT COUNT(answer_id) as total_count FROM poll_polls WHERE question_id = :qid", ["qid" => $this->questions->id]); ?>
            <?php $answer = $db->select("SELECT * FROM poll_answers WHERE question_id = :qid", ["qid" => $this->questions->id]); ?>



            <?php foreach ($answer as $k => $v): ?>
                <?php
                $answer_rating = $db->select1("SELECT COUNT(answer_id) as answer_count FROM poll_polls WHERE question_id = :qid AND answer_id = :awsid", ["qid" => $this->questions->id, "awsid" => $v->id]);

                $answers_count = 0;
                if (!empty($answer_rating)) {
                    $answers_count = $answer_rating->answer_count;
                }
                $percentage = 0;
                if (!empty($total_rating)) {
                    $percentage = ( $answers_count / $total_rating->total_count ) * 100;
                    if(is_float($percentage)) {
                        $percentage = number_format($percentage,2);
                    }
                }


                 ?>
                <strong> <?= $v->answer; ?> </strong> <span class="pull-right"> <?= $answers_count; ?> Votes</span>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?= $answers_count; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage; ?>%;">
                        <?= $percentage; ?>%
                    </div>
                </div>
            <?php endforeach; ?>


        <?php } else { // User has not voted, show options ?>
                <?php
                if (!empty($this->answers)) { ?>
                    <form method="post" action="<?= url("/polls/save"); ?>" autocomplete="off">
                        <input type="hidden" name="question-id" value="<?= $this->questions->id;?>" />
                        <?php foreach($this->answers as $k => $v) { ?>
                            <div class="radio">
                                <label> <input type="radio" name="answer" class="radio-input" value="<?= $v->id; ?>" /> <?= $v->answer; ?> </label>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary center-block" /> Vote </button>
                    </form>
                <?php } ?>
        <?php } ?>

    <?php } else { ?>
        <p class="text-center"> No Active Polls </p>
    <?php } ?>

    <!-- end content -->
    </div>
</div>
<br />
