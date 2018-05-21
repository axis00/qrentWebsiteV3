 <?php
    include_once "util/connectToDb.php";
    include_once "util/session.php";
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <!--Icons-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="styles/profile.css" />

        <title>Qrent</title>
    </head>

    <body>

        <?php
            $userQuery = $_GET['user'];
            $sessionSql = mysqli_query($conn, "SELECT CONCAT(firstname, ', ', lastname) AS name, username, firstname, lastname, CONCAT(addressno, ' ', street,' ', municipality,' ', province) AS address, contactno, email FROM users NATURAL JOIN customers where username = '$userQuery';");
            $row = mysqli_fetch_array($sessionSql, MYSQLI_ASSOC);
            $session_user = $row['name'];
            $session_username = $row['username'];
            $session_first = $row['firstname'];
            $session_last = $row['lastname'];
            $session_address = $row['address'];
            $session_contact = $row['contactno'];
            $session_email = $row['email'];
        ?>
        
        <?php include 'modules/navbar.php';
        ?>
        
        <div class="container">
            <div class="row">
                <div class="col s3">
                    <div class="profile-picture">
                        <img class="avatar" width="230" height="230" />
                    </div>
                    <div class="names">
                        <?php
                        echo "<span class='fullname d-block'>$session_first $session_last</span>";
                        echo "<span class='username d-block'>$session_username</span>"
                    ?>
                    </div>
                    <?php
                        if($_SESSION['user'] == $_GET['user']) {
                            echo "<a class='waves-effect waves-light btn' href='/editProfile'>Edit Profile</a>";
                        }
                    ?>
                    <div class="divider"></div>
                    <ul class="details">
                        <li>
                            <i class="material-icons">location_on</i>
                            <?php 
                                echo "<span class='label'>$session_address</span>";
                            ?>
                        </li>
                        <li>
                            <i class="material-icons">contact_phone</i>
                            <?php 
                                echo "<span class='label'>$session_contact</span>";
                            ?>
                        </li>
                    </ul>
                </div>
                <div class="col s9">
                    <p>Stuff goes here</p>
                </div>
            </div>
        </div>
    </body>

    </html>
