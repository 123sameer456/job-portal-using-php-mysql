<?php
session_start();
session_unset();
session_destroy();


echo "<script>window.location.replace('http://localhost/jobboard');</script>" ;
// header("location : "  . APPURL  . " ");
exit ;

?>