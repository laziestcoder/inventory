var actpage;
function setPage(p) { actpage = p; }

$('document').ready(function() {
	// Click an item to check in
	$('table#items-check tbody tr').click(function() {
		var t = $(this);
		var id = $(this).data('id');
		
		if(actpage == 'in')
			var text = 'check-in';
		else
			var text = 'check-out';
		
		if($('tr[data-id='+id+']').next().data('id') != 'y') {
			var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td></td><td><form method=\"post\" data-saveid=\""+id+"\" name=\""+text+"\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save "+text+"\" /></td><td></td></tr>");
	
			t.after(cont);
			t.next().fadeIn(300);
		}
	});
	
	
	// Validate only numeric values
	$(document).on('keyup', 'form[name=check-in] input.num, form[name=check-out] input.num', function(evt) {
		val = $(this).val();
		var t = $(this);
		var re = /^-{0,1}\d+$/;

		console.log(re.test(val));
		if((re.test(val)) == false)
			t.val(val.substr(0, val.length - 1));
		return;
	});
	
	$(document).on('submit', 'form[name=check-in], form[name=check-out]', function(evt) {
		evt.preventDefault();
		submit_check('submit', this);
	});
	
	$(document).on('click', 'input[type=submit].save.check-in, input[type=submit].save.check-out', function(evt) {
		evt.preventDefault();
		submit_check('click', this);
	});
	
	
	function submit_check(from, t) {
		var t = $(t);
		
		if(from == 'submit') {
			var prev_value = t.parent().parent().prev().children('td:nth-child(4)').html();
			var val = t.children('input.num').val();
			var id = t.data('saveid');
		}else if(from == 'click') {
			var prev_value = t.parent().parent().prev().children('td:nth-child(4)').html();
			var val = t.parent().parent().children('td').children('form').children('input.num').val();
			var id = t.parent().parent().children('td').children('form').data('saveid');
		}
		
		if(val == '0' || val == '') {
			alert('Please insert a number of items to check '+actpage);
			return false;
		}
		
		if(actpage == 'in')
			var phppage = 'check-in.php';
		else {
			var phppage = 'check-out.php';
			
			if(parseInt(prev_value) < val) {
				alert('You cannot check out more than '+prev_value+' items');
				return false;
			}
		}
		
		$.post(phppage, {
			'act':'2',
			'id':id,
			'fromval':prev_value,
			'val':val
		}, function(data) {
			if(data == '2') {
				alert('You cannot check out more than '+prev_value+' items');
				return false;
			}else if(data == '1'){
				t.parent().parent().fadeOut(300, function() { this.remove(); });
				t.parent().parent().prev().children('td:nth-child(4)').fadeOut(200, function() {
					if(actpage == 'in')
						t.parent().parent().prev().children('td:nth-child(4)').html(parseInt(prev_value)+parseInt(val)).fadeIn(400);
					else
						t.parent().parent().prev().children('td:nth-child(4)').html(parseInt(prev_value)-parseInt(val)).fadeIn(400);
				});
			}else{
				alert('Something went wrong. Please try again');
			}
		});
	}
	
	// Search
	$('form[name=searchf]').submit(function(evt) {
		evt.preventDefault();
		$('.loader').fadeIn(200);
		var val = $(this).children('input[name=search]').val();
		
		if(val == '') {
			$('.loader').fadeOut(200);
			alert('Please write your search');
			return false;
		}
		
		$.post('check-in.php', {
			'act':'1',
			'val':val
		}, function(data) {
			if(data == '3') {
				if(actpage == 'in')
					location.href = 'check-in.php?search='+encodeURIComponent(val);
				else
					location.href = 'check-out.php?search='+encodeURIComponent(val);
				$('.loader').fadeOut(200);
				return false;
			}
			if(data == '2') {
				$('.loader').fadeOut(200);
				alert('No items matched your search');
				return false;
			}
			
			$('.loader').fadeOut(200);
			alert('Something went wrong. Please try again');
			return false;
		});
	});
	
	
	// Previous Page
	$('#pagination .prev').click(function() { go('prev', $(this).attr('name')); });
	
	// Next page
	$('#pagination .next').click(function() { go('next', $(this).attr('name')); });
	
	// Show per page
	$('select[name=show-per-page]').on('change', function() { go('show-per-page', this.value); });
	
	// Handler of pagination and show per page
	function go(act, val) {
		var search = urlGet()['search'];
		if(act == 'prev' || act == 'next') {
			var p = val;
			var pp = urlGet()['pp'];
			var url = 'page='+p;

			if(pp != undefined) url = url+'&pp='+pp;
		}else if(act == 'show-per-page') {
			var pp = val;
			var page = urlGet()['page'];
			var url = 'pp='+pp;
			
			if(page != undefined) url = url+'&page='+page;
		}
		
		if(search != undefined) url = url+'&search='+search;
		if(actpage == 'in')
			location.href = 'check-in.php?'+url;
		else
			location.href = 'check-out.php?'+url;
	}
	
	
	// Get url GET params
	function urlGet() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
});