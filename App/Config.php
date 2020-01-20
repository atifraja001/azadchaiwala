<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{
    /**
     * application email
     * @var string,email
     */
    const EMAIL = 'admin@azadchaiwala.pk';

    /**
     * Admin Path to access admin area
     * @var string
     */
    const ADMIN_PATH = "azad-admin";

    /**
     * set app url to if public folder not in public_html
     * if project public folder is available in public_html comment first line and uncomment second.
     * @var string
     */
    const APP_URL = "http://localhost/dropbox/azadchaiwala_git/azadchaiwala.pk/public"; // if public is files in sub folder. set this.
    //const APP_URL = ""; // if public files are in public_html

    /**
     * No changes reburied
     */
    const ADMIN_URL = self::APP_URL."/".self::ADMIN_PATH;


    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'azadchaiwala_new';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'password';

    /**
     * Show or hide error messages on screen\
     * true will show errors.
     * false will display 404 page and logs errors in logs folder(optional)
     * @var boolean
     */
    const SHOW_ERRORS = true;

}
