


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
    <title>SI Inventory - Login</title>

    <link type="text/css" rel="stylesheet" href="css/main.css" media="all" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,600" rel="stylesheet" type="text/css">
    <link rel="icon" href="images/icons/favicon.ico" type="image/x-icon" />

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<div id="center"></div>

<div id="content">
    <div id="logo">
        <img src="../media/img/logo.png" width="225" height="75" alt="Synchronise IT Inventory System" />
    </div>

    <div id="login">
        <div id="error"></div>
        <form method="POST" action="" name="login">
            USERNAME:<br />
            <input type="text" name="username" /><br />
            PASSWORD:<br />
            <input type="password" name="password" /><br />

            <img src="../media/img/loader.gif" id="loader">
            <input type="submit" name="send" value="Login" />
        </form>
    </div>
</div>
</body>
</html>