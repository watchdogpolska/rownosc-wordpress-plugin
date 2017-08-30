<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 06.07.17
 * Time: 00:04
 */
namespace Rownosc;

class Install{

    function __construct()
    {

    }

    function init(){
        register_activation_hook(__FILE__, array( __CLASS__, 'onInstall' ) );
        register_uninstall_hook(__FILE__, array( __CLASS__, 'onUninstall' ) );
    }

    static function onInstall() {
        flush_rewrite_rules();
    }

    static function onUninstall() {
        flush_rewrite_rules();
    }

}