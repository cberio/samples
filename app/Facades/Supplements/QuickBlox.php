<?php

namespace App\Facades\Supplements;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

class QuickBlox
{
    public const API_URL             = 'https://api.quickblox.com';
    public const CHAT_URL            = 'https://chat.quickblox.com';

    private const AUTHENTICATION     = '/session.json'; // POST
    private const REGISTRATION       = '/users.json'; // POST
    private const RETRIEVE_USERS     = '/users.json'; // GET
    private const USER_DETAILS       = '/users/'; // GET
    private const UPDATE_USER_DETAIL = '/users/'; // POST

    private const ROOM_LIST          = '/chat/Dialog.json'; // GET

    private const MESSAGE_LIST       = '/chat/Message.json'; // GET
    private const CREATE_MESSAGE     = '/chat/Message.json'; // POST

    private $token;
    private $client;

    public function getToken()
    {
        return $this->token;
    }

    public function __construct()
    {
        $this->client = new Client([
            'base_uri'    => QuickBlox::API_URL,
            'http_errors' => false, // ignore http error status code
        ]);

        $this->token = $this->createApplicationToken();
    }

    private function createApplicationToken()
    {
        $data = [
            'application_id' => env('QUICKBLOX_APP_ID'),
            'auth_key'       => env('QUICKBLOX_AUTH_KEY'),
            'nonce'          => mt_rand(1, 9999),
            'timestamp'      => time(),
        ];

        $signature = $this->generateSignature($data);

        data_set($data, 'signature', $signature);

        $response = $this->request(
            'POST',
            self::AUTHENTICATION,
            [
                'QuickBlox-REST-API-Version' => '0.1.0',
            ],
            $data
        );

        if ($response && !optional($response)->errors) {
            return $response->session->token;
        }

        return null;
    }

    private function createUserToken($user = [])
    {
        $login    = data_get($user, 'login');
        $password = data_get($user, 'password');

        $data     = [
            'application_id' => env('QUICKBLOX_APP_ID'),
            'auth_key'       => env('QUICKBLOX_AUTH_KEY'),
            'nonce'          => mt_rand(1, 9999),
            'timestamp'      => time(),
            'user'           => [
                'login'    => $login,
                'password' => $password,
            ]
        ];

        $signature = $this->generateSignature($data);

        data_set($data, 'signature', $signature);

        $response = $this->request(
            'POST',
            self::AUTHENTICATION,
            [
                'QuickBlox-REST-API-Version' => '0.1.0',
            ],
            $data
        );

        if ($response && !property_exists($response, 'errors')) {
            return $response->session->token;
        }

        return null;
    }

    private function generateSignature($data = [])
    {
        $queryString = urldecode(http_build_query($data));

        return hash_hmac('sha1', $queryString, env('QUICKBLOX_AUTH_SECRET'));
    }

    private function request($method, $address, $headers, $parameters)
    {
        try {
            $options = [
                'headers' => $headers,
                'json'    => $parameters,
                'query'   => $parameters,
            ];

            if ($method !== 'GET') {
                array_forget($options, 'query');
            }

            $response = $this->client->request($method, $address, $options);
        } catch (GuzzleException $e) {
        } catch (\Exception $e) {
        } finally {
            logger($response->getBody());
        }

        $statusCode = $response->getStatusCode();

        if ($statusCode >= Response::HTTP_OK && $statusCode < Response::HTTP_INTERNAL_SERVER_ERROR) {
            return json_decode($response->getBody());
        }

        return null;
    }

    public function createUser($data = [])
    {
        $login       = data_get($data, 'login');
        $password    = data_get($data, 'password');
        $blobId      = data_get($data, 'blob_id');
        $externalId  = data_get($data, 'external_id');
        $facebookId  = data_get($data, 'facebook_8id');
        $twitterId   = data_get($data, 'twitter_id');
        $fullName    = data_get($data, 'full_name');
        $phoneNumber = data_get($data, 'phone');
        $customData  = data_get($data, 'custom_data');
        $userTags    = data_get($data, 'tag_list');

        return $this->request(
            'POST',
            self::REGISTRATION,
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $this->getToken(),
            ],
            [
                'user' => $data,
            ]
        );
    }

    public function retrieveUsers($data = [])
    {
        $page    = data_get($data, 'page', 1);
        $perPage = data_get($data, 'per_page', 15);

        return $this->request(
            'GET',
            self::RETRIEVE_USERS,
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $this->getToken(),
            ],
            [
                'page'     => $page,
                'per_page' => $perPage,
                'order'    => 'desc+id',
            ]
        );
    }

    public function setUserDetails($data = [])
    {
        $id           = data_get($data, 'id');
        $login        = data_get($data, 'login');
        $loginChanged = data_get($data, 'login_changed');
        $password     = data_get($data, 'password');
        $blobId       = data_get($data, 'blob_id');
        $externalId   = data_get($data, 'external_id');
        $facebookId   = data_get($data, 'facebook_8id');
        $twitterId    = data_get($data, 'twitter_id');
        $fullName     = data_get($data, 'full_name');
        $phoneNumber  = data_get($data, 'phone');
        $customData   = data_get($data, 'custom_data');
        $tagList      = data_get($data, 'tag_list');

        $token        = $this->createUserToken([
            'login'    => $login,
            'password' => '00000000',
        ]);

        if (blank($token)) {
            return null;
        }

        return $this->request(
            'PUT',
            self::UPDATE_USER_DETAIL."$id.json",
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $token,
            ],
            [
                'user' => [
                    'login'       => $loginChanged,
                    'external_id' => $externalId,
                    'full_name'   => $fullName,
                    'phone'       => $phoneNumber,
                    'custom_data' => $customData,
                    'tag_list'    => $tagList,
                ],
            ]
        );
    }

    public function getUserDetails($data = [])
    {
        $id = data_get($data, 'id');

        return $this->request(
            'GET',
            self::USER_DETAILS."$id.json",
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $this->getToken(),
            ],
            []
        );
    }

    public function getParticipatingRooms($data = [])
    {
        $login    = data_get($data, 'login');
        $password = data_get($data, 'password');
        $token    = $this->createUserToken([
            'login'    => $login,
            'password' => '00000000',
        ]);

        return $this->request(
            'GET',
            self::ROOM_LIST,
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $token,
            ],
            [
                $data
            ]
        );
    }

    public function retrieveMessages($data = [])
    {
        $login    = data_get($data, 'login');
        $password = data_get($data, 'password');
        $dialogId = data_get($data, 'chat_dialog_id');
        $token    = $this->createUserToken([
            'login'    => $login,
            'password' => '00000000',
        ]);

        return $this->request(
            'GET',
            self::MESSAGE_LIST,
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $token,
            ],
            [
                'chat_dialog_id' => $dialogId
            ]
        );
    }

    public function sendMessage($data = [])
    {
        $login    = data_get($data, 'login');
        $password = data_get($data, 'password');
        $dialogId = data_get($data, 'chat_dialog_id');
        $message  = data_get($data, 'message');
        $token    = $this->createUserToken([
            'login'    => $login,
            'password' => '00000000',
        ]);

        return $this->request(
            'POST',
            self::CREATE_MESSAGE,
            [
                'Content-Type'               => 'application/json',
                'QuickBlox-REST-API-Version' => '0.1.0',
                'QB-Token'                   => $token,
            ],
            [
                'chat_dialog_id' => $dialogId,
                'message'        => $message,
                'send_to_chat'   => 1,
                'name'           => $login,
            ]
        );
    }
}
