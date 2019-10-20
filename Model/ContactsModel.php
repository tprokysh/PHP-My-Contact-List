<?php

namespace Model;

class ContactsModel
{
    public function getContacts($action) {
        if ($action == 'read') {
            $result = pg_query($db, 'SELECT * FROM contacts');
            $contact = array();
            while ($row = pg_fetch_assoc($result)) {
                array_push($contact, $row);
            }
            $res['contacts'] = $contact;
        }
    }
}