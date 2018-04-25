$('document').ready(function () {
    /* $('form').attr('autocomplete', 'off');
     $(document).attr('cache','false');*/

    $('#fdetails').ready(function () {
        var val = $('.wrapper-pad #selectors li').attr('value');

        $('.wrapper-pad #selectors li').click(function (evt) {
            evt.preventDefault();

            if ($(this).hasClass('selected'))
                return false;

            val = $(this).attr('value');


            $('.wrapper-pad #selectors li.selected').removeClass('selected');
            $(this).addClass('selected');


            //alert("Current Value " + val);
            valueChange(val);


        });
        valueChange(val);

        function valueChange(val) {
            $.post('checks/home.php', {
                'act': 'reqinfo',
                'val': val
            }, function (data) {
                if (data.indexOf('|') == -1) {
                    alert(data);
                    return false;
                }

                data = data.split('|');
                $('#fdetails .element:nth-child(1) span').fadeOut(200, function () {
                    $(this).html(data[0]).fadeIn(200);
                });
                $('#fdetails .element:nth-child(2) span').fadeOut(200, function () {
                    $(this).html(data[1]).fadeIn(200);
                });
                $('#fdetails .element:nth-child(3) span').fadeOut(200, function () {
                    $(this).html(data[2]).fadeIn(200);
                });
                $('#fdetails .element:nth-child(4) span').fadeOut(200, function () {
                    $(this).html(data[3]).fadeIn(200);
                });
                $('#fdetails .element:nth-child(5) span').fadeOut(200, function () {
                    $(this).html(data[4]).fadeIn(200);
                });
            });
        }
    });

    $('#f2details').ready(function () {

        $.post('checks/home.php', {
            'act':'showInfo'
        }, function (data) {
            if (data.indexOf('|') == -1) {
                alert(data);
                return false;
            }

            data = data.split('|');
            $('#f2details .element:nth-child(1) span').fadeOut(200, function () {
                $(this).html(data[0]).fadeIn(200);
            });
            $('#f2details .element:nth-child(2) span').fadeOut(200, function () {
                $(this).html(data[1]).fadeIn(200);
            });
            $('#f2details .element:nth-child(3) span').fadeOut(200, function () {
                $(this).html(data[2]).fadeIn(200);
            });
            $('#f2details .element:nth-child(4) span').fadeOut(200, function () {
                $(this).html(data[3]).fadeIn(200);
            });
        });



    });

});

