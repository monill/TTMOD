<?php
$title = "Advanced Search";
$blockId = 'b-' . sha1($title);
use App\Models\Torrent;
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <form method="post" action="<?= url('/torrents/advsearch'); ?>">
		<input type="text" name="search" class="form-control" placeholder="Search.." />
        <br />
		<select name="cat" class="form-control">
			<option selected disabled="disabled"> All types </option>
            <?php foreach (Torrent::categories() as $c): ?>
                <option value="<?= $c->id; ?>"><?= $c->name; ?></option>
            <?php endforeach; ?>
		</select>
        <br />

		<select name="incldead" class="form-control">
			<option value="0"> Active </option>
			<option value="1"> Include dead </option>
			<option value="2"> Only dead </option>
		</select>
        <br />

		<select name="inclext" class="form-control">
			<option value="0"> Local / External </option>
			<option value="1"> Local only </option>
			<option value="2"> External only </option>
		</select> <br />

		<button type="submit" class="btn btn-primary center-block"> Search </button>
	</form>

	<!-- end content -->
    </div>
</div>
<br />
