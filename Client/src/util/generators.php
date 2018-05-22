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
    *   @param Array $items An array containing query rows that represent a 
    *   @return String Html markup that represents the item showcase
    */
    function generateItemShowCase($items){

        $html = "<div class = 'card'>
                            <div class = 'card-image'>
                                <div class = 'carousel carousel-slider featured-slider'>";
        //generate the carousel items
            foreach($items as $i){
                $imgs = getItemImgIDs($i->num);
                            $html .= "  <a href='/itemview.php?q=".$i->num."' class = 'carousel-item valign-wrapper'>
                                            <img src= /util/itemimage.php?img=".$imgs[0].">
                                            <div class = 'card-title featured-title'><h4>".$i->name."</h4></div>
                                        </a>";           
            }

        $html .=                "</div>
                            </div>
                        </div>";
        return $html;
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
                                <a href='/itemview?q=".$itemRow['itemno']."'><button class = 'waves-effect waves-light btn'>View</button></a>
                            </div>
                        </div>
                    </div>
                </div>";

        return $html;

    }

    /**
    *   @param Array $resRow A row from the reservations table of the database
    *   @return String Html markup that represents the item for the search result
    */
    function generateReservation($resRow){

        $thumbImgId = getItemImgIDs($resRow['itemno']);

        $html = "<div class = 'card card-panel horizontal hoverable row' id = 'res-".$resRow['ReservationID']."'>
                    <div class = 'col l4' style = 'overflow: hidden; max-height: 10rem'>
                        <img class='searchres-img' src = /util/itemimage.php?img=".$thumbImgId[0].">
                    </div>
                    <div class = 'col l8'>
                        <div>
                            <h5>".$resRow['itemName']."</h5>
                            <a><h6>".$resRow['itemOwner']."</h6></a>
                            <h6>".$resRow['diff']." day/s until requested rental date</h6>
                            <div class = 'right-align'>
                                <a href='/itemview?q=".$resRow['itemno']."'><button class = 'waves-effect waves-light btn'>View</button></a>
                                <a class='wave-effect waves-light btn modal-trigger cancel-btn' data-resID ='".$resRow['ReservationID']."' href='#cancel-modal'>Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>";

        return $html;

    }

    /**
    *   @param Array $rentRow A row from the reservations table that coresponds to and on going rental
    *   @return String Html markup that represents a rental
    */
    function generateClientRentals($rentRow){

        $thumbImgId = getItemImgIDs($rentRow['itemno']);

        $html = "<div class = 'card card-panel horizontal hoverable row'>
                    <div class = 'col l4' style = 'overflow: hidden; max-height: 10rem'>
                        <img class='searchres-img' src = /util/itemimage.php?img=".$thumbImgId[0].">
                    </div>
                    <div class = 'col l8'>
                        <div>
                            <h5>".$rentRow['itemName']."</h5>
                            <a><h6>".$rentRow['itemOwner']."</h6></a>";

                            if($rentRow['diff'] > 0){
                                $html .= "<h6>".$rentRow['diff']." days left for this rental</h6>";
                            }else if($rentRow['diff'] == 0){
                                $html .= "<h6 class = 'red-text text-darken-4'>This Item is Due Today</h6>";
                            }else{
                                $html .= "<h6 class = 'red-text text-darken-4'>This Item is Overdue By ".abs($rentRow['diff'])." day/s</h6>";
                            }

                        
                           $html .= "<div class = 'right-align'>
                                <a href='/itemview?q=".$rentRow['itemno']."'><button class = 'waves-effect waves-light btn'>View</button></a>
                                <a class='waves-effect waves-light btn modal-trigger return-btn' data-itemno =".$rentRow['itemno']." href='#return-modal'>Return</a>
                            </div>
                        </div>
                    </div>
                </div>";

        return $html;

    }


?>