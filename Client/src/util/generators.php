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

        $html = "<div class = 'row card'>
                    <div class = 'col l4'>
                        <img class='responsive-img' src = /util/itemimage.php?img=".$thumbImgId[0].">
                    </div>
                    <div class = 'col l8'>
                        <div>
                            <h3>".$itemRow['itemName']."</h3>
                        </div>
                    </div>
                </div>";

        return $html;

    }



?>