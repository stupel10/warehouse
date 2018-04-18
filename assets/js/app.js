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
			alert('Obrázok nenájdený');
		}
	});
});
function deleteWarehouse( id ){
	if ( confirm("Vymazať tento sklad?") ){
		window.location.href = 	'/_inc/user/warehouse_delete.php?id='+id;
	}
}
function deleteProduct( id ){
	if ( confirm("Vymazať tento produkt?") ){
		window.location.href = 	'/_inc/user/product_delete.php?id='+id;
	}
}
function select_profile_photo(){
	if(confirm('Zmeniť fotku?')){
		$('#change_profile_photo_input').click();
	}
}
function deleteAllProductsFromWarehouse(warehouse_id,product_id,supplier_id){
	if(confirm('Zmazať daný záznam?')){
		window.location.href = 	'/_inc/user/warehouse_product_delete.php?warehouse_id='+warehouse_id+'&product_id='+product_id+'&supplier_id='+supplier_id;
	}
}
function deleteSubscriber(subscriber_id){
	if(confirm('Zmazať odoberatela?')){
		window.location.href = 	'/_inc/user/subscriber_delete.php?subscriber_id='+subscriber_id;
	}
}
function deleteSupplier(supplier_id){
	if(confirm('Zmazať dodavatela?')){
		window.location.href = 	'/_inc/user/supplier_delete.php?supplier_id='+supplier_id;
	}
}
function deleteUser(user_id){
	if(confirm('Zmazať uživateľa?')){
		window.location.href = 	'/_inc/user/user_delete.php?user_id='+user_id;
	}
}