<?php

namespace App\Services;

class OMDbMovie
{
    const API_URL = 'https://www.omdbapi.com/';
    const API_KEY = 'd744f309';

    /**
     * @param string $search
     * @param int|null $page
     * @return array|null
     */
    public function search(string $search, ?int $page = null): ?array
    {
        $params = [
            's' => $search,
            'page' => $page ? $page : 1
        ];

        return $this->callGet($params);
    }

    /**
     * @param string $id
     * @return array|null
     */
    public function getMoviesById(string $id): ?array
    {
        $params = [
            'i' => $id
        ];

        return $this->callGet($params);
    }

    /**
     * @param array $params
     * @return array
     */
    private function callGet(array $params): array
    {
        try {
            $params['apikey'] = self::API_KEY;

            $queryString = http_build_query($params);

            $url = self::API_URL . '?' . $queryString;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $content = curl_exec($ch);

            if ($content === false) {
                throw new \Exception(curl_error($ch), curl_errno($ch));
            }

            return json_decode($content, true);
        } catch (\Exception $e) {
            trigger_error(
                sprintf('Curl failed with error #%d: %s', $e->getCode(), $e->getMessage()),
                E_USER_ERROR
            );
        } finally {
            curl_close($ch);
        }
    }
}