/*! modernizr 3.2.0 (Custom Build) | MIT *
 * http://modernizr.com/download/?-touchevents !*/
!function(e,n,t){function o(e,n){return typeof e===n}function s(){var e,n,t,s,a,i,r;for(var l in c)if(c.hasOwnProperty(l)){if(e=[],n=c[l],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(s=o(n.fn,"function")?n.fn():n.fn,a=0;a<e.length;a++)i=e[a],r=i.split("."),1===r.length?Modernizr[r[0]]=s:(!Modernizr[r[0]]||Modernizr[r[0]]instanceof Boolean||(Modernizr[r[0]]=new Boolean(Modernizr[r[0]])),Modernizr[r[0]][r[1]]=s),f.push((s?"":"no-")+r.join("-"))}}function a(e){var n=u.className,t=Modernizr._config.classPrefix||"";if(p&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+t+"no-js(\\s|$)");n=n.replace(o,"$1"+t+"js$2")}Modernizr._config.enableClasses&&(n+=" "+t+e.join(" "+t),p?u.className.baseVal=n:u.className=n)}function i(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):p?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function r(){var e=n.body;return e||(e=i(p?"svg":"body"),e.fake=!0),e}function l(e,t,o,s){var a,l,f,c,d="modernizr",p=i("div"),h=r();if(parseInt(o,10))for(;o--;)f=i("div"),f.id=s?s[o]:d+(o+1),p.appendChild(f);return a=i("style"),a.type="text/css",a.id="s"+d,(h.fake?h:p).appendChild(a),h.appendChild(p),a.styleSheet?a.styleSheet.cssText=e:a.appendChild(n.createTextNode(e)),p.id=d,h.fake&&(h.style.background="",h.style.overflow="hidden",c=u.style.overflow,u.style.overflow="hidden",u.appendChild(h)),l=t(p,e),h.fake?(h.parentNode.removeChild(h),u.style.overflow=c,u.offsetHeight):p.parentNode.removeChild(p),!!l}var f=[],c=[],d={_version:"3.2.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){c.push({name:e,fn:n,options:t})},addAsyncTest:function(e){c.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=d,Modernizr=new Modernizr;var u=n.documentElement,p="svg"===u.nodeName.toLowerCase(),h=d._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):[];d._prefixes=h;var m=d.testStyles=l;Modernizr.addTest("touchevents",function(){var t;if("ontouchstart"in e||e.DocumentTouch&&n instanceof DocumentTouch)t=!0;else{var o=["@media (",h.join("touch-enabled),("),"heartz",")","{#modernizr{top:9px;position:absolute}}"].join("");m(o,function(e){t=9===e.offsetTop})}return t}),s(),a(f),delete d.addTest,delete d.addAsyncTest;for(var v=0;v<Modernizr._q.length;v++)Modernizr._q[v]();e.Modernizr=Modernizr}(window,document);
/*
 * Browser Detect script
 */
BrowserDetect = (function() {
    // script settings
    var options = {
        osVersion: true,
        minorBrowserVersion: true
    };

    // browser data
    var browserData = {
        browsers: {
            chrome: uaMatch(/Chrome\/([0-9\.]*)/),
            firefox: uaMatch(/Firefox\/([0-9\.]*)/),
            safari: uaMatch(/Version\/([0-9\.]*).*Safari/),
            opera: uaMatch(/Opera\/.*Version\/([0-9\.]*)/, /Opera\/([0-9\.]*)/),
            msie: uaMatch(/MSIE ([0-9\.]*)/, /Trident.*rv:([0-9\.]*)/)
        },
        engines: {
            webkit: uaContains('AppleWebKit'),
            trident: uaMatch(/(MSIE|Trident)/),
            gecko: uaContains('Gecko'),
            presto: uaContains('Presto')
        },
        platforms: {
            win: uaMatch(/Windows NT ([0-9\.]*)/),
            mac: uaMatch(/Mac OS X ([0-9_\.]*)/),
            linux: uaContains('X11', 'Linux')
        }
    };

    // perform detection
    var ua = navigator.userAgent;
    var detectData = {
        platform: detectItem(browserData.platforms),
        browser: detectItem(browserData.browsers),
        engine: detectItem(browserData.engines)
    };

    // private functions
    function uaMatch(regExp, altReg) {
        return function() {
            var result = regExp.exec(ua) || altReg && altReg.exec(ua);
            return result && result[1];
        };
    }
    function uaContains(word) {
        var args = Array.prototype.slice.apply(arguments);
        return function() {
            for(var i = 0; i < args.length; i++) {
                if(ua.indexOf(args[i]) < 0) {
                    return;
                }
            }
            return true;
        };
    }
    function detectItem(items) {
        var detectedItem = null, itemName, detectValue;
        for(itemName in items) {
            if(items.hasOwnProperty(itemName)) {
                detectValue = items[itemName]();
                if(detectValue) {
                    return {
                        name: itemName,
                        value: detectValue
                    };
                }
            }
        }
    }

    // add classes to root element
    (function() {
        // helper functions
        var addClass = function(cls) {
            var html = document.documentElement;
            html.className += (html.className ? ' ' : '') + cls;
        };
        var getVersion = function(ver) {
            return typeof ver === 'string' ? ver.replace(/\./g, '_') : 'unknown';
        };

        // add classes
        if(detectData.platform) {
            addClass(detectData.platform.name);
            // if(options.osVersion) {
            //     addClass(detectData.platform.name + '-' + getVersion(detectData.platform.value));
            // }
        }
        // if(detectData.engine) {
        //     addClass(detectData.engine.name);
        // }
        if(detectData.browser) {
            addClass(detectData.browser.name);
            // addClass(detectData.browser.name + '-' + parseInt(detectData.browser.value, 10));
            // if(options.minorBrowserVersion) {
            //     addClass(detectData.browser.name + '-' + getVersion(detectData.browser.value));
            // }
        }
    }());

    // export detection information
    return detectData;
}());