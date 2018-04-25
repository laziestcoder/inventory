$(document).ready(function () {
    //$('form').attr('autocomplete', 'off');
    //$(document).attr('cache','false');


    $('form[name=new-user]').submit(function (evt) {
        evt.preventDefault();

        var name = $('input[name=nuser-name]').val();
        var username = $('input[name=nuser-user]').val();
        var password = $('input[name=nuser-pass]').val();
        var password2 = $('input[name=nuser-passr]').val();
        var email = $('input[name=nuser-email]').val();
        var role = $('select[name=nuser-role]').val();

        // Validate email
        var rgpx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        // Empty Inputs
        if (name == '') {
            alert('Please insert a name');
            return false;
        } else if (username == '') {
            alert('Please insert a username');
            return false;
        } else if (password == '') {
            alert('Please insert a password');
            return false;
        } else if (password2 == '') {
            alert('Please insert the password confirmation');
            return false;
        } else if (email == '') {
            alert('Please insert an email');
            return false;
        } else if (password != password2) {
            alert('Passwords don\'t match');
            return false;
        } else if (rgpx.test(email) == false) {
            alert('Please insert a valid email');
            return false;
        } else if (password.length < 8) {
            alert('Password must be at least 8 characters long');
            return false;
        }

        $.post('../checks/newUser.php', {
            'act': '1',
            'name': name,
            'username': username,
            'password': password,
            'email': email,
            'role': role,
            'Request_Method': 'POST'
        }, function (data) {
            if (data == 1) {
                alert('Username Exists!');
                return false;
            } else if (data == 2) {
                alert('Email Id Exists!');
                return false;
            } else if (data == 3) {
                alert('New User Added!');
                $('form[name=new-user]')[0].reset();
                return false;
            } else {
                alert('Contact With Administrator Immediately!' + data);
                //document.getElementById("newUser").reset();
                return false;
            }
        });
    });

    // Delete user
    $('a[name=c5]').click(function (evt) {
        evt.preventDefault();

        alert('Sorry. In the demo version you cannot delete users');
    });

    // Search
    $('form[name=searchf]').submit(function (evt) {
        evt.preventDefault();
        $('.loader').fadeIn(200);
        var val = $(this).children('input[name=search]').val();

        if (val == '') {
            alert('Please write your search');
            $('.loader').fadeOut(200);
            return false;
        }

        $.post('index.php', {
            'act': '1',
            'val': val
        }, function (data) {
            if (data == '3') {
                location.href = 'index.php?search=' + encodeURIComponent(val);
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

    //Item Data Show

    $('#userData').ready(function () {
        $.ajax({
            url: "../checks/userData.php",
            dataType: "text",
            success: function (data) {
                $('#userData').html(data);
            },
            error: function () {
                $('#userData').html('Data Parsing Error! =>' + data);
            }
        });
    });

    $('tr[data-type=element] td[data-type=id], tr[data-type=element] td[data-type=name], tr[data-type=element] td[data-type=username], tr[data-type=element] td[data-type=email], tr[data-type=element] td[data-type=role], tr[data-type=element] td[data-type=date]').click(function () {
        var user = $(this).parent().data('id');
        location.href = 'index.php?id=' + user;
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

        location.href = 'index.php?' + url;
    }

    // Get url GET params
    function urlGet() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
            vars[key] = value;
        });
        return vars;
    }



    /*//check user availability

    $('#username').blur(function(){
        var username = $(this).val();
        $.ajax({
            url:"check/checkuser.php",
            method:"POST",
            data: {username:username},
            dataType: "text",

            success: function (data){
                $('#userstatus').html(data);
            }
        });
    });




    // Autocomple Textbox
    $('#skill').keyup(function(){
        var skill = $(this).val();
        if(skill!= ''){
            $.ajax({
                url:"check/checkskill.php",
                method:"POST",
                data: {skill:skill},

                success: function (data){
                    $('#skillstatus').fadeIn();
                    $('#skillstatus').html(data);
                }
            });
        }
    });

    $(document).on('click', 'li', function(){
        $("#skill").val($(this).text());
        $('#skillstatus').fadeOut();
    });


    //show password button

    $("#showpass").on('click', function(){
        var pass = $("#password");
        var fieldtype = pass.attr('type');
        if(fieldtype=="password"){
            pass.attr('type','text');
            $(this).text("Hide Password");

        }else{
            pass.attr('type','password');
            $(this).text("Show Password");
        }
    });


    //Auto refresh Div Content
    $('#autosubmit').click(function(){
        var content = $("#body").val();
        if($.trim(content)!= ''){
            $.ajax({
                url:"check/checkrefresh.php",
                method:"POST",
                data: {body:content},
                dataType: "text",
                success: function (data){
                    $("#body").val("");
                }
            });
            return false;
        }
    });

    setInterval(function(){
        $("#refreshstatus").load('check/getrefresh.php').fadeIn("slow");


    },0);// 1000 or 0 is refresh rate or interval in mili second


    //Live Data Search
    $('#liveSearch').keyup(function(){
        var searchData = $(this).val();
        if(searchData != ''){
            $.ajax({
                url:'check/checkSearch.php',
                method:"POST",
                data:{searchLive:searchData},
                dataType:"text",
                success: function(data){
                    $('#searchStatus').html(data);

                }
            });
        }else{
            $('#searchStatus').html("");

        }

    });

    //Auto Data Save

    $('#content').keyup( function(){
        var content =  $("#content").val();
        var contentid =  $("#contentid").val();

        if(content != ''){
            $.ajax({
                url:'check/checkAutoSave.php',
                method:"POST",
                data:{contentName:content, contentId:contentid},
                dataType:"text",
                success: function(data){
                    if(data){
                        $("#contentid").val(data);
                    }

                    $('#contentStatus').text("Data Save Automatically...");
                    setInterval(function(){
                        $('#contentStatus').text("");
                    },2000);
                }
            });
        }
    }); */

});  