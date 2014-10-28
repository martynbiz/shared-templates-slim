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


/*

var AccountsController = {}; //new Templa.Controller();

AccountsController.index = function() {
    Templa.load({
        template_url: '/templates/accounts/index.php',
        data_url: '/accounts'
    })
}



Templa.load({
    template_url: '/templates/accounts/edit.php',
    data_url: '/accounts/3'
})

// triggered when a link, or form(GET) is submitted
Templa.map('/accounts/:id', function(id) { // match href
    Templa.load({
        template_url: '/templates/accounts/show.php',
        data_url: '/accounts/' + id
    })
})

// store as:
{
    'GET': {
        '/accounts': function() {...},
        '/accounts/:id': function() {...}
    }
}

// assign to links:
onclick=function() {
    if(Templa.isRoute(this.href, "GET")) {
        Templa.loadLink(this);
    }
}

Templa.redirect('accounts/3')

<a href="...">Show</a>

*/

Templa.config('view', function(template, data) { // designed to handle two data sources 
    
    var template = Handlebars.compile(template);
    var html = template(data);
    
    $("#content").html(html);
    Templa.init("#content");
});

Templa.init();  

// var customView = function(template, data) { // designed to handle two data sources 
    
//     var template = Handlebars.compile(template);
//     var html = template(data);
    
//     $("#content").html(html);
//     setLinks("#content");
// }

// var setLinks = function(container) {
    
//     $(container).find("[data-template]").on("click", function() {
        
//         var data_url = $(this).data("data");
//         // if(data_url === "href") {
//         //     data_url = $(this).attr("href");
//         // }
        
//         var template_url = $(this).data("template");
        
//         var accounts_show = ResourceLoader_register({
//             data_url: data_url,
//             template_url: template_url,
//             render: customView
//         });
        
//         accounts_show.fetch();
        
//         return false;
//     })
// }


// setLinks("*");




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