<!-- // This is a speacial page only made for function_exists -->

<?php

    function getTitle(){
        global $pageTitle;

        if(isset($pageTitle)){
            echo $pageTitle;
        } else {
            echo "AccountSaver - Page";
        }
    }



?>