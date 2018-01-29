<?php
$title = "Admin CP";
$blockId = 'b-' . sha1($title);
?>

<div class="card">
    <div class="card-header">
        <?php echo $title ?>
        <a data-toggle="collapse" href="#" class="showHide" id="<?php echo $blockId; ?>" style="float: right;"></a>
    </div>
    <div class="card-body slidingDiv<?php echo $blockId; ?>">
    <!-- content -->

    <select name="admin" class="form-control" onchange="if(this.options[this.selectedIndex].value != -1){ window.location = this.options[this.selectedIndex].value; }">
        <option selected disabled="disabled">Navigation</option>
        <option value="admincp.php?action=usersearch">Advanced User Search</option>
        <option value="admincp.php?action=avatars">Avatar Log</option>
        <option value="admincp.php?action=backups">Backups</option>
        <option value="admincp.php?action=ipbans">Banned Ip's</option>
        <option value="admincp.php?action=bannedtorrents">Banned Torrents</option>
        <option value="admincp.php?action=blocks&amp;do=view">Blocks</option>
        <option value="admincp.php?action=cheats">Detect Possibe Cheats</option>
        <option value="admincp.php?action=emailbans">E-mail Bans</option>
        <option value="faq-manage.php">FAQ</option>
        <option value="admincp.php?action=freetorrents">Freeleech Torrents</option>
        <option value="admincp.php?action=lastcomm">Latest Comments</option>
        <option value="admincp.php?action=masspm">Mass PM</option>
        <option value="admincp.php?action=messagespy">Message Spy</option>
        <option value="admincp.php?action=news&amp;do=view">News</option>
        <option value="admincp.php?action=peers">Peers List</option>
        <option value="admincp.php?action=polls&amp;do=view">Polls</option>
        <option value="admincp.php?action=reports&amp;do=view">Reports System</option>
        <option value="admincp.php?action=rules&amp;do=view">Rules</option>
        <option value="admincp.php?action=sitelog">Site Log</option>
        <option value="teams-create.php">Teams</option>
        <option value="admincp.php?action=style">Theme Management</option>
        <option value="admincp.php?action=categories&amp;do=view">Torrent Categories</option>
        <option value="admincp.php?action=torrentlangs&amp;do=view">Torrent Languages</option>
        <option value="admincp.php?action=torrentmanage">Torrents</option>
        <option value="admincp.php?action=groups&amp;do=view">Usergroups View</option>
        <option value="admincp.php?action=warned">Warned Users</option>
        <option value="admincp.php?action=whoswhere">Who's Where</option>
        <option value="admincp.php?action=censor">Word Censor</option>
        <option value="admincp.php?action=forum">Forum Management</option>
    </select>

    <!-- end content -->
    </div>
</div>
<br />
