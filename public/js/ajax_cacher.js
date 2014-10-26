(function ( $ ) {
    
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

}( jQuery ));