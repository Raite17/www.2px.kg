;
(function (window, document, undefined) {
    'use strict';

    const FLEXKIT_NAME = 'flexkit';
    const FLEXKIT_PSEUDO_NAME = '[flexkit]';
    const FLEXKIT_VERSION = '0.0.2';

    var define, module, flexkit, _instance, options, events,
        documentElement, body, themeName,
        arrayBrowserRelType = {Firefox: 'prerender', Chrome: 'preload', ie: 'prerender'};


    flexkit = {
        init: function (options) {
            return _instance || new Flexkit(options);
        }
    };

    //flexkit = _instance || new Flexkit(options);

    function Flexkit(options) {

        documentElement = document.documentElement;
        body = document.body;
        options = options || {};

        // TODO check this in the future
        themeName = document.getElementById('current_theme') ? document.getElementById('current_theme').value : false;

        this.name = FLEXKIT_NAME;
        this.version = FLEXKIT_VERSION;
        this.themeName = themeName;

        _instance = this;

        var _boxStyle = options.chooseBoxStyle || false;


        _loadScript(options.loadScript);

        // Style checkbox and radio
        if (_boxStyle) {
            _chooseBoxStyle();
        }

        console.log('%s init.', FLEXKIT_PSEUDO_NAME);

        return _instance;
    }

    //Flexkit.prototype = Object.create(Helper.prototype);
    //Flexkit.prototype.constructor = Flexkit;

    /**
     *
     * @private
     */
    //function _preLoadPage() {
    //    console.log(window);
    //    //window.onload =
    //    document.addEventListener("DOMContentLoaded", function () {
    //        console.log('ttt', document.body, document.head);
    //        var listItems = document.querySelectorAll('a[href^="' + window.location.href + '"]');
    //        var relType = arrayBrowserRelType[_checkBrowser()];
    //        for (var i = 0; i < listItems.length; i++) {
    //            helper.createEl('link', ['rel:' + relType, 'href:' + listItems[i].href], document.head);
    //        }
    //    });
    //
    //}

    /**
     *
     * @param arrayScriptsName
     * @returns {boolean}
     * @private
     */
    function _loadScript(arrayScriptsName) {
        if (!arrayScriptsName) return false;
        if (themeName){
            var i = 0,
                scriptPath = window.location.href + 'themes/' + themeName + '/js/plugin/',
                scriptName;
            for (; i < arrayScriptsName.length; i++) {
                scriptName = arrayScriptsName[i] + '.min.js';
                helper.createEl('SCRIPT', ['async', 'src:' + scriptPath + scriptName]);
            }
        }
    }

    /**
     *
     * @private
     */
    function _chooseBoxStyle() {
        var items = document.querySelectorAll('[type="checkbox"]:not(.filed-upgrade):not(.icon):not(.hidden),[type="radio"]:not(.filed-upgrade):not(.icon):not(.hidden)'),
            itemsLength = items.length,
            label, id;

        while (itemsLength--) {
            id = items[itemsLength].id;

            if (!id) {
                items[itemsLength].id = id = 'chr-' + itemsLength;
            }

            items[itemsLength].classList.add('filed-upgrade');

            if (items[itemsLength].parentNode.className.indexOf('btn-group') == -1) {
                label = document.createElement('LABEL');
                label.classList.add('checkbox_radio');
                label.setAttribute('for', id);
                helper.insertAfter(label, items[itemsLength]);
            }

            if (items[itemsLength].parentNode.nodeName == 'LABEL') {
                items[itemsLength].parentNode.setAttribute('for', id);
            }
        }
    }

    Flexkit.prototype.showLoader = function (type) {
        var name = (type) ? 'loaded' : 'd-loaded';
        document.documentElement.classList.remove(name);
    };

    Flexkit.prototype.hideLoader = function (type) {
        var name = (type) ? 'loaded' : 'd-loaded';
        document.documentElement.classList.add(name);
    };

    Flexkit.prototype.getSpaceFromTop = function () {
        return window.pageYOffset || document.documentElement.scrollTop;
    };

    Flexkit.prototype.isMobile = function (callback) {
        if (device.type) {
            console.log('%s Mobile scripts loaded.', FLEXKIT_PSEUDO_NAME);
            callback();
        }
    };

    Flexkit.prototype.isLang = function (language) {
        language = language || '';

        if (documentElement.lang === language.toLowerCase()) {
            return true;
        } else {
            return document.documentElement.lang;
        }
    };


    //Expose skrollr as either a global variable or a require.js module.
    if (typeof define === 'function' && define.amd) {
        define([], function () {
            return flexkit;
        });
    } else if (typeof module !== 'undefined' && module.exports) {
        module.exports = flexkit;
    } else {
        window.flexkit = flexkit;
    }
}(window, document));