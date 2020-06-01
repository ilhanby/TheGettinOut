<?php
require_once "src/_config.php";
require_once "src/_global.php";
require_once "src/_db.php";
require_once "src/service.php";

dispatch(substr($_SERVER['REQUEST_URI'], strlen('')));


