$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});

$('.card').mouseover(function() {
	var idd = $(this).attr('id');
	$("."+idd, ".product-name").hide();

	$("."+idd, ".product-price").css('visibility', 'visible');
	$("."+idd, ".shop-link").css('visibility', 'visible');

});

$('.card').mouseout(function(){
	var idd = $(this).attr('id');
	$(".product-name").show();
	$("."+idd, ".product-price").css('visibility', 'hidden');
	$("."+idd, ".shop-link").css('visibility', 'hidden');
});

$('input[name=reg-username]').on('input', function() {
	var username = $('input[name=reg-username]').val();

	$.ajax({
		url: 'authenticate.php',
		type: 'POST',
		data: {
			auth_username: true,
			username: username
		},
		success:function(data) {
			// alert(data);
			if (data == 'invalid') {
				$('#chkUsr').css('color', 'red');
				$('#chkUsr').html('username exists');
				$('#submitBtn').attr('disabled', true);
			}
			else if (data == 'valid') {
				$('#chkUsr').css('color', 'green');
				$('#chkUsr').html('valid username');	
				$('#submitBtn').attr('disabled', false);
			}
			else if (data == 'blank') {
				$('#chkUsr').css('color', 'red');
				$('#chkUsr').html('username cannot be blank');
				$('#submitBtn').attr('disabled', true);
			}
			else if (data == 'short') {
				$('#chkUsr').css('color', 'red');
				$('#chkUsr').html('username too short');
				$('#submitBtn').attr('disabled', true);
			}

		}
	});
});




$('document').ready(function(){

	$('#submitBtn').click(function(e) {
		var formData = $('#loginForm').serialize();
		$.ajax({
			url: $('#loginForm').attr('action'),
			type: 'POST',
			data: formData,
			success:function(data) {
				if (data == -2) {
					// alert("Invalid username/password. Please Try Again.");
					$('$chkUsr').html('Invalid username/passowrd. Please Try Again');
				}
				else if (data == -1) {
					alert("The BAN HAMMER has been executed by the admin.");
				}
			},
			error:function(err){
				alert("nothing");
			}
		});
	});

	
	$('.edit-item').click(function(){
		var index = $(this).data('index');
		$.ajax({
			url: 'endpoint.php',
			type: 'POST',
			data: {
					edit_item: true,
					index: index
			},
			success:function(data) {
				$('.modal-title').html('Edit Item');
				$('.modal-body').html(data);
			}
		});
	});

	$('.delete-item').click(function() {
		var index = $(this).data('index');

		$.ajax({
			url: 'endpoint.php',
			type: 'POST',
			data: {
				delete_item: true,
				index: index
			},
			success:function(data) {
				$('.modal-title').html('Delete Item');
				$('.modal-body').html(data);
			}
		});
	});


	$('#add-item').click(function() {
		
		$.ajax({
			url: 'endpoint.php',
			type: 'POST',
			data: {
				add_item: true
			},
			success:function(data) {
				$('.modal-title').html("Add Item");
				$('.modal-body').html(data);
				$('#myModal').modal('show');
			}
		});
	});


	$('.selecta').on('change', function() {
		var id = $(this).data('index');
		var qty = $(this).val();
		$.ajax({
			url: 'endpoint.php',
			type: 'POST',
			data: {
				qtyChange : true,
				id: id,
				qty: qty 
			},
			success:function(data){
				data = $.trim(data);
				if (data == 'changed') {
					$('#div-shopping-bag').load(' #div-shopping-bag');
					$('#div-subtotal-price').load(' #div-subtotal-price');
					$('.price-'+id).load(' .'+id);
					$('#ifEmptyBag').load(' #ifEmptyBag');
				}
			}
		});
	});

	$('.shop-btn').click(function() {
		var prod_id = $(this).data('id');
		$.ajax({
			url: 'endpoint.php',
			type: 'GET',
			data: {
				add_to_cart : true,
				id : prod_id
			},
			success:function(data) {
				if (data != 5) {
					var delay = alertify.get('notifier','delay');
					 alertify.set('notifier','delay', 2);
					 alertify.set('notifier','position', 'top-right');
					 alertify.success('Product added to Shopping Bag.');
					 alertify.set('notifier','delay', delay);
					 $('#div-shopping-bag').load(' #div-shopping-bag');
				}
				else {
					alertify.alert("Oopps!", "You cannot order the same item more than 5 times.").show();
				}
			}
		});
		return false; /*prevent the page going back to top after clicking shop button*/
	});

	$('#wish-list-wrapper').on('click', '.wish-shop-btn',function() {
		var prod_id = $(this).data('id');
		$.ajax({
			url: 'endpoint.php',
			type: 'GET',
			data: {
				add_to_cart : true,
				id : prod_id
			},
			success:function(data) {
				if (data != 5) {
					var delay = alertify.get('notifier','delay');
					 alertify.set('notifier','delay', 2);
					 alertify.set('notifier','position', 'top-right');
					 alertify.success('Product added to Shopping Bag.');
					 alertify.set('notifier','delay', delay);
					 $('#div-shopping-bag').load(' #div-shopping-bag');
				}
				else {
					alertify.alert("Oopps!", "You cannot order the same item more than 5 times.").show();
				}
			}
		});
		return false; /*prevent the page going back to top after clicking shop button*/
	});

	$(".add-to-wish").click(function(e) {
		var prod_id = $(this).data('id');
		$.ajax({
			url: 'endpoint.php',
			type: 'POST',
			data: {
				add_to_wish : true,
				prod_id : prod_id
			},
			success:function(data) {
				data = $.trim(data);
				if (data == 'success') {
					var delay = alertify.get('notifier','delay');
					 alertify.set('notifier','delay', 2);
					 alertify.set('notifier','position', 'top-right');
					 alertify.warning('Product added to Wish List.');
					 alertify.set('notifier','delay', delay);
					$('#div-wish-list').load(' #div-wish-list');
				}
				else{
					alertify.alert("Oopps!",data).show();
				}
			}
		});
		return false; /*prevent the page going back to top after clicking add to wish button*/
	});

	$('.price-col').on('click', '.trash-can', function() {
		var id = $(this).data('id');
		 $.ajax({
			url: 'endpoint.php',
			type: 'GET',
			data: {
				delete_item_from_cart : true,
				id : id
			},
			success:function(data) {
				var delay = alertify.get('notifier','delay');
				 alertify.set('notifier','delay', 2);
				 alertify.set('notifier','position', 'top-right');
				 alertify.warning('Product has been removed.');
				 alertify.set('notifier','delay', delay);
				 $('#ifEmptyBag').load(' #ifEmptyBag');
				 $('#shopping-wrapper').load(' #shopping-wrapper');		
					 $('#div-shopping-bag').load(' #div-shopping-bag');
				 $('#'+id).remove();
			}
		});
		return false;
	});
});