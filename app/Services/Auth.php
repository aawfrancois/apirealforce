<?php

namespace App\Services;

class Auth
{
    /**
     * @return array
     */
    function getRequestHeaders(): array
    {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (!str_starts_with($key, 'HTTP_')) {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }

    /**
     * Check if Token value equal date('Ymd')
     *
     * @return bool
     */
    function checkTokenIsValid(): bool
    {
        $isAuthorized = false;

        $headers = $this->getRequestHeaders();

            if (isset($headers['Authorization'])) {
            $authorization = explode(" ", $headers['Authorization']);
            if ($authorization[0] === 'Bearer' && $authorization[1] === date('Ymd')) {
                $isAuthorized = true;
            }
        }

        return $isAuthorized;
    }
}