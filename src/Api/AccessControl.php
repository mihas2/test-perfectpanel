<?php
/**
 * Проверка доступа к методу
 * Варианты @requires: authorized, manager, admin
 */

namespace Api;

use \Luracast\Restler\iAuthenticate;
use \Luracast\Restler\Resources;
use Luracast\Restler\RestException;

class AccessControl implements iAuthenticate
{
    public function __getWWWAuthenticateString()
    {
        return null;
    }

    /**
     * @param string|null $header
     * @return string
     */
    private function getToken(?string $header): string
    {
        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return trim($matches[1]);
        }

        return '';
    }

    public function __isAllowed()
    {
        if ($this->getToken($_SERVER['HTTP_AUTHORIZATION']) === getenv('TOKEN')) {
            return true;
        }

        throw new RestException(403, 'Forbidden');
    }


}
