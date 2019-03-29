jQuery(document).ready(function(){
	
	jQuery(document).on('click', '.prd-team-toggler', function(e){
		e.preventDefault();
		jQuery(this).toggleClass('prd-opened');
		jQuery(this).parents('.prd-team-holder').find('.prd-team-members').toggleClass('prd-showing').blur();
		
	});

	jQuery(document).on('click', '.prd-team-member', function(e){
		e.preventDefault();
		jQuery('.prd-modal').addClass('prd-showing');
	});

	jQuery(document).on('click', '.prd-modal .prd-close', function(e){
		e.preventDefault();
	});

});

// prdEllipsis plugin
(function ($) {
	$.fn.prdEllipsis = function(options) {
		var settings = $.extend({
			peRows: 10,
			peLink: ' ... '
		}, options);
		
		this.each(function( ) {
			var element = jQuery(this);
			jQuery(this).ellipsis({
				row: settings.peRows,
				char: settings.peLink,
				callback: function() {
					var that = jQuery(this);
					jQuery(this).find(".view-more").on("click", function(e){
						that.toggleClass("prd-hide");
						that.next(".prd-hide").toggleClass("prd-show");
						e.preventDefault();
					});
					jQuery(".view-less").on("click", function(e){
						jQuery(this).parent(".prd-hide").toggleClass("prd-show").prev(".prd-profile-ellipsis").toggleClass("prd-hide");
						e.preventDefault();
					});
				}
			});
		});
	};
}( jQuery ));
