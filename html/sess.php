<?php
    @session_start();
    $DS = DIRECTORY_SEPARATOR;
    require_once dirname(dirname(__FILE__)) . $DS . 'base' . $DS . 'config.php';
    define('PATH_ROOT',			dirname(__FILE__));
    define('PATH_INC',			PATH_ROOT . '/include');
	define('PATH_CLAS',			PATH_ROOT . '/classes');

    require_once PATH_INC . '/autoload.php';
    $DB = new connect_db();

 	if(!$DB->valid()) {
        echo "<h1>Ошибка подключения к БД</h1><h2>{$DB->error}</h2><pre>";
        print_r($DB->errInfo);
        die("</pre>");
    }

    $infoPrefix = '';

    function InfoPrefix($txt, $add = '') {
        global $infoPrefix;
        $t = $txt;
        if(strpos($txt, '.') !== FALSE) {
            $t = basename($txt, '.php');
        }
        $infoPrefix = "{$t}{$add}: ";
    }

    function Info($txt, $suffix = PHP_EOL) {
        global $infoPrefix;
        $out = $infoPrefix . $txt;
        syslog(LOG_WARNING, $out);
        echo $out . $suffix;
    }