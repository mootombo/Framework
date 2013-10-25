/*
 * Bootstrap XiveContextMenu - jQuery plugin for right-click context menus
 *
 * Author: Lahmizzar Muinela, devXive - research and development
 *
 * Licensed under the MIT licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Version: 1.1.9 Beta
 * Date: 22 October 2013
 *
 * For documentation visit http://devxive.com/
 */

(function ($) {
    $.fn.bsxContextMenu = function (target, options) {

        var $bsContextMenu = $(this);

        // Set the default options
        var trigger, currentTarget;
        var settings = $.extend({
            dropdownMenu: {
                display: 'block',
                position: 'absolute',
                zIndex: 100
            },
            listStyle: {
                cursor: 'default',
                padding: '3px'
            },
            targetStyle: {
                cursor: 'context-menu',
                selectable: false
            },
            shadow: false,
            bindings: false
        }, options);

        // Call the Initializer Function
        ContextMenuInitializer(target, this, settings);

        $("body").on('contextmenu', target, function (e) {
            // Store the clicked / current Element
            $currentTarget = $(this);

            $bsContextMenu.css({
                display: settings.dropdownMenu.display,
                position: settings.dropdownMenu.position,
                zIndex: settings.dropdownMenu.zIndex,
                left: e.pageX + 10,
                top: e.pageY - 40
            });
            return false;
        });

        if( settings.bindings ) {
            $.each(settings.bindings, function (id, func) {
                $bsContextMenu.on('click', 'a[data-menu="' + id + '"]', function (e) {
                    e.preventDefault();

                    if( !$( this ).parent('li').hasClass('disabled') ) {
                        func($currentTarget, 'devXive');
                    }
                });
            });
        } else {
            // Read and set data-target and redirect to anchor href
            $bsContextMenu.on('click', 'a', function (e) {
                e.preventDefault();
                var windowTarget = $(this).data('target'),
                    anchorUrl = $(this).attr('href');
                
                if( !$( this ).parent('li').hasClass('disabled') ) {
                    if( !windowTarget ) {
                        window.location.href = anchorUrl;
                    } else {
                        window.open(anchorUrl, windowTarget);
                    }
                }
            });
        }


    };

    // Initializer Function
    function ContextMenuInitializer(target, bsCMenu, settings) {
        $(bsCMenu).hide();

        $(document).click(function () {
            $(bsCMenu).hide();
        });

        $(target).css({
            cursor: settings.targetStyle.cursor
        });

        if( !settings.targetStyle.selectable ) {
            $(target).on('selectstart', function( event ) { event.preventDefault(); });
        }
    }
}( jQuery ));