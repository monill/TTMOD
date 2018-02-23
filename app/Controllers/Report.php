<?php

namespace App\Controllers;

use App\Libs\Helper;
use App\Libs\Redirect;
use App\Libs\Input;
use App\Libs\Session;
use App\Libs\Token;
use App\Models\Log;

class Report extends Controller
{
    private $username;

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }
        $this->username = Session::get("username");
    }

    private function __clone() { }

    public function index()
    {
        Redirect::to("/home");
    }

    public function torrent($id)
    {
        if (isset($id))
        {
            $tname = $this->db->select1("SELECT id, name FROM torrents WHERE id = :tid", ["tid" => $id]);

            if (!$tname) {
                Redirect::to("/error");
            } else {
                $this->view->title = SNAME . " :: Report";
                $this->view->tname = $tname;
                $this->view->token = Token::generate();
                $this->view->load("reports/torrent", false);
            }
        } else {
            Redirect::to("/torrents");
        }
    }

    public function forum($id)
    {
        if (isset($id))
        {
            $fname = $this->db->select1("");

            if (!$fname) {
                Redirect::to("/error");
            } else {
                $this->view->title = SNAME . " :: Report";
                //$this->view->fname = $tname;
                $this->view->token = Token::generate();
                $this->view->load("reports/forum", false);
            }
        } else {
            Redirect::to("/forum");
        }
    }

    public function user($id)
    {
        if (isset($id))
        {
            $uname = $this->db->select1("SELECT id, username FROM users WHERE id = :tid", ["tid" => $id]);

            if (!$uname) {
                Redirect::to("/error");
            } else {
                $this->view->title = SNAME . " :: Report";
                $this->view->user = $uname;
                $this->view->token = Token::generate();
                $this->view->load("reports/user", false);
            }
        } else {
            Redirect::to("/members");
        }
    }

    public function comment($id)
    {
        if (isset($id))
        {
            $comment = $this->db->select1("SELECT id, comment FROM torrent_comments WHERE id = :cid", ["cid" => $id]);

            if (!$comment) {
                Redirect::to("/error");
            } else {
                $this->view->title = SNAME . " :: Report";
                $this->view->com = $comment;
                $this->view->token = Token::generate();
                $this->view->load("reports/comment", false);
            }
        } else {
            Redirect::to("/torrents");
        }
    }

    public function addtreport() //Report a Torrent
    {
        if (Input::exist())
        {
            $tid = Input::get("tid");
            $reason = Input::get("reason");

            $this->db->insert('reports', [
                'added_by' => Session::get("userid"),
                'link_id' => $tid,
                'type' => 'torrent',
                'reason' => Helper::escape($reason),
                'created_at' => Helper::dateTime()
            ]);

            Log::create("User: {$this->username} reported the torrent {$tid}");

            $msg = "Thank you for you comment";

            Redirect::to("/torrents");

        } else {
            Redirect::to("/torrents");
        }
    }

    public function addfreport() //Report a Topic
    {
        if (Input::exist())
        {
            $fid = Input::get("fid");
            $reason = Input::get("reason");

            $this->db->insert('reports', [
                'added_by' => Session::get("userid"),
                'link_id' => $fid,
                'type' => 'forum',
                'reason' => Helper::escape($reason),
                'created_at' => Helper::dateTime()
            ]);

            Log::create("User: {$this->username} reported the topic {$fid}");

            $msg = "Thank you for you comment";

            Redirect::to("/torrents");

        } else {
            Redirect::to("/torrents");
        }
    }

    public function addureport() //Report a User
    {
        if (Input::exist())
        {
            $uid = Input::get("uid");
            $reason = Input::get("reason");

            $this->db->insert('reports', [
                'added_by' => Session::get("userid"),
                'link_id' => $uid,
                'type' => 'user',
                'reason' => Helper::escape($reason),
                'created_at' => Helper::dateTime()
            ]);

            Log::create("User: {$this->username} reported the user {$uid}");

            $msg = "Thank you for you comment";

            Redirect::to("/members");

        } else {
            Redirect::to("/members");
        }
    }

    public function addcreport() //Report a Comment
    {
        if (Input::exist())
        {
            $cid = Input::get("cid");
            $reason = Input::get("reason");

            $this->db->insert('reports', [
                'added_by' => Session::get("userid"),
                'link_id' => $cid,
                'type' => 'comment',
                'reason' => Helper::escape($reason),
                'created_at' => Helper::dateTime()
            ]);

            Log::create("User: {$this->username} reported the comment {$cid}");

            $msg = "Thank you for you comment";

            Redirect::to("/torrents");

        } else {
            Redirect::to("/torrents");
        }
    }

}
