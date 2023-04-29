<?php
class App_Cookie {

    /**
     * Package App_Cookie
     * Author Arindam
     * Version 1.0
     */

    /**
     *
     * @var App_Cookie
     */
    protected static $_instance = null;

    /**
     * Singleton instance makes this redundant
     */
    protected function __construct(){}

    /**
     * Retrieve an instance of the class.
     * @return App_Cookie
     */
    public static function getInstance()
    {
        if (self::$_instance == null)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Send a cookie
     * @link http://www.php.net/manual/en/function.setcookie.php
     * @param name string <p>
     * The name of the cookie.
     * @return bool If output exists prior to calling this function,
     * setcookie will fail and return false. If
     * setcookie successfully runs, it will return true.
     * This does not indicate whether the user accepted the cookie.
     */
    public function setCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null)
    {
        $set = setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        return $set;
    }

    /**
     * Retrieve a cookie by name
     * @param string $name
     * @return string|boolean false for failure
     */
    public function getCookie($name)
    {
        if (isset($_COOKIE) && is_array($_COOKIE) && array_key_exists($name, $_COOKIE))
        {
            return $_COOKIE[$name];
        }
        return false;
    }

    /**
     * Unset a cookie by name
     * @param string $name
     * @return boolean
     */
    public function unsetCookie($name)
    {
        if ($this->getCookie($name) != false)
        {
            setcookie($name, "", time() - 3600);
            return true;
        }
        return false;
    }
    /**
     * Unset  All cookies at once
     * @return boolean true value
     * 
     * 
     */
    
    public function destroryAllCookies(){
        $ex_val = time() - 3600;
        foreach($_COOKIE as $key => $value){
            setcookie($key,$value,$ex_val,'/');
        }
        return true;
    }

}

/**
 * @Examples
 * Setcookie App_Cookie::getInstance()->setCookie("LastVisit","2012/01/01");
 * GetCookie App_Cookie::getInstance()->getCookie("LastVisit")
 * RemoveCookie App_Cookie::getInstance()->unsetCookie("LastVisit");
 * 
 */
