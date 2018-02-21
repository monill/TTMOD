<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Libs\Input;
use App\Libs\Helper;
use App\Models\Log;

class Polls extends Controller {

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
        $questions = $this->db->select1("SELECT * FROM poll_questions WHERE active = 1 LIMIT 1");
        if (!empty($questions)) {
            $answers = $this->db->select("SELECT * FROM poll_answers WHERE question_id = :qid", ["qid" => $questions->id]);
        } else {
            $answers = "";
        }

        $this->view->title = SNAME . " :: Polls";
        $this->view->questions = $questions;
        $this->view->answers = $answers;

        $this->view->load("poll/index", false);
    }

    public function save()
    {
        if (Input::exist())
        {
            //TODO
            //fix this user_id
            $this->db->insert('poll_polls', [
                'question_id' => Input::get("question-id"),
                'answer_id' => Input::get("answer"),
                'user_id' => 7,
                'from_ip' => Helper::getIP()
            ]);

            $msg = "Thank you for your vote!";

            Redirect::to("/polls");

        }
    }

}
