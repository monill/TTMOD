<?php
$dbase = $db->select1("SELECT VERSION() as mysql_version");
$title = "Admin CPanel";
$blockId = "f-" . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

        <center> Mysql Version: <b> <?= $dbase->mysql_version; ?> </b> <br /> PHP Version: <b> <?= phpversion(); ?> </b> </center>
        <br>

        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td align="center"> <a href="<?= url("/admin/usersearch"); ?>"> <img src="<?= URL; ?>/imgs/admin/user_search.png" alt="" /> <br /> Advanced User Search </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/avatars"); ?>"> <img src="<?= URL; ?>/imgs/admin/avatar_log.png" alt="" /> <br /> Avatar Log </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/backups"); ?>"> <img src="<?= URL; ?>/imgs/admin/db_backup.png" alt="" /> <br /> Backups </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/ipbans"); ?>"> <img src="<?= URL; ?>/imgs/admin/ip_block.png" alt="" /> <br /> Banned IPs </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/bannedtorrents"); ?>"> <img src="<?= URL; ?>/imgs/admin/banned_torrents.png" alt="" /> <br /> Banned Torrents </a> <br /> </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"> <a href="<?= url("/admin/blocks"); ?>"> <img src="<?= URL; ?>/imgs/admin/blocks.png" alt="" /> <br /> Blocks </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/cheats"); ?>"> <img src="<?= URL; ?>/imgs/admin/cheats.png" alt="" /> <br /> Detect Possible Cheats </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/emailbans"); ?>"> <img src="<?= URL; ?>/imgs/admin/mail_bans.png" alt="" /> <br /> E-Mail Bans </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/faqmanage"); ?>"> <img src="<?= URL; ?>/imgs/admin/faq.png" alt="" /> <br /> FAQ </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/freetorrents"); ?>"> <img src="<?= URL; ?>/imgs/admin/free_leech.png" alt="" /> <br />Freeleech Torrents </a> <br /> </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"> <a href="<?= url("/admin/lastcomments"); ?>"> <img src="<?= URL; ?>/imgs/admin/comments.png" alt="" /> <br /> Latest Comments </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/masspm"); ?>"> <img src="<?= URL; ?>/imgs/admin/mass_pm.png" alt="" /> <br /> Mass PM </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/news"); ?>"> <img src="<?= URL; ?>/imgs/admin/news.png" alt="" /> <br /> News </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/peers"); ?>"> <img src="<?= URL; ?>/imgs/admin/peer_list.png" alt="" /> <br /> Peers List </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/torrentmanage"); ?>"> <img src="<?= URL; ?>/imgs/admin/torrents.png" alt="" /> <br /> Torrents </a> <br /> </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"> <a href="<?= url("/admin/polls"); ?>"> <img src="<?= URL; ?>/imgs/admin/polls.png" alt="" /> <br /> Polls </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/reports"); ?>"> <img src="<?= URL; ?>/imgs/admin/report_system.png" alt="" /> <br /> Reports System </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/rules"); ?>"> <img src="<?= URL; ?>/imgs/admin/rules.png" alt="" /> <br /> Rules </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/logs"); ?>"> <img src="<?= URL; ?>/imgs/admin/site_log.png" alt="" /> <br /> Site Log </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/categories"); ?>"> <img src="<?= URL; ?>/imgs/admin/torrent_cats.png" alt="" /> <br /> Torrent Categories View </a> <br /> </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"> <a href="<?= url("/admin/warned"); ?>"> <img src="<?= URL; ?>/imgs/admin/warned_user.png" alt="" /> <br /> Warned Users </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/censor"); ?>"> <img src="<?= URL; ?>/imgs/admin/word_censor.png" alt="" /> <br /> Word Censor </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/forum"); ?>"> <img src="<?= URL; ?>/imgs/admin/forums.png" alt="" /> <br /> Forum Management </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/users"); ?>"> <img src="<?= URL; ?>/imgs/admin/simple_user_search.png" alt="" /> <br /> Simple User Search </a> <br /> </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td align="center"> <a href="<?= url("/admin/privacylevel"); ?>"> <img src="<?= URL; ?>/imgs/admin/privacy_level.png" alt="" /> <br /> Privacy Level </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/pendinginvite"); ?>"> <img src="<?= URL; ?>/imgs/admin/pending_invited_user.png" alt="" /> <br /> Pending Invited Users </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/invited"); ?>"> <img src="<?= URL; ?>/imgs/admin/invited_user.png" alt="" /> <br /> Invited Users </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/sqlerrors"); ?>"> <img src="<?= URL; ?>/imgs/admin/sql_error.png" alt="" /> <br /> SQL Error </a> <br /> </td>
                <td align="center"> <a href="<?= url("/admin/settings"); ?>"> <img src="<?= URL; ?>/imgs/admin/config.png" alt="" /> <br /> Configuration </a> <br /> </td>
            </tr>
        </table>

    <!-- end content -->
    </div>
</div>
<br />
