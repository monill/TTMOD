<?php

namespace App\Controllers;

use App\Libs\Redirect;
use App\Models\Message;
use App\Libs\Token;

class Messages extends Controller {

    public function __construct() {
        parent::__construct();
        // if (!$this->loggedIn()) {
        //     Redirect::to('/login');
        // }
    }

    public function __clone() {

    }

    public function index() {
        Redirect::to('/messages/inbox');
    }

    public function inbox()
    {
        //TODO
        //fix this userid
        $this->view->title = SNAME . " :: Messages Inbox";
        $this->view->msgs = Message::inbox(7);
        $this->view->load('messages/inbox', false);
    }

    public function outbox()
    {
        //TODO
        //fix this userid
        $this->view->title = SNAME . " :: Messages Outbox";
        $this->view->msgs = Message::outbox(7);
        $this->view->load('messages/outbox', false);
    }

    public function compose()
    {
        $this->view->title = SNAME . " :: Messages Compose";
        $this->view->token = Token::generate();
        $this->view->load('messages/compose', false);
    }

}
