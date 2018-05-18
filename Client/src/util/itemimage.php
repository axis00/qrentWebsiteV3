<?php

    /**
    *
    *   itemimgae.php
    *
    *   A php file that serves item images from the qrent database
    *
    *   @author David Paul Brackin
    */

    if(isset($_GET['img'])){
        require_once "connectToDb.php";

        $id = $_GET['img'];

        $sql = 'SELECT * FROM qrent.ItemImage WHERE itemimageid = ?';

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("d",$id);
        $stmt->execute();

        $res = $stmt->get_result()->fetch_assoc();

        $extension = strtolower(substr(strrchr($res['imageName'],"."),1));

        $ctype = "image/jpeg";

        switch( $extension ) {
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg":
            case "jpg": $ctype="image/jpeg"; break;
            default:
        }

        $conn->close();

        header('Content-type: ' . $ctype);

        echo $res['imagefile'];

    }

?>