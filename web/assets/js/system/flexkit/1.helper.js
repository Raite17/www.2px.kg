;
(function (window, document) {

    var _instance, helper = _instance || new Helper();

    /**
     *
     * @constructor
     */
    function Helper() {
        //console.info('Helper is init.');
    }

    //Helper.prototype.getUrlJson = function () {
    //    var hash = window.location.hash;
    //    var query = hash.substr(hash.indexOf('?') + 1);
    //    var result = {};
    //    query.split("&").forEach(function (part) {
    //        var item = part.split("=");
    //        result[item[0]] = decodeURIComponent(item[1]);
    //    });
    //    return result;
    //};

    /**
     *
     * @param type
     * @param attributesArray
     * @param parentElement
     */
    Helper.prototype.createEl = function (type, attributesArray, parentElement) { // TODO do more tests
        var element, i = 0, _parent = parentElement || document.body;
        element = document.createElement(type);
        for (; i < attributesArray.length; i++) {
            element.setAttribute(attributesArray[i].split(/:(.+)/)[0], attributesArray[i].split(/:(.+)/)[1] || '');
        }
        _parent.appendChild(element);
    };


    /**
     *
     * @param elem
     * @param refElem
     * @returns {Node}
     */
    Helper.prototype.insertAfter = function(elem, refElem) {
        var parent = refElem.parentNode, next = refElem.nextSibling;
        if (next) {
            return parent.insertBefore(elem, next);
        } else {
            return parent.appendChild(elem);
        }
    };


    /**
     *
     * @param events
     * @param selectorList
     * @param callback
     * @param parentElement
     * @returns {Helper}
     */
    Helper.prototype.addEvent = function (events, selectorList, callback, parentElement) { // TODO do more tests

        parentElement = document.querySelector(parentElement) || document;

        var _selectorList = selectorList.split(','),
            _elementsMap = [],
            _events = events.split(' '),
            elements,
            i = 0,
            m = 0;

        for (; i < _selectorList.length; i++) {
            elements = parentElement.querySelectorAll(_selectorList[i].trim());
            for (var n = 0; n < elements.length; n++) {
                // Create new array with all elements
                _elementsMap.push(elements[n]);
            }
        }
        // Set event to all elements
        for (; m < _elementsMap.length; m++) {
            for (var f = 0; f < _events.length; f++) {
                _elementsMap[m].addEventListener(_events[f], function (event) {
                    callback(event, event.target);
                }, false);
            }
        }

        return this;
    };

    window.helper = helper;
})(window, document);