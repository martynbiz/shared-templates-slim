$(function() {



// // let's try just loading a single html file (e.g. about)
// var about_page = ResourceLoader_register({
//     template_url: "/templates/pages/about.php", // could be an html file
//     render: function(template, data) { // designed to handle two data sources 
        
//         console.log(template)
        
//         var template = Handlebars.compile(template);
//         var html = template(data);
        
//         $("#content").html(html);
//     }
// });

//  about_page.fetch();


var customView = function(template, data) { // designed to handle two data sources 
    
    var template = Handlebars.compile(template);
    var html = template(data);
    
    $("#content").html(html);
    setLinks("#content");
}

var setLinks = function(container) {
    
    $(container).find("[data-action='show_account']").on("click", function() {
        
        var accounts_show = ResourceLoader_register({
            data_url: "/accounts/"+$(this).data("id"),
            template_url: "/templates/accounts/show.php",
            render: customView
        });
        
        accounts_show.fetch();
        
        return false;
    })

    $(container).find("[data-action='list_accounts']").on("click", function() {
        
        var accounts_index = ResourceLoader_register({
            data_url: "/accounts",
            template_url: "/templates/accounts/index.php",
            render: customView
        });
        
        accounts_index.fetch();
        
        return false;
    })

    $(container).find("[data-action='edit_account']").on("click", function() {
        
        var accounts_edit = ResourceLoader_register({
            data_url: "/accounts/"+$(this).data("id"),
            template_url: "/templates/accounts/update.php",
            render: customView
        });
        
        accounts_edit.fetch();
        
        return false;
    })

    $(container).find("[data-action='delete_account']").on("click", function() {
        
        var accounts_delete = ResourceLoader_register({
            data_url: "/accounts/"+$(this).data("id"),
            template_url: "/templates/accounts/delete.php",
            render: customView
        });
        
        accounts_delete.fetch();
        
        return false;
    })
}


setLinks("*");




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