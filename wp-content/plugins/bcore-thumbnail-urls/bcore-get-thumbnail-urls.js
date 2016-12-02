jQuery(function($) {

	function getParameterByName(name, url) {
		if (!url) { url = window.location.href; }
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	function loadButton() {
		// $('.attachment-info .settings').append('<label class="setting"><span class="name">Thumbnail URLs</span><span class="value"><button class="button">Click to get all thumbnail URLs</button></span></label>');
		var imageId = getParameterByName('item');

		$.ajax({
			url: bcore_thumbnails.ajax,
			data: {
				action: 'get_urls',
				image_id: imageId
			},
			success: function(data) {
				$('.attachment-info .settings').append(data);
			}
		});
	}

	$(document).on('click', '.thumbnail, .edit-media-header .left, .edit-media-header .right', function() {
		loadButton();
	});
});