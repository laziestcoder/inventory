$('document').ready(function() {
	// Search
	$('form[name=searchf]').submit(function(evt) {
		evt.preventDefault();
		$('.loader').fadeIn(200);
		var val = $(this).children('input[name=search]').val();
		
		var itemid = urlGet()['itemid'];
		var userid = urlGet()['userid'];
		var catid = urlGet()['catid'];
		
		if(itemid == undefined)
			itemid = 'no';
		if(userid == undefined)
			userid = 'no';
		if(catid == undefined)
			catid = 'no';
		
		if(val == '') {
			$('.loader').fadeOut(200);
			alert('Please write your search');
			return false;
		}
		
		$.post('index.php', {
			'act':'1',
			'val':val,
			'itemid':itemid,
			'userid':userid,
			'catid':catid
		}, function(data) {
			if(data == '3') {
				$('.loader').fadeOut(200);
				location.href = 'index.php?search='+encodeURIComponent(val);
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
		
		var itemid = urlGet()['itemid'];
		if(itemid != undefined) url = url+'&itemid='+itemid;
		
		var userid = urlGet()['userid'];
		if(userid != undefined) url = url+'&userid='+userid;
		
		var catid = urlGet()['catid'];
		if(catid != undefined) url = url+'&catid='+userid;
		
		location.href = 'index.php?'+url;
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