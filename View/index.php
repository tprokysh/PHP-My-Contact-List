<!DOCTYPE html>
<html lang="en" dir="ltr" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Contact List</title>
    <link rel="stylesheet" href="style/style.css">
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
                    <button @click="showAddForm = true; createContact();">Save</button>
                </div>
            </div>
        </template>
        <template v-for="contact in contacts">
            <template v-if="showEditForm == false || !getElId(contact)">
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
            <template v-if="getElId(contact)">
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
                        <button @click="showEditForm = false; updateContact(contact); currContactId = 'id';" class="edit">
                            Edit
                        </button>
                    </div>
                </div>
            </template>
        </template>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="app.js"></script>
</body>
</html>