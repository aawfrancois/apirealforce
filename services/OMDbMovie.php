<?php

class OMDbMovie
{

    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }


    public function getMoviesByTitle(string $title): ?array
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://www.omdbapi.com/?apikey={$this->apiKey}&t={$title}&plot=full");
        var_dump($curl);
        die();

        $data = curl_exec($curl);
        var_dump($data);
        die();

        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        $results = [];
        $data = json_decode($data, true);

        return $data;

    }

    public function getMoviesBySearch(string $search): ?array
    {
        $curl = curl_init("https://www.omdbapi.com/?apikey={$this->apiKey}&s={$search}&plot=full");
        $data = curl_exec($curl);

        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        $results = [];
        $data = json_decode($data, true);

    }
}