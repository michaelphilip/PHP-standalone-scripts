<?php
/**
 * Class CookieTrait
 *
 * @author    Michael <resourcemode@yahoo.com>
 */

namespace App\Traits;

/**
 * Class CookieTraits
 *
 */
trait CookieTraits
{

    /**
     * Cookie name default key
     *
     * @var string
     */
    protected $keyName = 'cookie_enable';

    /**
     * Default time is in seconds
     *
     * @var int
     */
    protected $defaultTime = 3600;

    /**
     * Set the cookie expiration time
     *
     * @param null $time
     * @return int
     */
    protected function setDefaultTime($time = null)
    {
        if (empty($time)) {
            return time() + $this->defaultTime;
        }

        return time() + $time;
    }

    /**
     * Create a cookie or cupcake
     *
     * @param $keyName
     * @param $value
     * @return boolean
     */
    public function createCookie($keyName = null, $value)
    {
        if (null === $keyName) {
            $keyName = $this->keyName;
        }

        return setcookie($keyName, $value, $this->setDefaultTime());
    }

    /**
     * Destroy the cookie by given name
     *
     * @param null $keyName
     * @return bool
     */
    public function destroyCookieByName($keyName = null)
    {
        if (null === $keyName) {
            $keyName = $this->keyName;
        }

        if(isset($_COOKIE[$keyName])) {
            unset($_COOKIE[$keyName]);
            return true;
        }

        return false;
    }

    /**
     * Get cookie by name
     *
     * @param $keyName
     * @return bool|string|array|object
     */
    public function getCookieByName($keyName)
    {
        if (isset($_COOKIE[$keyName])) {
            return $_COOKIE[$keyName];
        }

        return false;
    }

    /**
     * Check whether we are able to create a cookie
     *
     * @return bool
     */
    public function isCookieEnabled()
    {
        // create a cookie with a value of true
        $this->createCookie(null, true);

        if (false === $this->getCookieByName($this->keyName)) {
            return false;
        }

        return true;
    }
}
