$(document).ready(function(){
    $('form').attr('autocomplete', 'off');
    $(document).attr('cache','false');

    //New Category Add

    $('#submit').click(function(){
        var name = $('#item').val();
        var category = $('#itemCategory').val();
        var description = $('#itemDescription').val();
        var quantity = $('#quantity').val();
        var price = $('#price').val();
        var act="newItem";
        //alert(name + description + category + quantity + price );

        if(name !='' && category!='' && description!='' && quantity!='' && price!='') {
            $.ajax({
                url: "../checks/newItem.php",
                method: "POST",
                data: {name: name, category: category, description: description, quantity:quantity, price:price,act:act},
                dataType: "text",

                success: function (data) {
                    $('#item').val('');
                    $('#itemCategory').val('');
                    $('#itemDescription').val('');
                    $('#quantity').val('');
                    $('#price').val('');
                    alert('Data Insterted Successfully!');
                },
                error:  function (err) {
                    alert(" Data Insertion Failed! => " + err);

                }
            });
        }
        else{
            alert('Data Field Empty!');
        }
    });

    $('textarea[name=item-descrp]').keyup(function(evt) {
        var count = $(this).val().length;
        var limit = 400;
        var val = $(this).val();
        var t = $(this);

        if(count > limit){
            t.val(val.substr(0,400));
            var dif = 0;
        }else
            var dif = limit-count;
        $('span.item-desc-left').html('Description: ('+dif+' characters left)');
    });

    $('input[name=item-qty]').keyup(function(evt) {
        var val = $(this).val();
        var re = /^\d+$/;
        var t = $(this);

        if((re.test(val)) == false)
            t.val(val.substr(0, val.length - 1));
        return;
    });

    $('input[name=item-price]').keyup(function(evt) {
        var val = $(this).val();
        var re = /^\d*\.{0,1}\d{0,2}$/;
        var t = $(this);

        if((re.test(val)) == false)
            t.val(val.substr(0, val.length - 1));
        return;
    });





});  