<?php

session_start();
session_unset();
session_destroy();

header("Location:http://localhost/Blog_CMS/index.php");