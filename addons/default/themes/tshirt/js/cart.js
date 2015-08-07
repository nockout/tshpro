(function($) {

	$(function() {

		$("#cartToggleButton").on("click", function() {
			showcart();
		});

		$("#ajax_cart").on("submit", function(ev) {

			$.ajax({
				type : "POST",
				async : false,
				dataType : 'json',

				url : $(this).attr("action"),
				data : $(this).serialize(), // serializes the form's elements.
				success : function(data) {
					showcart();
					return;

				},

				complete : function(data) {
					// Handle the complete event
					//	 response = jQuery.parseJSON(data);
					showcart();
				}

			});

			ev.preventDefault();
			return false; // avoid
		});

	});
})(jQuery);
function showcart() {

	$('#cartModal').modal('toggle');
	$.get("cart/ajax_cart_items", function(data) {
		$('#cartModal div.modal-body').html(data);
	});
}
function chkCart(item, itemId) {
	$(item).closest("div.cartRowContent").remove();
	$.ajax({
		
		type : "POST",
		url : "cart/ajax_del_items",
		data : {
			"item_id" : itemId
		}, // serializes the form's elements.
		success : function(respone) {
			showcart();
			return true;
		},
		dataType : 'json'
	});
}
