<?php

namespace Scn\EvalancheSoapApiConnector\Client\User;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;

/**
 * Interface UserClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\User
 */
interface UserClientInterface extends ClientInterface
{
    /**
     * @param string $username
     *
     * @return UserInterface
     */
    public function getByUsername(string $username): UserInterface;

    /**
     * @param int $id
     *
     * @return UserInterface[]
     */
    public function getListByMandatorId(int $id): array;

    /**
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function updateUser(UserInterface $user): UserInterface;
}