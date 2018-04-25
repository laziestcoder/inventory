$(document).ready(function () {


    // edit user

    var roleid = $('select[name=euser-role]').data('id');
    //alert(roleid);
    $('select[name=euser-role]').ready(function () {
        $('option[value=' + roleid + ']').attr('selected', true);
    });

    $('form[name=edit-user]').submit(function (evt) {
        evt.preventDefault();


        var userid = $(this).data('id');
        var name = $('input[name=euser-name]').val();
        var email = $('input[name=euser-email]').val();
        var role = $('select[name=euser-role]').val();

        // Validate email
        var rgpx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        // Empty Inputs
        if (name == '') {
            alert('Please insert a name');
            return false;
        } else if (email == '') {
            alert('Please insert an email');
            return false;
        } else if (rgpx.test(email) == false) {
            alert('Please insert a valid email');
            return false;
        }
        //alert(role);

        $.post('../checks/newUser.php', {
            'act': 'edit',
            'name': name,
            'email': email,
            'role': role,
            'userid': userid,
            'Request_Method': 'POST'
        }, function (data) {
            if (data == 1) {
                alert('Data Saved Successfully! ');
                window.location.reload();
                return false;
            } else if (data == 2) {
                alert('Inform the Administrator Immediately! ');
                return false;
            } else {
                alert('Error =->' + data);
                return false;
            }
        });
    });
});