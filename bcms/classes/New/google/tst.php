<?php
    include("clsGoogleSearch.php");
    $search=new clsGoogleSearch();
    $ret_arr=$search->GetSearchQuery("php manual");
    print_r($ret_arr);

?>