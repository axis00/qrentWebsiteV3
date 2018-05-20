<?php

    /**
    *   search.php
    *
    *   A collection of functions that generate html modules
    *
    *   @author David Paul Brackin
    */

    include_once "helpers.php";                 

    /**
    *   @param Array $itemRow A row from the Item table that corresponds to the item to be rendered
    *   @return String Html markup that represents the item (materialize card)
    */
    function generateItemCard($itemRow){

    }

    /**
    *   @param Array $itemRow A row from the Item table that corresponds to the item to be rendered
    *   @return String Html markup that represents the item for the search result
    */
    function generateItemSearchResult($itemRow){

        $thumbImgId = getItemImgIDs($itemRow['itemno']);

        $html = "<div class = 'card card-panel horizontal hoverable row'>
                    <div class = 'col l4' style = 'overflow: hidden; max-height: 10rem'>
                        <img class='searchres-img' src = /util/itemimage.php?img=".$thumbImgId[0].">
                    </div>
                    <div class = 'col l8'>
                        <div>
                            <h3>".$itemRow['itemName']."</h3>
                            <a><h5>".$itemRow['itemOwner']."</h5></a>
                            <div class = 'right-align'>
                                <a href='/itemview.php?q=".$itemRow['itemno']."''><button class = 'waves-effect waves-light btn'>View</button><a>
                            </div>
                        </div>
                    </div>
                </div>";

        return $html;

    }



?>