$(function() {




// let's try just loading a single html file (e.g. about)
var about_page = ResourceLoader_register({
    url: "/templates/accounts/index.php", // could be an html file
    render: function(data) { // designed to handle two data sources
        alert('both have loaded')
    }
});

about_page.fetch();





$("#content").find("[data-action='show_account']").on("click", function() {
    
    var accounts_show = ResourceLoader_register({
        data_url: "/accounts/"+$(this).data("id"),
        template_url: "/templates/accounts/show.php",
        render: function(data) { // designed to handle two data sources
            alert('both have loaded')
        }
    });
    
    accounts_show.fetch();
    
    return false;
})

$("#content").find("[data-action='list_accounts']").on("click", function() {
    
    var accounts_index = ResourceLoader_register({
        data_url: "/accounts",
        template_url: "/templates/accounts/index.php",
        render: function(data) { // designed to handle two data sources
            alert('both have loaded')
        }
    });
    
    accounts_index.fetch();
    
    return false;
})

$("#content").find("[data-action='edit_account']").on("click", function() {
    
    var accounts_edit = ResourceLoader_register({
        data_url: "/accounts/"+$(this).data("id"),
        template_url: "/templates/accounts/update.php",
        render: function(data) { // designed to handle two data sources
            alert('both have loaded')
        }
    });
    
    accounts_edit.fetch();
    
    return false;
})

$("#content").find("[data-action='delete_account']").on("click", function() {
    
    var accounts_edit = ResourceLoader_register({
        data_url: "/accounts/"+$(this).data("id"),
        template_url: "/templates/accounts/delete.php",
        render: function(data) { // designed to handle two data sources
            alert('both have loaded')
        }
    });
    
    accounts_edit.fetch();
    
    return false;
})

// var AccountModel = Backbone.Model.extend({
//     urlRoot: '/accounts',
//     defaults: {
//         amount: 0
//     },
//     initialize: function() {
//         alert("Welcome to this world");
//         this.on("change", function(model){
//             alert("Changed my name to " + name );
//         });
//     }
// });

// app = {
//     models: {
//         account: new AccountModel()
//     },
//     createAccount: function() {
//         var values = {
//             name: 'Bank of Scotland',
//             amount: 100
//         };

//         account.save(values, {
//             success: function (Account) {
//                 alert(Account.toJSON());
//             }
//         });
//     }
// };



}); // end of closure