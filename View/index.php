<!DOCTYPE html>
<html lang="en" dir="ltr" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Contact List</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="main" id="app">
        <div class="header">
            <h1>Contact List</h1>
            <div class="addSaveBtns" id="addSaveBtns" v-if="showAddForm == false">
                <button @click="showAddForm = true" class="add" id="addBtn">
                    Create
                </button>
            </div>
        </div>
        <template v-if="showAddForm">
            <div class="edit-contact">
                <div class="contact-img">
                    img
                    <img src="#" alt="">
                </div>
                <div class="contact-form">
                    <h3>Contact name:</h3>
                    <input type="text" v-model="newContact.contactname">
                    <h3>Phone:</h3>
                    <input type="text" name="phoneNum" v-model="newContact.phonenum">
                    <button @click="showAddForm = false; createContact();">Save</button>
                </div>
            </div>
        </template>
        <template v-for="contact in contacts">
            <template v-if="showEditForm == false">
                <div class="contact" :id="'id' + contact.id">
                    <div class="contact-img">
                        img
                        <img src="#" alt="">
                    </div>
                    <div class="contact-info">
                        <h3>{{contact.contactname}}</h3>
                        <h3>{{contact.phonenum}}</h3>
                    </div>
                    <button @click="deleteContact(contact);" class="delete">
                        Delete
                    </button>
                    <button @click="showEditForm = true; selectContact(contact)" class="edit">
                        Edit
                    </button>
                </div>
            </template>
            <template v-if="showEditForm == true && currContactId == getElId(currContact)">
                <div class="edit-contact">
                    <div class="contact-img">
                        img
                        <img src="#" alt="">
                    </div>
                    <div class="contact-form">
                        <h3>Contact name:</h3>
                        <input type="text" v-model="contact.contactname">
                        <h3>Phone:</h3>
                        <input type="text" v-model="contact.phonenum">
                        <button @click="showEditForm = false; updateContact(contact);" class="edit">
                            Edit
                        </button>
                    </div>
                </div>
            </template>
        </template>
    </div>
    <script  type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: {
                messageAdd: 'Add',
                messageSave: 'Save',
                titleAdd: 'Add new contact',
                titleSave: 'Save new contact',
                showAddForm: false,
                showEditForm: false,
                showDel:false,
                contacts: [],
                newContact: {contactname: "", phonenum: ""},
                currContact: [],
                currContactId: "id",
                errorMsg: ""
            },
            mounted: function() {
                console.log("mounted");
                this.getContacts();
            },
            methods: {
                getContacts: function () {
                    axios.get("http://localhost/dashboard/work/contact-list/api.php?action=read")
                        .then(function (response) {
                            //console.log(response);
                            if (response.data.error) {
                                app.errorMsg = response.data.errorMsg;
                            } else {
                                app.contacts = response.data.contacts;
                            }
                        })
                },
                createContact: function () {
                    var formData = app.packData(app.newContact);
                    axios.post("http://localhost/dashboard/work/contact-list/api.php?action=create", formData)
                        .then(function (response) {
                            //console.log(response);
                            if (response.data.error) {
                                app.errorMsg = response.data.errorMsg;
                            } else {
                                app.getContacts();
                            }
                        })
                },
                deleteContact: function (contact) {
                    app.currContact = contact;
                    var formData = app.packData(app.currContact);
                    axios.post("http://localhost/dashboard/work/contact-list/api.php?action=delete", formData)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.error) {
                                app.errorMsg = response.data.errorMsg;
                            } else {
                                app.getContacts();
                            }
                        })
                },
                updateContact: function (contact) {
                    app.currContact = contact;
                    var formData = app.packData(app.currContact);
                    axios.post("http://localhost/dashboard/work/contact-list/api.php?action=update", formData)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.error) {
                                app.errorMsg = response.data.errorMsg;
                            } else {
                                app.getContacts();
                            }
                        })
                },
                selectContact: function (contact) {
                    app.currContactId += contact.id;
                    app.currContact = contact;
                },
                packData: function(obj) {
                    var form_Data = new FormData();
                    for (var key in obj) {
                        form_Data.append(key, obj[key]);
                    }
                    return form_Data;
                },
                getElId: function (contact) {
                    /*console.log(contact.id);*/
                    var ident = document.querySelector('#id' + app.currContact.id);
                    console.log(ident.id);
                    console.log(app.currContactId);
                    return ident.id;
                }
            }
        })
    </script>
</body>
</html>