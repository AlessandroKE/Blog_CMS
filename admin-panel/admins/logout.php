<?php

session_start();
session_unset();
session_destroy();

header("location:http://localhost/Blog_CMS/admin-panel/index.php");

