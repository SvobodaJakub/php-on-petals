/**
 * Galleria Fullscreenmod Theme 2017-06-10
 * Copyright (c) 2017 Jakub Svoboda
 * Based on:
 *  * Galleria Classic Theme 2017-02-27, Copyright (c) 2010 - 2017 worse is better UG, 
 *    Licensed 2017-02-27 under the MIT license, https://raw.github.com/worseisbetter/galleria/master/LICENSE
 *    galleria.fullscreen.js and galleria.fullscreen.css, version 1.5.4
 *  * Galleria Classicmod Theme, Copyright (c) 2013 Jan-Philip Gehrcke, http://gehrcke.de, 
 *    based on Galleria Classic Theme, Copyright (c) 2012 Aino, http://aino.se,
 *    Licensed under the MIT license, https://raw.github.com/aino/galleria/master/LICENSE
 * 
 * Licensed 2017-06-10 under the MIT license
 * 
 * Copyright (c) 2017 Jakub Svoboda
 * Copyright (c) 2010 - 2017 worse is better UG
 * Copyright (c) 2013 Jan-Philip Gehrcke, http://gehrcke.de
 * Copyright (c) 2012 Aino http://aino.se
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 */

(function($) {

/*global jQuery, Galleria, window */

Galleria.addTheme({
    name: 'fullscreenmod',
    version: '1.5.4.1',
    author: 'Galleria, Jan-Philip Gehrcke, Jakub Svoboda',
    css: 'galleria.fullscreenmod.css',
    // begin site script

    defaults: {
        idleTime: 700, 
        transition: 'none',
        imageCrop: false,
        thumbCrop: 'height',
        easing: 'galleriaOut',
        trueFullscreen: true,

        // set this to false if you want to keep the thumbnails:
        _hideDock: Galleria.TOUCH ? false : true,

        // set this to true if you want to shrink the carousel when clicking a thumbnail:
        _closeOnClick: false
    },
    init: function(options) {

        Galleria.requires( 1.5, 'This version of Fullscreen theme requires Galleria version 1.5 or later');

        this.addElement('thumbnails-tab');
        this.appendChild('thumbnails-container', 'thumbnails-tab');

        this.addElement("fullscreen-button");
        this.appendChild("container", "fullscreen-button");

        var tab      = this.$('thumbnails-tab'),
            loader   = this.$('loader'),
            thumbs   = this.$('thumbnails-container'),
            list     = this.$('thumbnails-list'),
            infotext = this.$('info-text'),
            info     = this.$('info'),
            fullscr  = this.$('fullscreen-button'),
            OPEN     = !options._hideDock,
            POS      = 0;
            
        if (Galleria.IE) {
            this.addElement('iefix');
            this.appendChild('container', 'iefix');
            this.$('iefix').css({
                zIndex: 3,
                position: 'absolute',
                backgroundColor: this.hasVariation('light') ? '#fff' : '#000',
                opacity: 0.4,
                top: 0
            });
        }

        if ( options.thumbnails === false ) {
            thumbs.hide();
        }

        var fixCaption = this.proxy(function(img) {

            var w = img.width || $(img).width();

            if (!(img || w)) {
                return;
            }
            w = Math.min(w, $(window).width());
            infotext.width(w - 40);
            if (Galleria.IE && this.getOptions('showInfo')) {
                this.$('iefix').width(info.outerWidth()).height(info.outerHeight());
            }
        });

        this.bind('rescale', function() {
            POS = this.getStageHeight() - tab.height() - 2;
            thumbs.css('top', OPEN ? POS - list.outerHeight() + 2 : POS);
            var img = this.getActiveImage();
            if (img) {
                fixCaption(img);
            }
        });

        this.bind('loadstart', function(e) {
            if (!e.cached) {
                loader.show().fadeTo(100, 1);
            }
            $(e.thumbTarget).css('opacity', 1).parent().siblings().children().css('opacity', 0.6);
        });

        this.bind('loadfinish', function(e) {
            loader.fadeOut(300);
            this.$('info, iefix').toggle(this.hasInfo());
        });

        this.bind('image', function(e) {
            e.imageTarget && fixCaption(e.imageTarget);
        });

        this.bind('thumbnail', function(e) {
            $(e.thumbTarget).parent(':not(.active)').children().css('opacity', 0.6);
            $(e.thumbTarget).on('click:fast', function() {
                if (OPEN && options._closeOnClick) {
                    tab.trigger('click:fast');
                }
            });
        });

        this.trigger('rescale');

        if ( !Galleria.TOUCH ) {

            this.addIdleState(thumbs, { opacity: 0 });
            this.addIdleState(this.get('info'), { opacity: 0 });
            this.addIdleState(fullscr, { opacity:0 });

            this.$('image-nav-left, image-nav-right').css('opacity', 0.01).hover(function() {
                $(this).animate({opacity: 1}, 100);
            }, function() {
                $(this).animate({opacity: 0});
            }).show();

        }

        if (Galleria.IE) {
            this.addIdleState(this.get('iefix'), { opacity: 0 });
        }

        if (options._hideDock) {
            tab.on('click:fast', this.proxy(function() {
                tab.toggleClass('open', !OPEN);
                if (!OPEN) {
                    thumbs.animate({
                        top: POS - list.outerHeight() + 2
                    }, 400, options.easing);
                } else {
                    thumbs.animate({
                        top: POS
                    }, 400, options.easing);
                }
                OPEN = !OPEN;
            }));
        } else {
            this.bind('thumbnail', function() {
                thumbs.css('top', POS - list.outerHeight() + 2);
            });
            tab.css('visibility', 'hidden');
        }

        this.$('thumbnails').children().hover(function() {
            $(this).not('.active').children().stop().fadeTo(100, 1);
        }, function() {
            $(this).not('.active').children().stop().fadeTo(400, 0.6);
        });

        galleria = this;
        fullscr.click(function() {
            galleria.toggleFullscreen()
        });

        this.attachKeyboard({
            escape: function(e) {
                return false;
            },
            up: function(e) {
                if (!OPEN) {
                    tab.trigger('click:fast');
                }
                e.preventDefault();
            },
            down: function(e) {
                if (OPEN) {
                    tab.trigger('click:fast');
                }
                e.preventDefault();
            },
            right: function(e) {
                galleria.next();
                e.preventDefault();
            },
            left: function(e) {
                galleria.prev();
                e.preventDefault();
            }
        });
    }
    // end site script
});

}(jQuery));
