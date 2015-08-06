(function($) {
	$(function() {

		$("#cartToggleButton").on("click", function() {

			$('#cartModal').modal('toggle');
			$.get("cart/ajax_cart_items", function(data) {
				$('#cartModal div.modal-body').html(data);
			});
		});

		$("#ajax_cart").on("submit", function(ev) {

			$.ajax({
				type : "POST",
				url : $(this).attr("action"),
				data : $(this).serialize(), // serializes the form's elements.
				success : function(respone) {
					$('.cart_item_count').html(respone.t);
					$('#checkout').removeAttr("disabled");
					$('#cartModal div.modal-body').html(respone.h);
					$('#cartModal').modal('toggle');
				},
			 dataType: 'json'
			});
			
			ev.preventDefault();
			return false; // avoid 
		});
	});
})(jQuery);