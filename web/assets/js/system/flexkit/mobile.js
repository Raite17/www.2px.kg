flexkit.isMobile(function () {

    // Replace :hover => .touch for touch devices
    replaceSelector(':hover|:active', '.touch', false);

    // Add class to elements on mobile
    helper
        .addEvent('touchstart', 'body', function (event, element) {
            element.classList.add('touch')
        })
        // Remove the same class from elements on mobile
        .addEvent('touchend touchmove', 'body', function (event, element) {
            element.classList.remove('touch');
        })
        // Calling a function that opens a menu
        .addEvent('click', '[data-refer]', function (event, element) {
            _tapAction(element);
        });

    // Load special font for mobile devices.
    // This font is used in the mobile menu. For more information, look Material Design
    WebFontConfig = {
        google: {
            families: ['Roboto:400,500']
        }
    };
    (function (d) {
        var wf = d.createElement('script'), s = d.scripts[0];
        wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js';
        s.parentNode.insertBefore(wf, s);
    })(document);

    /**
     * Open menu (main or dropdown)
     * @param element
     * @private
     */
    function _tapAction(element) {
        if (typeof element != 'undefined' && element.dataset.refer.length) {
            var referName = element.dataset.refer;
            document.querySelector('[data-el="' + referName + '"]').classList.add('open');
            body.setAttribute('data-overlay', '');
            body.addEventListener('touchend', _closeMenu);
        }
    }

    /**
     * Close menu if click outside of menu
     * @param event
     * @private
     */
    function _closeMenu(event) {
        if (event.target.hasAttribute('data-overlay')) {
            event.preventDefault();

            document.querySelector('.m-menu.open').classList.remove('open');
            body.removeAttribute('data-overlay');
        }
    }


    //body.addEventListener('touchstart', function () {
    //    var touchPoint = flexkit.getSpaceFromTop();
    //
    //    window.onscroll = function () {
    //        if (touchPoint > flexkit.getSpaceFromTop()) {
    //            document.querySelector('.mobile-bar').classList.remove('bar-scroll-hide');
    //        } else if (touchPoint < flexkit.getSpaceFromTop()) {
    //            document.querySelector('.mobile-bar').classList.add('bar-scroll-hide');
    //        }
    //    };
    //});

    // TODO reorganize this method
    tapButton('sub-menu-btn', function (e) {
        if (!window.Hammer) {
            e.stopPropagation();
        } else {
            e.srcEvent.stopPropagation();
        }
        e.preventDefault();
        e.target.classList.toggle('active');
        e.target.parentNode.querySelector('ul').classList.toggle('open');
    });


    function tapButton(selector, fun) {
        var listItems = document.getElementsByClassName(selector);
        if (!window.Hammer) {
            for (var i = 0; i < listItems.length; i++) {
                if (window.addEventListener) {
                    listItems[i].addEventListener('click', fun, false);
                } else if (window.attachEvent) {
                    listItems[i].attachEvent('click', fun, false);
                }
            }
        } else {
            Hammer.each(listItems, function (item) {
                var touchControl = new Hammer(item, {domEvents: true});
                touchControl.on("tap", fun);
            });
        }
    }
});