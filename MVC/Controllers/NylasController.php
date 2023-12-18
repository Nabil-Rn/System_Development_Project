<?php

class NylasController
{
    public function fetchNylasData()
    {
        $accessToken = 'PTcBVppDmBLQOqQxIGUFnWXwA4bcAb';
        $url = 'https://api.schedule.nylas.com/manage/pages';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Bearer ' . $accessToken,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            // Successful request, $response contains the JSON data
            echo $response;
        } else {
            // Handle errors or non-200 HTTP status codes
            echo "Failed to retrieve data. HTTP code: $httpCode";
        }

        curl_close($ch);
    }
}
