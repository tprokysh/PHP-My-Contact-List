<?php
include "database.php";
$res = array('error' => false);
$action = 'read';
/*var_dump($_GET);*/
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action == 'read') {
    $result = pg_query($db, 'SELECT * FROM contacts ORDER BY id DESC');
    $contact = array();
    while ($row = pg_fetch_assoc($result)) {
        $contact[] = $row;
    }
    $res['contacts'] = $contact;
}

if ($action == 'create') {
    $userName = $_POST['contactname'];
    $phoneNum = $_POST['phonenum'];
    $result = pg_query($db, "INSERT INTO contacts(contactname, phonenum) VALUES ('$userName', '$phoneNum') ");
    if ($result) {
        $res['message'] = "Contact added";
    } else {
        $res['error'] = true;
        $res['message'] = "Coldn\'t insert users";
    }
}

if ($action == 'update') {
    $id = $_POST['id'];
    $userName = $_POST['contactname'];
    $phoneNum = $_POST['phonenum'];
    $result = pg_query($db, "UPDATE contacts SET contactname = '$userName', phonenum = '$phoneNum' WHERE id = $id");
    if ($result) {
        $res['message'] = "Contact updated";
    } else {
        $res['error'] = true;
        $res['message'] = "Coldn\'t update users";
    }
}

if ($action == 'delete') {
    $id = $_POST['id'];
    $result = pg_query($db, "DELETE FROM contacts WHERE id = $id");
    if ($result) {
        $res['message'] = "Contact deleted";
    } else {
        $res['error'] = true;
        $res['message'] = "Coldn\'t delete users";
    }
}

$db = pg_close();
header("Content-type: application/json");
echo json_encode($res);
die();
?>