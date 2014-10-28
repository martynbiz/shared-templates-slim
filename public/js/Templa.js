
var Templa = {}; // api

(function($) {
    
    /**
    * Ajax cacher
    * 
    * This handy little extension to jQuery.ajax allows us to really cache if we want
    * Responses are stored in the ajaxCache variable
    */
    
    var ajaxCache = {};
    
    $.ajaxCacher = function(options) {
        
        if(typeof ajaxCache[options.url] !== "undefined" && options.useCache) {
            options.success(ajaxCache[options.url]);
        } else {
            var success = options.success;
            
            options.success = function(data) {
                ajaxCache[options.url] = data;
                success(data);
            }
            
            $.ajax(options);
        }
    }
    
    
    /**
    * Loader constructor
    * 
    * Each URL (template, data) has it's own loader. The loader may be a data loader which
    * will be tied to a template loader, and vice versa. Each can load async, when both are
    * ready the render function will be fired of the 
    */
    
    /**
    * Contains instances of loaders that have been created. Instances are stored by
    * template_url and data_url (so two links could have the same urls, and share the
    * same instance)
    */
    var Loader = function(options) {
        
        this.options = options;  
        
        // data properties
        this.data = []; // container for our data
        this.dataReady = false; // flag whether or not data has been retrieved
    };

    // fetch property method
    // Will fetch the data from the server, set flag to true/false, call render
    // - ajax_options: don't confuse obj_options with ajax_options
    Loader.prototype.fetch = function(data, fetch_options) {
        
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
    
    
    /**
    * Templa module
    * 
    * Templa module will register loaders, load loaders and initiate links. It's rather neat ;) 
    */
    
    /**
    * Contains instances of loaders that have been created. Instances are stored by
    * template_url and data_url (so two links could have the same urls, and share the
    * same instance)
    */
    var _loader_container = {};
    
    /**
    * This is the config container of the Templa library. Most importantly it
    * contains the view which is used to render the template and data
    */
    var _config = {
        
        /**
        * this config is a function which takes two arguments: template, and data
        * It is defined in the app and will render the page in what ever way the 
        * developer wishes. For example, the template may be a handlebars template
        * and the function will compile it.
        */
        view: function(template, data) {
            console.log("Templa view not set.")
        }
    }

    /**
    * Register the template and data urls in a loader object. 
    */
    Templa.register = function(options) {
        
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
        if(_loader_container[id]) {
            return _loader_container[id]
        }
        
        // Get to work! Build some resources
        if(options.data_url && options.template_url) {
                
            var data_loader = new Loader({
                url: options.data_url, 
                render: options.render
            });
            
            var template_loader = new Loader({
                url: options.template_url
            });
            
            // now both are defined, set the relationship 
            data_loader.options.template_loader = template_loader
            template_loader.options.data_loader = data_loader
            
        } else if(options.template_url) {
            
            // only one url has been set so let's just handle that one
            var data_loader = new Loader({
                url: options.template_url, 
                render: options.render
            });
            
        }
        
        // store in the container for later
        _loader_container[id] = data_loader
        
        return data_loader;
    }
    
    /**
    * Load one or both templates by passing a template_url and an (opptional) data_url
    * 
    */
    Templa.load = function(template_url, data_url) {
        
        var accounts_show = Templa.register({
            data_url: data_url,
            template_url: template_url,
            render: Templa.config('view')
        });
        
        accounts_show.fetch();
    }
    
    
    /**
    * Initiate the page (or block) by setting all the links load templates where set
    * 
    */
    Templa.init = function(container) {
        
        if(! container) container = "*";
        
        $(container).find("[data-template]").on("click", function() {
            
            // get the urls from the data-* attributes
            var data_url = $(this).data("data");
            var template_url = $(this).data("template");
            
            // load the templates
            Templa.load(template_url, data_url)
            
            history.pushState(null, null, $(this).attr("href"));
            
            return false;
        })
    }
    
    Templa.config = function(name, value) {
        if(typeof value !== "undefined") {
            return _config[name] = value;
        } else {
            return _config[name];
        }
    }
    
})(jQuery);