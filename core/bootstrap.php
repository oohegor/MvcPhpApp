<?php

define('ENV', parse_ini_file('../.env'));

// Code we want to run on every page/script
date_default_timezone_set('UTC');
error_reporting(0);
session_set_cookie_params(['samesite' => 'Strict']);
session_start();

require_once '../core/Database.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';
require_once '../core/Router.php';
require_once '../core/CSRFService.php';
require_once '../core/MailService.php';
require_once '../core/SMSService.php';

(new Router())->contentToRender();