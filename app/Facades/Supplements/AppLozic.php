<?php

namespace App\Facades\Supplements;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

class AppLozic
{
    private const BASE_URL              = 'https://apps.applozic.com';

    private const REGISTRATION          = '/rest/ws/register/client'; // POST
    private const USER_DETAIL           = '/rest/ws/user/v2/detail'; // POST
    private const UPDATE_USER_DETAIL    = '/rest/ws/user/update'; // GET
    private const UPDATE_USER_PASSWORD  = '/rest/ws/user/update/password'; // GET

    private const CREATE_ROOM           = '/rest/ws/group/v2/create'; // POST
    private const ROOM_LIST             = '/rest/ws/group/v2/list'; // GET
    private const REMOVE_USER_FROM_ROOM = '/rest/ws/group/remove/users'; // POST
    private const REMOVE_ROOM           = '/rest/ws/group/delete'; // GET

    private const MESSAGE_LIST          = '/rest/ws/message/v2/list'; // GET
    private const CREATE_MESSAGE        = '/rest/ws/message/v2/send'; // POST

    private $token;
    private $client;

    private $userId;

    public function __construct($token)
    {
        $this->client = new Client([
            'base_uri'    => self::BASE_URL,
            'http_errors' => false, // ignore http error status code
        ]);
        $this->token  = $token;
    }

    /**
     * @param mixed $userId
     *
     * @return AppLozic
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function createUser($data = [])
    {
        return $this->request(
            'POST',
            self::REGISTRATION,
            [],
            $data
        );
    }

    /**
     * Handle Http Request
     *
     * @param $method
     * @param $address
     * @param $parameter
     *
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     */
    private function request($method, $address, $headers, $parameters)
    {
        try {
            $options = [
                'headers' => $headers,
                'json'    => $parameters,
                'auth'    => ['ben', '000000'],
                'query'   => $parameters,
            ];

            if ($method !== 'GET') {
                array_forget($options, 'query');
            }

            $response = $this->client->request($method, $address, $options);
        } catch (GuzzleException $e) {
            logger($e);
        } catch (\Exception $e) {
            logger($e);
        }

        if ($response->getStatusCode() === Response::HTTP_OK) {
            return json_decode($response->getBody());
        }

        logger('body'. $response->getBody());

        return null;
    }

    public function getUserDetails($data = [])
    {
        return $this->request(
            'POST',
            self::USER_DETAIL,
            [
                'Application-Key' => env('APP_LOZIC_ID'),
            ],
            $data
        );
    }

    public function setUserDetail($data = [])
    {
        $userId = data_get($data, 'id');

        if ($userId) {
            return $this->request(
                'POST',
                self::UPDATE_USER_DETAIL,
                [
                    'Application-Key' => env('APP_LOZIC_ID'),
                    'Of-User-Id'      => $userId,
                ],
                $data
            );
        }

        return null;
    }

    public function getParticipatingRooms($data = [])
    {
        $userId = data_get($data, 'id');

        return $this->request(
            'GET',
            self::ROOM_LIST,
            [
                'Application-Key' => env('APP_LOZIC_ID'),
                'Of-User-Id'      => $userId,
            ],
            $data
        );
    }

    public function createRoom($data = [])
    {
        $groupName = data_get($data, 'group_name');
        $userIds   = data_get($data, 'id');

        if (blank($groupName) || blank($userIds)) {
            return null;
        }

        return $this->request(
            'POST',
            self::CREATE_ROOM,
            [
                'Application-Key' => env('APP_LOZIC_ID'),
            ],
            [
                'groupName'       => $groupName,
                'groupMemberList' => $userIds,
                'type'            => 2,
            ]
        );
    }

    public function updateRoom($data = [])
    {
        //
    }

    public function removeUserFromRoom($data = [])
    {
        $groupId = data_get($data, 'group_id');
        $userId  = data_get($data, 'user_id');

        if (blank($groupId) || blank($userId)) {
            return null;
        }

        return $this->request(
            'POST',
            self::REMOVE_USER_FROM_ROOM,
            [
                'Application-Key' => env('APP_LOZIC_ID'),
            ],
            [
                'clientGroupIds' => $groupId,
                'userIds'        => $userId,
            ]
        );
    }

    public function retrieveMessages($data = [])
    {
        $userId     = data_get($data, 'id');
        $groupId    = data_get($data, 'group_id');
        $startIndex = data_get($data, 'start_index', 0);
        $pageSize   = data_get($data, 'main_page_size', 20);
        $endTime    = data_get($data, 'end_time');

        return $this->request(
            'GET',
            self::MESSAGE_LIST,
            [
                'Application-Key' => env('APP_LOZIC_ID'),
                'Of-User-Id'      => $userId,
            ],
            [
                'userId'       => $userId,
                'groupId'      => $groupId,
                'startIndex'   => $startIndex,
                'mainPageSize' => $pageSize,
                'endTime'      => $endTime,
            ]
        );
    }

    public function sendMessage($data = [])
    {
        $userId   = data_get($data, 'id');
        $groupId  = data_get($data, 'group_id');
        $message  = data_get($data, 'message');
        $toUserId = data_get($data, 'target_user_id');

        return $this->request(
            'POST',
            self::CREATE_MESSAGE,
            [
                'Application-Key' => env('APP_LOZIC_ID'),
                'Of-User-Id'      => $userId,
            ],
            [
                'groupId' => $groupId,
                'message' => $message,
            ]
        );
    }
}
