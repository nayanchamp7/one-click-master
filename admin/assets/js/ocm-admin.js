/**
 * One Click Master JS
 */
window.Project = (function (window, document, $) {
	'use strict';

	var app = {
		init: function () {
            app.initToolTipster();

            //events
            $('.ocm-copy-text').on('click', app.ocmClickToCopy);
            $('.ocm-copy-link').on('click', app.ocmClickToCopyPostLink);
        },

        ocmClickToCopy: function(e) {
            e.preventDefault();
            var copiedText = $(this).parent().parent().find('.ocm-copy-text-select');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(copiedText).text()).select();
            document.execCommand("copy");
            $temp.remove();
        },
        
        ocmClickToCopyPostLink: function(e) {
            e.preventDefault();
            var copiedText = $(this).parent().parent().find('.ocm-copy-link-select');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(copiedText).text()).select();
            document.execCommand("copy");
            $temp.remove();
        },

        initToolTipster: function() {
            $('.ocm-tooltip').tooltipster({
                theme: 'tooltipster-borderless'
            });
        }
        

    };
    
	$(document).ready(app.init);

	return app;
})(window, document, jQuery);



