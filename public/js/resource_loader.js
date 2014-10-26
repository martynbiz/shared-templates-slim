// JavaScript Document

// add an attribute @depends (other dependancies that this one must wait)

// var ResourceLoader_utils = ResourceLoader_utils || {
  
//   extend: function(options) {
//     for(var i=1; i<arguments.length; i++) {
//         for(var name in arguments[i]) { options[name] = arguments[i][name] }
//     }
//     return options;
//   }
  
// };

// jService

// View constructor
// Construtor class for our data retrievers (e.g. market and prices)
var ResourceLoader = function(options) {
    
    this.options = options;  
    
    // data properties
    this.data = []; // container for our data
    this.dataReady = false; // flag whether or not data has been retrieved
};

// this is a kinda singleton contain so we don't make too many of the same resource
var ResourceLoader_container = {};

// create a relationship between the template and data loader
ResourceLoader_register = function(options) {
    
    // check that we have a relevant URLs set. Otherwise we cannot proceed
    // also, define what the ID is for the container
    if(options.data_url && options.data_url) {
        var id = options.data_url+":"+options.template_url
    } else if(options.url) {
        var id = options.url
    } else {
        return false;
    }
    
    // check the container if this resource exists in there
    if(ResourceLoader_container[id]) {
        return ResourceLoader_container[id]
    }
    
    // Get to work! Build some resources
    if(options.data_url && options.data_url) {
        
        var primary_loader = new ResourceLoader({
            url: options.data_url, 
            render: options.render
        });
        
        var template_loader = new ResourceLoader({
            url: options.template_url
        });
        
        // now both are defined, set the relationship 
        primary_loader.options.template_loader = template_loader
        template_loader.options.primary_loader = primary_loader
        
    } else if(options.url) {
        
        // only one url has been set so let's just handle that one
        var primary_loader = new ResourceLoader({
            url: options.url, 
            render: options.render
        });
        
    }
    
    // store in the container for later
    ResourceLoader_container[id] = primary_loader
    
    return primary_loader;
}

// fetch property method
// Will fetch the data from the server, set flag to true/false, call render
// - ajax_options: don't confuse obj_options with ajax_options
ResourceLoader.prototype.fetch = function(data, fetch_options) {
    
    // because this this is not this inside the ajax method
    var _this_loader = this;
    
    // set default options
    fetch_options = $.extend( {
        url: _this_loader.options.url,  
        method: "GET",
        contentType: null
    }, fetch_options);
    
    // set dataReady to false to indicate to any other process concerned with this data
    _this_loader.dataReady = false;
    
    // ensure this loaders template s fetched if set
    if(_this_loader.options.template_loader) {
        // this fetch is for data, set the content type and fetch the template
        _this_loader.options.template_loader.fetch(null, {
            useCache: true
        }) // **cache
        fetch_options.contentType = "application/json"
        fetch_options.contentType = "json"
    }
    
    // fetch data from the server
    $.ajaxCacher({
        url: fetch_options.url,
        data: data,
        useCache: fetch_options.useCache,
        dataType: fetch_options.dataType,
        contentType: fetch_options.contentType,
        method: fetch_options.method,
        success: function(data) {
            
            _this_loader.data = data;
            _this_loader.dataReady = true;
            
            // check if this is a template or data
            if(!_this_loader.options.template_loader)
            { 
                // this may be a template loader object. so we call the render or 
                // the data object and return. However, it may also just be a single loader
                // in which case we'll just call it's render and be done
                
                // so it doesn't have a template_loader, does it have a primary loader then?
                if(_this_loader.options.primary_loader) {
                    // it does! so this is a template, so call the render of the primary
                } else {
                    // it has no template. it has no primary loader either - it's just a lone loader
                    _this_loader.options.render(data);
                }
                
                
            } 
            else
            {
                // this is a data loader object .. great! first we check if both resources are
                // ready. if not, we rely upon the template loaded to call here again when it's 
                // ready and return false for now. otherwise let's proceed to render the data
                
                if(_this_loader.options.template_loader.dataReady)
                    _this_loader.options.render(data);
            }
        },
    });
    
};