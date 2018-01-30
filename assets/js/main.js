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
					alert("Invalid username/password. Please Try Again.");
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
				if (data == 1) {
					$('#div-shopping-bag').load(' #div-shopping-bag');
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
				var delay = alertify.get('notifier','delay');
				 alertify.set('notifier','delay', 2);
				 alertify.set('notifier','position', 'top-right');
				 alertify.success('Product added to Shopping Bag.');
				 alertify.set('notifier','delay', delay);
				 $('#div-shopping-bag').load(' #div-shopping-bag');
			}
		});
		return false;
	});

	$(".add-to-wish").click(function() {
		var prod_id = $(this).data('id');
		$.ajax({
			url: 'endpoint.php',
			type: 'POST',
			data: {
				add_to_wish : true,
				prod_id : prod_id
			},
			success:function(data) {
				if (data != 0) {
					alertify.alert("Oopps!",data).show();
				}
				else{
					var delay = alertify.get('notifier','delay');
					 alertify.set('notifier','delay', 2);
					 alertify.set('notifier','position', 'top-right');
					 alertify.warning('Product added to Wish List.');
					 alertify.set('notifier','delay', delay);
					$('#div-wish-list').load(' #div-wish-list');
				}
			}
		});
		return false;
	});

	// var scrollStart = 0;
	// var startChange = $("#data-row");
	// var offset = startChange.offset();
	// $(document).scroll(function() {
	// 	scroll_start = $(this).scrollTop();
	// 	if (scroll_start > offset.top) {
	// 		$('.bg-custom').css('background-color', 'rgb(251,251,251)');
	// 	}
	// 	else {
	// 		$('.bg-custom').css('background-color', 'transparent');
	// 	}
	// });
});