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
            currContact: {},
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
                            app.showAddForm = false;
                        }
                    })
            },
            createContact: function () {
                var formData = app.packData(app.newContact);
                axios.post("http://localhost/dashboard/work/contact-list/api.php?action=create", formData)
                    .then(function (response) {
                        app.newContact = {contactname: "", phonenum: ""};
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

                        app.currContact = {};
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
                /*console.log(contact.id);*/
                var id1 = 'id' + contact.id;
                var id2 = app.currContactId;
                /*console.log(ident);*/
                /*console.log(app.currContactId);*/
                console.log('id1: ', id1);
                console.log('id2: ', id2);
                console.log(id1 === id2);
                return id1 === id2;
            }
        }
    });