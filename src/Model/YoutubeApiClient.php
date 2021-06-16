<?php


namespace App\Model;


use Google_Client;
use Google_Service_YouTube;

class YoutubeApiClient
{

    public function fetchTrainingVideo()
    {

        /**
         * Sample PHP code for youtube.search.list
         * See instructions for running these code samples locally:
         * https://developers.google.com/explorer-help/guides/code_samples#php
         */

        $client = new Google_Client();
        $client->setApplicationName('API code samples');
        $client->setScopes([
            'https://www.googleapis.com/auth/youtube.force-ssl',
        ]);

// TODO: For this request to work, you must replace
//       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
//       client_secret.json file. For more information, see
//       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
        $client->setAuthConfig('YOUR_CLIENT_SECRET_FILE.json');
        $client->setAccessType('offline');

// Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        printf("Open this link in your browser:\n%s\n", $authUrl);
        print('Enter verification code: ');
        $authCode = trim(fgets(STDIN));

// Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);

// Define service object for making API requests.
        $service = new Google_Service_YouTube($client);

        $queryParams = [
            'maxResults' => 1,
            'q' => 'how to make a blue margarita cocktail'
        ];

        $response = $service->search->listSearch('', $queryParams);
        print_r($response);


    }


}
