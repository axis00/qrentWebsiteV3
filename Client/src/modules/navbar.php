<?php

    include_once "/../util/userSession.php";

?>

<nav>
    <div class="nav-wrapper teal darken-3">
        <div class = "container center-align" style = "height: 100%">
            <div class = "row" style = "height: 100%">
                <!-- mobile nav-->
                <a href="#" data-target="mobile-usermenu" class="sidenav-trigger"><i class="material-icons">menu</i></a>


                <div class="col l2 hide-on-med-and-down">
                    <a href="#" class="brand-logo">Qrent</a>
                </div>

                <div class = "col l6 m8 s9" style = "height : 100%">
                    <form>
                        <div class="input-field" style = "padding: .4rem">
                            <input id="search" type="search" autocomplete="off" required>
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                  </form>
                </div>
                <div class = "col l4 hide-on-med-and-down">
                    <ul id="nav-mobile" class="center-align">
                        <li>
                            <?php

                                if(true){
                                    echo "  <a class='dropdown-trigger' href='#' data-target='UserDropMenu'>User<i class='material-icons right'>arrow_drop_down</i></a>
                                            <!-- Dropdown for user -->
                                            <ul id='UserDropMenu' class='dropdown-content'>
                                                <li><a href='/profile.php?=$user'>Profile</a></li>
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

<ul class="sidenav" id="mobile-usermenu">
    <li><a href='/profile.php?=$user'>Profile</a></li>
    <li><a href='/logout.php'>Logout</a></li>
</ul>

<script src = "/../scripts/navScript.js"></script>