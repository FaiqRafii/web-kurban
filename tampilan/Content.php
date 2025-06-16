<?php

class Content
{
    function getPage()
    {
        return $page = isset($_GET['page']) ? $_GET['page'] : '';
    }

    function loadContent($page)
    {
        if ($page == '') {
            include 'dashboard.php';
        } else {
            include "$page.php";
        }
    }
}
