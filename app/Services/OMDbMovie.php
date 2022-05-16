<?php

namespace App\Services;

class OMDbMovie
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $search
     * @param $page
     * @return array|null
     * @throws \Exception
     */
    public function getMoviesBySearch(string $search, $page = null): ?array
    {
        try {
            $ch = curl_init();

            if ($page !== null) {
                curl_setopt($ch, CURLOPT_URL, 'https://www.omdbapi.com/?apikey=' . $this->apiKey . '&s=' . $search . '&page=' . $page);
            } else {
                curl_setopt($ch, CURLOPT_URL, 'https://www.omdbapi.com/?apikey=' . $this->apiKey . '&s=' . $search);
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $content = curl_exec($ch);

            if ($content === false) {
                throw new \Exception(curl_error($ch), curl_errno($ch));
            }

            $data = json_decode($content, true);

        } catch (\Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        } finally {
            curl_close($ch);
        }

        return $data;

    }

    /**
     * @param string $id
     * @return array|null
     */
    public function getMoviesById(string $id): ?array
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://www.omdbapi.com/?apikey=' . $this->apiKey . '&i=' . $id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $content = curl_exec($ch);

            if ($content === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            $data = json_decode($content, true);

        } catch (Exception $e) {

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