<?php

use Model\ContactsModel;

class Contacts extends Main
{
    private $objModel;
    private $action;

    public function __construct()
    {
        $this->objModel = new ContactsModel();
    }

    public function get($action) {
        $this->objModel->getContacts($action);
    }
}