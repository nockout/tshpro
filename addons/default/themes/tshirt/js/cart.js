(function($) {

	$(function() {

		$("#cartToggleButton").on("click", function() {
			showcart();
		});

		$(".picksize").on("click",function(){
			var size =$(this).attr('for');
			$("input[name='sizeSelected']").val(size);
		});
		$("#ajax_cart").on("submit", function(ev) {

			var size=$("#sizeSelected").val();
			if(!size){
				
				alert("Bạn phải chọn size");
				return false;
			}
		
			$.ajax({
				type : "POST",
				async : false,
				dataType : 'json',

				url : $(this).attr("action"),
				data : $(this).serialize(), // serializes the form's elements.
				success : function(data) {
					showcart();
					return;

				}

			

			});

			ev.preventDefault();
			return false; // avoid
		});

	});
})(jQuery);

function selectSize(){
	
}
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
