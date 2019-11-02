<?php
    require_once("../tools.php");

    session_start();
    session_destroy();

    goNow(MAIN_PAGE);
?>