<?php
/**
 * Created by PhpStorm.
 * User: Ben
 * Date: 2018-08-27
 * Time: 16:00
 */

namespace App\Dtos\User;

class Creation
{
    private $userId;
    private $email;
    private $password;
    private $displayName;
    private $registrationId;
    private $pushNotificationFormat;
    private $contactNumber;
    private $unreadCountType;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     *
     * @return Creation
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return Creation
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return Creation
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     *
     * @return Creation
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * @param mixed $registrationId
     *
     * @return Creation
     */
    public function setRegistrationId($registrationId)
    {
        $this->registrationId = $registrationId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPushNotificationFormat()
    {
        return $this->pushNotificationFormat;
    }

    /**
     * @param mixed $pushNotificationFormat
     *
     * @return Creation
     */
    public function setPushNotificationFormat($pushNotificationFormat)
    {
        $this->pushNotificationFormat = $pushNotificationFormat;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * @param mixed $contactNumber
     *
     * @return Creation
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnreadCountType()
    {
        return $this->unreadCountType;
    }

    /**
     * @param mixed $unreadCountType
     *
     * @return Creation
     */
    public function setUnreadCountType($unreadCountType)
    {
        $this->unreadCountType = $unreadCountType;
        return $this;
    }
}
