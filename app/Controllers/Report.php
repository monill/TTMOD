<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Input;

class Report extends Controller
{

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
                $this->view->load("reports/comment", false);
            }
        } else {
            Redirect::to("/torrents");
        }
    }

    public function addtreport()
    {
        if (Input::exist())
        {
            $tid = Input::get("tid");
            $reason = Input::get("reason");

        } else {
            Redirect::to("/torrents");
        }
    }

    public function addfreport()
    {
        if (Input::exist())
        {
            $fid = Input::get("fid");
            $reason = Input::get("reason");

        } else {
            Redirect::to("/torrents");
        }
    }

    public function addureport()
    {
        if (Input::exist())
        {
            $uid = Input::get("uid");
            $reason = Input::get("reason");

        } else {
            Redirect::to("/members");
        }
    }

    public function addcreport()
    {
        if (Input::exist())
        {
            $cid = Input::get("cid");
            $reason = Input::get("reason");

        } else {
            Redirect::to("/torrents");
        }
    }

}
