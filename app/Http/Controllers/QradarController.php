<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
class QradarController extends Controller
{
    public function getQradarEvents()
    {
        $qradarUrl = config('qradar.url');
        $userId = config('qradar.user_id');
        $authToken = config('qradar.auth_token');
        

        $endpoint = 'events';
        $queryParams = ['filter' => 'status=OPEN', 'limit' => 10];

        $client = new Client([
            'base_uri' => $qradarUrl,
            'headers' => [
                'SEC' => $userId,
                'AUTHORIZATION' => 'Bearer ' . $authToken
            ]
        ]);

        try {
            $response = $client->get($endpoint, [
                'query' => $queryParams
            ]);

            $data = json_decode($response->getBody(), true);

            // Faites quelque chose avec les données retournées par Qradar

        } catch (RequestException $e) {
            // Gestion des erreurs de requête
            echo 'Erreur lors de la requête à l\'API Qradar: ' . $e->getMessage();
        }
    }

}
