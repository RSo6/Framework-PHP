<?php

namespace wfm;

use RedBeanPHP\R;

class Db
// This class realize pattern Singleton,
// to wit from this pattern we can create only one object;
{

    use TSingleton;

    // in order to realize Singleton we use function "trait"

    // in order to realize connection we use private construct
    private function __construct()
    {
        // CONFIG point on folder /config
        $db = require_once CONFIG . '/config_db.php';// connection settings
        R::setup($db['dsn'], $db['user'], $db['password']);// we are connected to db,:: розширює область видимості
        // which described in file "/config.db.php", with using method 'setup';
        if (!R::testConnection()) {
            // we verify status of connection,
            // using static method 'testConnection' which return true or false;
            throw new \Exception('Connection to DB is failed', 500);
        }
        R::freeze(true);// we freeze scheme of db;
        if (DEBUG) {
            // debug method: return SQL request;
            // option 'true' - debugging mode on;
            R::debug(true, 3);// 'mode 3' - mute output to the screen;
        }
        R::ext('xdispense', function( $type ){
            return R::getRedBean()->dispense( $type );
        });
    }
}













