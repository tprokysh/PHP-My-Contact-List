<?php
include "database.php";
$res = array('error' => false);
$action = 'delete';
if (isset($_GET['read'])) {
    $action = $_GET['read'];
}
if ($action == 'read') {
    $result = pg_query($db, 'SELECT * FROM contacts');
    $contact = array();
    while ($row = pg_fetch_assoc($result)) {
        array_push($contact, $row);
    }
    $res['contacts'] = $contact;
}

if ($action == 'create') {
    $userName = $_POST['contactName'];
    $phoneNum = $_POST['phoneNum'];
    $result = pg_query($db, "INSERT INTO contacts(contactname, phonenum) VALUES ($userName, $phoneNum) ");
    if ($result) {
        $res['message'] = "Contact added";
    } else {
        $res['error'] = true;
        $res['message'] = "Coldn\'t insert users";
    }
}

if ($action == 'update') {
    $id = $_POST['id'];
    $userName = $_POST['contactName'];
    $phoneNum = $_POST['phoneNum'];
    $result = pg_query($db, "UPDATE contacts SET contactname = $userName, phonenum = $phoneNum WHERE id = $id");
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
<!--<!DOCTYPE html>
<html lang="en" dir="ltr" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Contact List</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
<div class="main" id="app">
    <div class="header">
        <h1>Contact List</h1>
        <div class="addSaveBtns" id="addSaveBtns">
            <div class="add" id="addBtn" v-bind:title="titleAdd">
                <a @click="formOn()" href="#">{{messageAdd}}</a>
            </div>
        </div>
    </div>
    <template v-if="status == 1">
        <div class="edit-contact">
            <label for="submit">
                <button class="save" @click="formOff()">
                    Save
                </button>
            </label>
            <div class="contact-img">
                img
                <img src="#" alt="">
            </div>
            <div class="contact-form">
                <form action="dasdasdasd">
                    <h3>Contact name:</h3>
                    <input type="text">
                    <h3>Phone:</h3>
                    <input type="text">
                    <input type="submit" id="submit" @click="formOff()">
                </form>

            </div>
        </div>
    </template>

</div>
    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: {
                messageAdd: 'Add',
                messageSave: 'Save',
                titleAdd: 'Add new contact',
                titleSave: 'Save new contact',
                status: 0
            },
            methods: {
                formOn: function () {
                    this.status = 1;
                },
                formOff: function () {
                    this.status = 0;
                }
            }
        })
    </script>
</body>
</html>-->