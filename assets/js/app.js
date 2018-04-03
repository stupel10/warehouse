(function($) {

	// --------------------------------------------------------
	// ALERTS
	setTimeout(function(){
		$('.alert:not(.alert-danger)').fadeOut();
	},3000);


	// --------------------------------------------------------
	// FORMS



	//
	// function makeAjax(form) {
	// 	form.on('submit', function () {
	// 		event.preventDefault();
	//
	// 		var req = $.ajax({
	// 			url     : form.attr('action'),
	// 			type    : form.attr('method'),
	// 			data    : form.serialize(),
	// 			dataType: 'json'
	// 		});
	// 		req.done(function (data) {
	// 			if (data.status === 'success') {
	// 				alert("DONE");
	// 			}
	// 		});
	// 	});
	// }
}(jQuery));

$(document).ready(function(){
	$("body").tooltip({ selector: '[data-toggle=tooltip]' });

	$('#change_profile_photo_input').on('change',function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#profile_photo').attr('src', e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
		}else{
			alert('No image file');
		}
	});
});
function deleteWarehouse( id ){
	if ( confirm("Really delete this warehouse?") ){
		window.location.href = 	'/_inc/user/warehouse_delete.php?id='+id;
	}
}
function deleteProduct( id ){
	if ( confirm("Really delete this product?") ){
		window.location.href = 	'/_inc/user/product_delete.php?id='+id;
	}
}
function select_profile_photo(){
	if(confirm('Realy change photo?')){
		$('#change_profile_photo_input').click();
	}
}
function deleteAllProductsFromWarehouse(warehouse_id,product_id){
	if(confirm('Realy delete all products?')){
		window.location.href = 	'/_inc/user/warehouse_product_delete.php?warehouse_id='+warehouse_id+'&product_id='+product_id;
	}
}