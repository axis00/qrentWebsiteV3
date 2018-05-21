<!DOCTYPE html>
<html>
<head>
	<title>Navigation Bar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
</head>
<body>
    
    
    <nav class="teal">
        <div class="nav-wrapper">
            <a class="brand-logo" id="home" href="../pages/home.php">Qrent</a>
            <ul class="right">
                <li><a href="../pages/profile.php"><?php echo "$session_user";?></a></li>
                <li><a href="../util/logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    
</body>
</html>