$(document).ready(function () {
    /*$('form').attr('autocomplete', 'off');
    $(document).attr('cache', 'false');*/

    //var x = 0;
    //Item Data Show

    //$('div#itemData').ready(function () {
        $.ajax({
            url: "../checks/itemData.php",
            dataType: "text",

            success: function (data) {
                $('div#itemData').html(data);
            },
            error: function () {
                $('div#itemData').html('Data Parsing Error!');
            }
        });
    //});


    //alert("Clicked! "+x+1);x=x+1;

    // "Select all" checkbox

        $('input[type=checkbox][name=select-all]').change(function () {
            //alert("Clicked! " + x + 1);x = x + 1;
            if (this.checked) {
                $('div#itemData table#items input[type=checkbox]').prop('checked', true);
            } else {
                $('div#itemData table#items input[type=checkbox]').prop('checked', false);
            }

            if ($('input[name=chbox]:checked').length >= 1) {
                $('#table-head a.btn').removeClass('disabled');
            } else {
                $('#table-head a.btn').addClass('disabled');
            }
        });


        $('tr[data-type=element] td[data-type=id], tr[data-type=element] td[data-type=name], tr[data-type=element] td[data-type=cat]').click(function () {
            var item = $(this).parent().data('id');
            location.href = 'index.php?id=' + item;
        });


        // Checkbox of any item
        $('input[name=chbox]').change(function () {
            if ($('input[name=chbox]:checked').length >= 1) {
                //alert("Clicked! " + x + 1);x = x + 1;
                $('#table-head a.btn').removeClass('disabled');
            } else {
                //alert("Clicked! " + x + 1);x = x + 1;
                $('#table-head a.btn').addClass('disabled');
                $('input[type=checkbox][name=select-all]').prop('checked', false);
            }

            var total_checkboxes = $('input[name=chbox]').length;
            if ($('input[name=chbox]:checked').length == total_checkboxes) {
                $('input[type=checkbox][name=select-all]').prop('checked', true);
            }
        });


        // Main Button (check-out all)
        $('a[name=check-out-all]').click(function (evt) {
            evt.preventDefault();
            check_items('out', this);
        });

        // Main Button (check-in all)
        $('a[name=check-in-all]').click(function (evt) {
            evt.preventDefault();
            check_items('in', this);
        });

        // Check In/Out All handler
        function check_items(act, t) {
            t = $(t);
            if (t.hasClass('disabled')) return false;

            if (act == 'out') {
                var act = 'check-out';
                var text = 'Check Out:';
            } else if (act == 'in') {
                var act = 'check-in';
                var text = 'Check In:';
            }

            var selected = mapCheckboxes();

            for (var i = 0; i < selected.length; i++) {
                var id = selected[i];

                if ($('input[type=checkbox][name=chbox][value="' + id + '"]').parent().parent().next().data('id') != 'y') {
                    if (getViewportWidth() > 420)
                        var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td></td><td>" + text + "</td><td><form method=\"post\" data-saveid=\"" + id + "\" name=\"" + act + "\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save " + act + "\" /></td><td></td></tr>");
                    else if (getViewportWidth() <= 420 && getViewportWidth() > 370)
                        var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td>" + text + "</td><td></td><td><form method=\"post\" data-saveid=\"" + id + "\" name=\"" + act + "\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save " + act + "\" /></td><td></td></tr>");
                    else
                        var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td>" + text + "</td><td></td><td><form method=\"post\" data-saveid=\"" + id + "\" name=\"" + act + "\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save " + act + "\" /></td><td></td></tr>");

                    $('input[type=checkbox][name="chbox"][value="' + id + '"]').parent().parent().after(cont);
                    $('input[type=checkbox][name="chbox"][value="' + id + '"]').parent().parent().next().fadeIn(300);
                }
            }
        }


        // Main Button (delete all)
        $('a[name=delete-all]').click(function (evt) {
            evt.preventDefault();
            var t = $(this);
            if ($(this).hasClass('disabled'))
                return false;

            alert('Sorry. This button is disabled for the demo version');
            return false;
        });


        // Check in
        $('a[name=c1]').click(function (evt) {
            evt.preventDefault();
            check_item('in', this);
        });

        // Check out
        $('a[name=c2]').click(function (evt) {
            evt.preventDefault();
            check_item('out', this);
        });

        // Check In/Out Single Item Handler
        function check_item(act, t) {
            var t = $(t);
            var id = t.parent().parent().children('td').children('input[type=checkbox]').val();
            var element = t.parent().parent();

            if (act == 'out') {
                act = 'check-out';
                var text = 'Check Out:';
            } else if (act == 'in') {
                act = 'check-in';
                var text = 'Check In:';
            }

            if ($('input[type=checkbox][name=chbox][value="' + id + '"]').parent().parent().next().data('id') != 'y') {
                if (getViewportWidth() > 420)
                    var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td></td><td>" + text + "</td><td><form method=\"post\" data-saveid=\"" + id + "\" name=\"" + act + "\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save " + act + "\" /></td><td></td></tr>");
                else if (getViewportWidth() <= 420 && getViewportWidth() > 370)
                    var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td>" + text + "</td><td></td><td><form method=\"post\" data-saveid=\"" + id + "\" name=\"" + act + "\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save " + act + "\" /></td><td></td></tr>");
                else
                    var cont = $("<tr style=\"display:none\" data-id=\"y\"><td></td><td></td><td>" + text + "</td><td></td><td><form method=\"post\" data-saveid=\"" + id + "\" name=\"" + act + "\"><input type=\"text\" class=\"num\" placeholder=\"# of items\" /></form></td><td></td><td><input type=\"submit\" value=\"Save\" class=\"btn blue save " + act + "\" /></td><td></td></tr>");
                element.after(cont);
                t.parent().parent().next().fadeIn(300);
            }
        }

        // Validate only numeric values
        $(document).on('keyup', 'form[name=check-in] input.num, form[name=check-out] input.num', function (evt) {
            val = $(this).val();
            var t = $(this);
            var re = /^-{0,1}\d+$/;

            console.log(re.test(val));
            if ((re.test(val)) == false)
                t.val(val.substr(0, val.length - 1));
            return;
        });


        // Submit check in (by form submit)
        $(document).on('submit', 'form[name=check-in]', function (evt) {
            evt.preventDefault();
            submit_check('submit', 'in', this);
        });
        // Submit check in (by button click)
        $(document).on('click', 'input[type=submit].save.check-in', function (evt) {
            evt.preventDefault();
            submit_check('click', 'in', this);
        });

        // Submit check out (by form submit)
        $(document).on('submit', 'form[name=check-out]', function (evt) {
            evt.preventDefault();
            submit_check('submit', 'out', this);
        });
        // Submit check out (by button click)
        $(document).on('click', 'input[type=submit].save.check-out', function (evt) {
            evt.preventDefault();
            submit_check('click', 'out', this);
        });

        // Submit check in/out handler
        function submit_check(from, type, t) {
            var t = $(t);

            if (from == 'submit') {
                var prev_value = t.parent().parent().prev().children('td:nth-child(5)').html();
                var val = t.children('input.num').val();
                var id = t.data('saveid');
            } else if (from == 'click') {
                var prev_value = t.parent().parent().prev().children('td:nth-child(5)').html();
                var val = t.parent().parent().children('td').children('form').children('input.num').val();
                var id = t.parent().parent().children('td').children('form').data('saveid');
            }

            if (type == 'in') var act = 3;
            else if (type == 'out') var act = 4;

            if (val == '0' || val == '') {
                alert('Please insert a number of items to check ' + type);
                return false;
            }

            if (type == 'out') {
                if (parseInt(prev_value) < val) {
                    alert('You cannot check out more than ' + prev_value + ' items');
                    return false;
                }
            }
            var chk;
            alert("act =" + act);
            if (act == 'in') {
                chk = 1;
            }
            else {
                chk = 0;
            }
            $.post('../check-in/update.php', {
                'act': chk,
                'id': id,
                'fromval': prev_value,
                'val': val
            }, function (data) {
                if (data == '2') {
                    alert('You cannot check out more than ' + prev_value + ' items');
                    return false;
                } else if (data == '1') {
                    t.parent().parent().fadeOut(300, function () {
                        this.remove();
                    });
                    t.parent().parent().prev().children('td:nth-child(5)').fadeOut(200, function () {
                        if (act == 3)
                            t.parent().parent().prev().children('td:nth-child(5)').html(parseInt(prev_value) + parseInt(val)).fadeIn(400);
                        else if (act == 4)
                            t.parent().parent().prev().children('td:nth-child(5)').html(parseInt(prev_value) - parseInt(val)).fadeIn(400);
                    });
                } else {
                    alert('Something went wrong. Please try again');
                }
            });
        }


        // Delete Item
        $('a[name=c5]').click(function (evt) {
            evt.preventDefault();
            var t = $(this);

            if (confirm('Are you sure you want to delete this item?') == true) {
                var id = t.parent().parent().children('td').children('input[type=checkbox]').val();
                if (id == 1) {
                    alert('Sorry. In the demo version you cannot delete this item');
                    return false;
                }
                var element = t.parent().parent();
                var height = element.height();

                $.post('items.php', {
                    'act': '2',
                    'id': id
                }, function (data) {
                    if (data == '1')
                        element.fadeOut(700);
                    else
                        alert('Something went wrong. Please try again');
                });
            }
        });


        // Search
        $('form[name=searchf]').submit(function (evt) {
            evt.preventDefault();
            $('.loader').fadeIn(200);
            var val = $(this).children('input[name=search]').val();

            if (val == '') {
                $('.loader').fadeOut(200);
                alert('Please write your search');
                return false;
            }

            $.post('items.php', {
                'act': '1',
                'val': val
            }, function (data) {
                if (data == '3') {
                    location.href = 'items.php?search=' + encodeURIComponent(val);
                    $('.loader').fadeOut(200);
                    return false;
                }
                if (data == '2') {
                    alert('No items matched your search');
                    $('.loader').fadeOut(200);
                    return false;
                }

                alert('Something went wrong. Please try again');
                $('.loader').fadeOut(200);
                return false;
            });
        });


        // Previous Page
        $('#pagination .prev').click(function () {
            go('prev', $(this).attr('name'));
        });

        // Next page
        $('#pagination .next').click(function () {
            go('next', $(this).attr('name'));
        });

        // Show per page
        $('select[name=show-per-page]').on('change', function () {
            go('show-per-page', this.value);
        });

        // Handler of pagination and show per page
        function go(act, val) {
            var search = urlGet()['search'];
            if (act == 'prev' || act == 'next') {
                var p = val;
                var pp = urlGet()['pp'];
                var url = 'page=' + p;

                if (pp != undefined) url = url + '&pp=' + pp;
            } else if (act == 'show-per-page') {
                var pp = val;
                var page = urlGet()['page'];
                var url = 'pp=' + pp;

                if (page != undefined) url = url + '&page=' + page;
            }

            if (search != undefined) url = url + '&search=' + search;
            location.href = 'items.php?' + url;
        }


        /***************** Functions *******************/
        // Get url GET params
        function urlGet() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
                vars[key] = value;
            });
            return vars;
        }

        // Get width without scrollbar
        function getViewportWidth() {
            document.body.style.overflow = 'hidden';
            var viewportWidth = $(window).width();
            document.body.style.overflow = '';
            return viewportWidth;
        }

        // Map selected checkboxes
        function mapCheckboxes() {
            var mapped = $('input[name=chbox]:checked').map(function () {
                return $(this).val();
            });
            return mapped;
        }
    //});

});


