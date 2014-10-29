//routing

Routa = (function() {
    
    /**
    * This is a container of routes, every time a link is clicked it should 
    * check against the GET, POST for forms
    */
    var _routes_container = {
        'GET': {},
        //'POST': {},
        //'PUT': {},
        //'DELETE': {},
    };
    
    
    
    
    var _isRoute = function(route, url) {
        
        // first, check that the sections match
        if(route.split("/").length !== url.split("/").length)
            return false;
        // next check the pattern
        var routeReg = new RegExp(route.replace(/:[^\s/]+/g, '([\\w-]+)'));
        
        return url.match(routeReg);
    }
    
    /**
    * Loop through every route for the given method and comapre it against the 
    * url given
    *
    * @param route string The route pattern eg. /accounts/:id
    * @param url string The url to check
    *
    * @return array Parameters from the url, or null if no match
    */
    var _checkUrl = function(params) {
        
        // debug, leave this here for now
        // var route = "/accounts/:id/delete";
        // var url = "/accounts/23/delete"; 

        // console.log(_isRoute(route, url));

           
        var urlParams, result=false;
        $.each(_routes_container[params.method], function(route, callback) {
            
            urlParams = _isRoute(route, params.url);
            
            if(urlParams) { // match
                
                urlParams.shift() // we don't need the first value
                
                result = {
                    callback: callback,
                    params: urlParams
                }
                
                return false;
            }
        });
        
        result.callback.apply(result.callback, result.params)
    };
    
    /**
    * Put a GET route in the container
    *
    * @param route string The route pattern eg. /accounts/:id
    * @param callback callback to call when a match is made with this route
    */
    var _get = function(route, callback) {
        _store("GET", route, callback);
    };
    
    /**
    * Put a route in its container
    *
    * @param route string The route pattern eg. /accounts/:id
    * @param method string GET|POST|PUT|DELETE
    * @param callback callback to call when a match is made with this route
    */
    var _store = function(method, route, callback) {
        if(typeof _routes_container[method] === "undefined")
            return false;
        
        _routes_container[method][route] = callback;
    };
    
    /**
    * Init links within a given container
    *
    * @param container string Container of page to initiate eg. '#content'
    */
    var _init = function(container) {
        if(! container) container = "*";
        
        $(container).find("a").on("click", function() {
            
            // strip ?... query string before comparing
            
            var params = _checkUrl({
                url: $(this).attr("href"), 
                method: "GET"
            });
            
            // console.log(params)
            
            // history.pushState(null, null, $(this).attr("href"));
            
            return false;
        })
    }
    
    
    
    
    
    
    
    // public methods
    
    return {
        get: _get,
        init: _init
    }
    
})();