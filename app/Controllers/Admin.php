<?php

namespace App\Controllers;

use App\Libs\Redirect;

class Admin extends Controller {

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }
    }

    private function __clone() { }

    public function index()
    {
        $this->view->title = SNAME . " :: Admin CPanel";
        $this->view->load("admin/index", false);
    }

    public function usersearch()
    {
        $this->view->title = "Admin CPanel - Advanced user search";
        $this->view->load("admin/usersearch", false);
    }

    public function avatars()
    {
        $users = $this->db->select("SELECT id, username, class, avatar FROM users WHERE status = 'confirmed'");
        $this->view->title = "Admin CPanel - Avatars";
        $this->view->users = $users;
        $this->view->load("admin/avatars", false);
    }

    public function backups()
    {
        $this->view->title = "Admin CPanel - Backups";
        $this->view->load("admin/backups", false);
    }

    public function ipbans()
    {
        $this->view->title = "Admin CPanel - Banned IPs";
        $this->view->load("admin/ipbans", false);
    }

    public function bannedtorrents()
    {
        $this->view->title = "Admin CPanel - Banned Torrents";
        $this->view->load("admin/bannedtorrents", false);
    }

    public function blocks()
    {
        $this->view->title = "Admin CPanel - Blocks";
        $this->view->load("admin/blocks", false);
    }

    public function cheats()
    {
        $this->view->title = "Admin CPanel - Cheaters";
        $this->view->load("admin/cheats", false);
    }

    public function emailbans()
    {
        $this->view->title = "Admin CPanel - E-mail Bans";
        $this->view->load("admin/emailbans", false);
    }

    public function faqmanage()
    {
        $this->view->title = "Admin CPanel - FAQ Manage";
        $this->view->load("admin/faqmanage", false);
    }

    public function freetorrents()
    {
        $this->view->title = "Admin CPanel - Free Torrents";
        $this->view->load("admin/freetorrents", false);
    }

    public function lastcomments()
    {
        $this->view->title = "Admin CPanel - Last Comments";
        $this->view->load("admin/lastcomments", false);
    }

    public function masspm()
    {
        $this->view->title = "Admin CPanel - Mass PM";
        $this->view->load("admin/masspm", false);
    }

    public function news()
    {
        $this->view->title = "Admin CPanel - News";
        $this->view->load("admin/news", false);
    }

    public function peers()
    {
        $this->view->title = "Admin CPanel - Peers";
        $this->view->load("admin/peers", false);
    }

    public function polls()
    {
        $this->view->title = "Admin CPanel - Polls";
        $this->view->load("admin/polls", false);
    }

    public function reports()
    {
        $this->view->title = "Admin CPanel - Reports";
        $this->view->load("admin/reports", false);
    }

    public function rules()
    {
        $this->view->title = "Admin CPanel - Rules";
        $this->view->load("admin/rules", false);
    }

    public function logs()
    {
        $this->view->title = "Admin CPanel - Logs";
        $this->view->load("admin/logs", false);
    }

    public function categories()
    {
        $this->view->title = "Admin CPanel - Categories";
        $this->view->load("admin/categories", false);
    }

    public function torrentmanage()
    {
        $this->view->title = "Admin CPanel - Torrent Manage";
        $this->view->load("admin/torrentmanage", false);
    }

    public function warned()
    {
        $this->view->title = "Admin CPanel - Warned Users";
        $this->view->load("admin/warned", false);
    }

    public function censor()
    {
        $this->view->title = "Admin CPanel - Censor";
        $this->view->load("admin/censor", false);
    }

    public function forum()
    {
        $this->view->title = "Admin CPanel - Forum";
        $this->view->load("admin/forum", false);
    }

    public function users()
    {
        $this->view->title = "Admin CPanel - Simple user search";
        $this->view->load("admin/users", false);
    }

    public function privacylevel()
    {
        $this->view->title = "Admin CPanel - Privacy Level";
        $this->view->load("admin/privacylevel", false);
    }

    public function pendinginvite()
    {
        $this->view->title = "Admin CPanel - Pending Invite";
        $this->view->load("admin/pendinginvite", false);
    }

    public function invited()
    {
        $this->view->title = "Admin CPanel - Invited Users";
        $this->view->load("admin/invited", false);
    }

    public function sqlerrors()
    {
        $this->view->title = "Admin CPanel - SQL Errors";
        $this->view->load("admin/sqlerrors", false);
    }

    public function settings()
    {
        $this->view->title = "Admin CPanel - Settings";
        $this->view->load("admin/settings", false);
    }
}
