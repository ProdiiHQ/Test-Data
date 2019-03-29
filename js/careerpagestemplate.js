jQuery(document).ready(function(){
	jQuery('body').on('click, mouseover', '.prd-social-network > li > a', function(e){
		e.preventDefault();
		e.stopPropagation();
		var that = jQuery(this);
		var href = that.data('href');
		that.parent().parent('ul').find('> li').removeClass('active');
		that.parent().addClass('active');

		jQuery(href).parent('.prd-tab-content').find('> .prd-tab-pane').removeClass('active');
		jQuery(href).addClass('active');
		return false;
	})
});

/*(function(jQuery) {
    jQuery.fn.ellipsis = function(options) {

        // default option
        var defaults = {
            'row' : 1, // show rows
            'onlyFullWords': false, // set to true to avoid cutting the text in the middle of a word
            'char' : '...', // ellipsis
            'callback': function() {},
            'position': 'tail' // middle, tail
        };

        options = jQuery.extend(defaults, options);

        this.each(function() {
            // get element text
            var that = jQuery(this);
            var text = that.html();
            var origText = text;
            var origLength = origText.length;
            var origHeight = that.height();

            // get height
            that.text('a');
            var lineHeight =  parseFloat(that.css("lineHeight"), 10);
            var rowHeight = that.height();
            var gapHeight = lineHeight > rowHeight ? (lineHeight - rowHeight) : 0;
            var targetHeight = gapHeight * (options.row - 1) + rowHeight * options.row;

            if (origHeight <= targetHeight) {
                that.text(text);
                options.callback.call(this);
                return;
            }

            var start = 1, length = 0;
            var end = text.length;
            var affix = jQuery('<span>').html(options['char']).text();

            if(options.position === 'tail') {
                while (start < end) { // Binary search for max length
                    length = Math.ceil((start + end) / 2);

                    that.text(text.slice(0, length) + affix);

                    if (that.height() <= targetHeight) {
                        start = length;
                    } else {
                        end = length - 4;
                    }
                }

                text = text.slice(0, start);

                if (options.onlyFullWords) {
                    text = text.replace(/[\u00AD\w\uac00-\ud7af]+$/, ''); // remove fragment of the last word together with possible soft-hyphen characters
                }
                text += options['char'];

            }else if(options.position === 'middle') {

                var sliceLength = 0;
                while (start < end) { // Binary search for max length
                    length = Math.ceil((start + end) / 2);
                    sliceLength = Math.max(origLength - length, 0);

                    that.text(
                        origText.slice(0, Math.floor((origLength - sliceLength) / 2)) +
                               affix +
                               origText.slice(Math.floor((origLength + sliceLength) / 2), origLength)
                    );

                    if (that.height() <= targetHeight) {
                        start = length;
                    } else {
                        end = length - 1;
                    }
                }

                sliceLength = Math.max(origLength - start, 0);
                var head = origText.slice(0, Math.floor((origLength - sliceLength) / 2));
                var tail = origText.slice(Math.floor((origLength + sliceLength) / 2), origLength);

                if (options.onlyFullWords) {
                    // remove fragment of the last or first word together with possible soft-hyphen characters
                    head = head.replace(/[\u00AD\w\uac00-\ud7af]+$/, '');
                }

                text = head + options['char'] + tail;
            }

            that.html(text);

            options.callback.call(this);
        });

        return this;
    };
}) (jQuery);*/