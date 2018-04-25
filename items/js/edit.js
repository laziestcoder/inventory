$('document').ready(function() {



    var catid = $('select[name=item-category]').data('id');
    //alert(catid);
    $('select[name=item-category]').ready(function () {
        $('option[value=' + catid + ']').attr('selected', true);
    });

    $('form[name=edit-item]').submit(function(evt) {
        evt.preventDefault();

        var id = $(this).data('id');
        var name = $('input[name=item-name]').val();
        var desc = $('textarea[name=item-descrp]').val();
        var cat = $('select[name=item-category]').val();
        var price = $('input[name=item-price]').val();

        if(name == '') {
            alert('Please insert a name');
            return false;
        }else if(price == '') {
            alert('Please insert a price');
            return false;
        }
       // alert(id+" "+name+" "+desc+" "+cat+" "+price );

        $.post('../checks/newItem.php', {
            'act':'edit',
            'itemid':id,
            'name':name,
            'desc':desc,
            'cat':cat,
            'price':price,
            'Request_Method': 'POST'
        },function(data) {
            if(data == '1') {
                alert('Changes have been successfully Saved');
                window.location.reload();
                return false;
            }else {
                alert('Something went wrong. Please try again '+data);
                return false;
            }
        });
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
        $('span.item-desc-left').html('Description ('+dif+' characters left):');
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