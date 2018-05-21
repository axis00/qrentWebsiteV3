<?php

    /**
    *
    *   navbar.php
    *
    *   A php file meant to be included in all pages that require a navigation bar.
    *
    *   @author David Paul Brackin
    */

    include_once "/../util/userSession.php";

?>

<nav>
    <div class="nav-wrapper teal darken-3">
        <div class = "container center-align" style = "height: 100%">
            <div class = "row" style = "height: 100%">
                <!-- mobile nav-->
                <a href="#" data-target="mobile-usermenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>


                <div class="col l2 hide-on-med-and-down">
                    <a href="/" class="brand-logo">Qrent</a>
                </div>

                <div class = "col l8 m10 s9" style = "height : 100%">
                    <form action="find.php" method="GET">
                        <div class="input-field" style = "padding: .4rem">
                            <input name = "q" id="search" type="search" autocomplete="off" class = "validate" required>
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                  </form>
                </div>
                <div class = "col l2 hide-on-med-and-down">
                    <ul id="nav-mobile" class="center-align">
                        <li>
                            <?php

                                if(isset($_SESSION['user'])){
                                    echo "  <a class='dropdown-trigger' href='#' data-target='UserDropMenu'>$session_user<i class='material-icons right'>arrow_drop_down</i></a>
                                            <!-- Dropdown for user -->
                                            <ul id='UserDropMenu' class='dropdown-content'>
                                                <li><a href='/profile.php?=$session_user'>Profile</a></li>
                                                <li><a href='/logout.php'>Logout</a></li>
                                            </ul>";
                                }else{
                                    echo "  <a href='/login.php'>Login</a>";
                                }

                            ?>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<script src = "/../scripts/navScript.js"></script>