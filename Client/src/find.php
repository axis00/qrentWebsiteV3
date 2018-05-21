<?php

    /**
    *   find.php
    *
    *   Displays the search results of the query
    *
    *   @author David Paul Brackin
    */

    include_once "util/connectToDb.php";
    include_once "util/search.php";
    include_once "util/generators.php";

    if(isset($_GET['q'])){

        $url = "/find.php?q=".$_GET['q'];

        $cond = "";
        $page = 0;
        $pageCount = 10;

        if(isset($_GET['page'])){
            $page = $_GET['page'];
            $cond .= "Limit " . (($page-1) * 10) . "," . $pageCount;
        }

        $items = searchForItems($_GET['q'],$cond);

    }else{
        header("Location: /");
        die();
    }
    
?>

<!DOCTYPE html>
<html>

    <head>
        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
            crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <!--Custom Css-->
        <link href="styles/search.css" rel="stylesheet">
        <link href="styles/style.css" rel="stylesheet">

    </head>

    <body>
        <?php 
            include_once "modules/navbar.php";
        ?>

        <div class = "container">
            <div class = "row">
                <div col = "col l12 m12 s12">
                    <?php
                        echo '<h3>Search Results for "'.$_GET['q'].'"'
                    ?>
                </div>
            </div>
            <div class = "row">
                <div class = "col l3">
                    <div class = "card card-panel">
                        <div class = "card-title">Filter</div>
                        <div>
                            <form action="find" method="GET">
                                <input type = "hidden" name ="q" value = <?php echo $_GET['q']?> >
                                <label>
                                    <input name="Available" id="indeterminate-checkbox" type="checkbox" />
                                    <span>Available</span>
                                </label>
                                <div class="center-align filter-submit-cont">
                                    <input type = "submit" value = "Apply" class="btn waves-effect waves-light">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class = "col l9">

                <?php

                    foreach ($items as $i) {
                        echo generateItemSearchResult($i);
                    }

                ?>

                </div>
            </div>
            <!--page nav-->
            <div class = "row center-align page-nav">
                <div class="col" style = "float: none">
                    <?php
                        if($page <= 1){
                            echo '<a><i class="material-icons">navigate_before</i>Prev</a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page - 1).'><i class="material-icons">navigate_before</i>Prev</a>';
                        }

                        if(count($items) < $pageCount){
                            echo '<a>Next<i class="material-icons">navigate_next</i></a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page + 1).'>Next<i class="material-icons">navigate_next</i></a>';
                        }

                    ?>
                </div>
            </div>

        </div>

    </body>

</html>

