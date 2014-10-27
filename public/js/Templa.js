/*

needs to update url too :)

*/

var Templa = {}; // api

(function($) {
    
    // ** this is all really messy, needs tidying up
    
    // ajax cacher
    
    var ajaxCache = {};
    
    $.ajaxCacher = function(options) {
        // this is a simple wrapper for ajax with added caching functionality
        
        // // This is the easiest way to have default options.
        // options = $.extend({
        //     // These are the defaults.
        //     cache: true
        // }, options);
        
        if(typeof ajaxCache[options.url] !== "undefined" && options.useCache) {
            
            // is in cache
            options.success(ajaxCache[options.url]);
            
        } else {
            
            // not in cache, make call to the server
            
            // take success function as is now (so we can add cache storage stuff too)
            var success = options.success;
            
            options.success = function(data) {
                ajaxCache[options.url] = data;
                success(data);
            }
            
            // make ajax call to the server
            $.ajax(options);
            
        }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // View constructor
    // Construtor class for our data retrievers (e.g. market and prices)
    var ResourceLoader = function(options) {
        
        this.options = options;  
        
        // data properties
        this.data = []; // container for our data
        this.dataReady = false; // flag whether or not data has been retrieved
    };

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
            fetch_options.dataType = "json"
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
                if(_this_loader.options.template_loader) {
                    // this is a data loader object .. great! first we check if both resources are
                    // ready. if not, we rely upon the template loaded to call here again when it's 
                    // ready and return false for now.
                    
                    if(_this_loader.options.template_loader.dataReady) {
                        var template_data = _this_loader.options.template_loader.data;
                        var data_data = _this_loader.data
                        
                        _this_loader.options.render(template_data, data_data); // template, data, options
                    }
                    
                } else {
                    // this may be a template loader object. so we call the render or 
                    // the data object and return. However, it may also just be a single loader
                    // in which case we'll just call it's render and be done
                    
                    // so it doesn't have a template_loader, does it have a primary loader then?
                    if(_this_loader.options.data_loader) {
                        // it does! so this is a template, so call the render of the primary
                        if(_this_loader.options.data_loader.dataReady) { // primary 
                            var template_data = _this_loader.data;
                            var data_data = _this_loader.options.data_loader.data;
                            console.log("Number 2....this one usually breaks. It should have a data_loader with a render")
                            _this_loader.options.data_loader.options.render(template_data, data_data, options); //template, data, options
                        }
                        
                    } else {
                        var template_data = _this_loader.data;
                        var data_data = null;
                        var options = _this_loader.options;
                        
                        // it has no template. it has no primary loader either - it's just a lone loader
                        _this_loader.options.render(template_data, data_data, options); // template, data, options
                        
                    }
                }
            },
        });
        
    };

    // this is a kinda singleton contain so we don't make too many of the same resource
    var ResourceLoader_container = {};

    // create a relationship between the template and data loader
    ResourceLoader_register = function(options) {
        
        // check that we have a relevant URLs set. Otherwise we cannot proceed
        // also, define what the ID is for the container
        if(options.data_url && options.template_url) {
            var id = options.data_url+":"+options.template_url
        } else if(options.template_url) {
            var id = options.template_url
        } else {
            return false;
        }
        
        // check the container if this resource exists in there
        if(ResourceLoader_container[id]) {
            return ResourceLoader_container[id]
        }
        
        // Get to work! Build some resources
        if(options.data_url && options.template_url) {
                
            var data_loader = new ResourceLoader({
                url: options.data_url, 
                render: options.render
            });
            
            var template_loader = new ResourceLoader({
                url: options.template_url
            });
            
            // now both are defined, set the relationship 
            data_loader.options.template_loader = template_loader
            template_loader.options.data_loader = data_loader
            
        } else if(options.template_url) {
            
            // only one url has been set so let's just handle that one
            var data_loader = new ResourceLoader({
                url: options.template_url, 
                render: options.render
            });
            
        }
        
        // store in the container for later
        ResourceLoader_container[id] = data_loader
        
        return data_loader;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    Templa.init = function(container) {
        
        if(! container) container = "*";
        
        var _Templa = this; // give us a reference back to "this"
        
        $(container).find("[data-template]").on("click", function() {
            
            var data_url = $(this).data("data");
            // if(data_url === "href") {
            //     data_url = $(this).attr("href");
            // }
            
            var template_url = $(this).data("template");
            
            ////////////////// Templa.load
            
            var accounts_show = ResourceLoader_register({
                data_url: data_url,
                template_url: template_url,
                render: _Templa.config('view')
            });
            
            accounts_show.fetch();
            
            /////////////////
            
            return false;
        })
    }
    
    _config = {
        view: function(template) {
            console.log("Templa view not set.")
        }
    }
    
    Templa.config = function(name, value) {
        if(typeof value !== "undefined") {
            return _config[name] = value;
        } else {
            return _config[name];
        }
    }
    
})(jQuery);