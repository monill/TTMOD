<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Validation;
use App\Models\Estate;
use App\Libs\Token;
use App\Libs\Input;
use App\Models\Log;
use App\Libs\Helper;

class Account extends Controller {

    private $valid;
    //TODO
    //fix all user_id in the functions
    //finish all this

    public function __construct()
    {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to("/login");
        // }
        $this->valid = new Validation();
    }

    private function __clone() { }

    public function index()
    {
        $user = $this->db->select1("SELECT `username`, `class`, `email`, `actived_at`, `dob`, `sex`, `donated`, `info`, `title`, `signature`, `privacy`, `signature`, `passkey`, `points` FROM `users` WHERE `id` = :id", ["id" => (int) 7]);
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->user = $user;
        $this->view->token = Token::generate();
        $this->view->load("account/index", false);
    }

    public function edit()
    {
        $user = $this->db->select1("SELECT `username`, `acceptpms`, `privacy`, `avatar`, `title`, `signature`, `estate_id`, `info`, `sex` FROM `users` WHERE `id` = :id", ["id" => (int) 7]);
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->user = $user;
        $this->view->token = Token::generate();
        $this->view->estates = Estate::all();
        $this->view->load("account/edit", false);
    }

    public function changepw()
    {
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->token = Token::generate();
        $this->view->load("account/changepwd", false);
    }

    public function mytorrents()
    {
        $myts = $this->db->select("SELECT torrents.id, torrents.category_id, torrents.name, torrents.created_at, torrents.downs, torrents.banned, torrents.comments, torrents.seeders, torrents.leechers, torrents.times_completed, torrent_categories.name AS catname FROM torrents LEFT JOIN torrent_categories ON torrents.category_id = torrent_categories.id WHERE torrents.uploader_id = :uploader ORDER BY torrents.created_at DESC", ["uploader" => (int) 7]);
        $this->view->title = SNAME . " :: Your CPanel";
        $this->view->mytors = $myts;
        $this->view->token = Token::generate();
        $this->view->load("account/mytorrents", false);
    }

    public function saveedit()
    {
        if (Input::exist())
        {
            if (Token::check(Input::get("token")))
            {
                $user = $this->db->select1("SELECT `username`, `passkey` FROM `users` WHERE `id` = :uid", ["uid" => 7]);

                $info = Input::get("info");
                $acceptpms = Input::get("acceptpms");
                $privacy = Input::get("privacy");
                $resetkey = Input::get("resetkey");
                $avatar = Input::get("avatar");
                $title = Input::get("title");
                $signature = Input::get("signature");
                $estate_id = Input::get("estate_id");
                $gender = Input::get("gender");

                $errors = array();

                if (strlen($info) > 1000) {
                    $errors[] = "Info max 1k characters.";
                }

                if (strlen($title) > 240) {
                    $errors[] = "Info max 240 characters.";
                }

                if (strlen($signature) > 240) {
                    $errors[] = "Info max 240 characters.";
                }

                if ($resetkey == "yes") {
                    $key = Helper::md5Gen();
                } else {
                    $key = $user->passkey;
                }

                if (count($errors) == 0)
                {
                    $this->db->update("users", [
                        'info' => $info,
                        'acceptpms' => $acceptpms,
                        'privacy' => $privacy,
                        'passkey' => $key,
                        'avatar' => $avatar,
                        'title' => Helper::escape($title),
                        'signature' => Helper::escape($signature),
                        'estate_id' => $estate_id,
                        'sex' => $gender,
                        'updated_at' => Helper::dateTime()
                    ], "`id` = :uid", ["uid" => 7]);

                    $result = [
                        'status' => 'sucess',
                        'msg' => 'Profile updated successfully'
                    ];

                    Log::create("User {$user->username} update profile.");

                    echo json_encode($result);

                    Redirect::to("/account");

                } else {
                    echo json_encode($errors);
                }
            } else {
                echo "Invalid Token";
            }
        } else {
            Redirect::to("/account");
        }
    }

    public function updatepass()
    {
        $errors = array();

        $passwd = Input::get("passwd");
        $repasswd = Input::get("repasswd");

        if ($this->valid->isEmpty($passwd)) {
            $errors[] = "New password is empty";
        }
        if ($this->valid->isEmpty($repasswd)) {
            $errors[] = "Repeat passowrd is empty";
        }
        if (strlen($passwd) < 6 || strlen($passwd) > 16) {
            $errors[] = "Password min 6 and max 16 characeres";
        }
        if ($passwd !== $repasswd) {
            $errors[] = "The passwords do not match.";
        }

        if (count($errors) == 0)
        {
            $this->db->update("users", [
                'passwd' => Helper::hashPass($passwd),
                'updated_at' => Helper::dateTime()
            ], "`id` = :uid", ["uid" => 7]);

            Log::create("User {username} change the password.");

            $result = [
                'status' => 'success',
                'msg' => 'Password successfully changed'
            ];

            echo json_encode($result);

            Redirect::to("/account");

        } else {
            echo json_encode($errors);
        }


    }

}
