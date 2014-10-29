$(function() {

/**
* Initiate the page (or block) by setting all the links load templates where set
* 
*/

// setup our template

Templa.config('view', function(template, data) { // designed to handle two data sources 
    
    var template = Handlebars.compile(template);
    var html = template(data);
    
    $("#content").html(html);
    Routa.init("#content");
});




// list accounts
Routa.get('/accounts', function() {
    Templa.load({
        template_url: '/templates/accounts/index.php',
        data_url: '/accounts'
    });
});

// show accounts
Routa.get('/accounts/:id', function(id) {
    Templa.load({
        template_url: '/templates/accounts/show.php',
        data_url: '/accounts/' + id
    });
});

// edit accounts
Routa.get('/accounts/:id/edit', function(id) {
    Templa.load({
        template_url: '/templates/accounts/update.php',
        data_url: '/accounts/' + id
    });
});

// edit accounts
Routa.get('/accounts/:id/delete', function(id) {
    Templa.load({
        template_url: '/templates/accounts/delete.php',
        data_url: '/accounts/' + id
    });
});

// initiate the page
Routa.init("*")





/**
* Initiate the page (or block) by setting all the links load templates where set
* 
*/

// Templa.config('view', function(template, data) { // designed to handle two data sources 
    
//     // apply the template
//     var template = Handlebars.compile(template);
//     var html = template(data);
//     $("#content").html(html);
    
//     // apply the routa to new html
//     Templa.init("#content");
// });

// Templa.init();



}); // end of closure