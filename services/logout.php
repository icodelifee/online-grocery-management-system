<?php
    /* 
     * session_start();
     * Starting a new session before clearing it
     * assures you all $_SESSION vars are cleared 
     * correctly, but it's not strictly necessary.
     */
    session_start();
    session_destroy();
    session_unset();
    echo "true";
    exit();
    /* Or whatever document you want to show afterwards */
?>