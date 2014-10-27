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

Templa.load({
    template_url: '/templates/accounts/show.php',
    data_url: '/accounts/3'
})

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