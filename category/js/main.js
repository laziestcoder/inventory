$(document).ready(function(){ 
	$('form').attr('autocomplete', 'off');
    $(document).attr('cache','false');

	//New Category Add

	$('#submit').click(function(){
		var name = $('#categoryName').val();
		var place = $('#categoryPlace').val();
		var description = $('#categoryDescription').val();
		//alert(name + place + description);
		if(name !='' && place!='' && description!='') {
            $.ajax({
                url: "../checks/newCategory.php",
                method: "POST",
                data: {name: name, place: place, description: description, act:'add'},
                dataType: "text",
                success: function (data) {
                    $('#categoryName').val('');
                    $('#categoryPlace').val('');
                    $('#categoryDescription').val(data);
                    alert('Data Insterted Successfully!');
                },
                error: function (err) {
                alert('Data Insertion Failed! => ' + error );
                }
            });
        }
        else{
			alert('Data Field Empty!');
		}
	});

    $('textarea[name=ncat-descrp]').keyup(function(evt) {
        var count = $(this).val().length;
        var limit = 400;
        var val = $(this).val();
        var t = $(this);

        if(count > limit){
            t.val(val.substr(0,400));
            var dif = 0;
        }else
            var dif = limit-count;
        $('span.ncat-desc-left').html('Description: ('+dif+' characters left)');
    });

	


	//Category Data Load
	$('#categoryData').ready(function(){
            $.ajax({
                url:"../checks/categoryData.php",
                dataType: "text",
                success: function (data) {
                    $('#categoryData').html(data);
                },
                error: function (err) {
                    $('#categoryData').html('Data Parsing Error! => ' + err);
                }
            });
    });


});  