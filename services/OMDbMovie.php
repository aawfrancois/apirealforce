<?php

namespace services;

use Exception;

class OMDbMovie
{

    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getMoviesBySearch(string $title): ?array
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://www.omdbapi.com/?apikey='. $this->apiKey .'&s='. $title);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $content = curl_exec($ch);

            if ($content === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            $data = json_decode($content, true);

        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        } finally {
            curl_close($ch);
        }

        return $data;

    }
}