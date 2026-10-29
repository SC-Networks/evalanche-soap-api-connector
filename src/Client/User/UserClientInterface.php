<?php

declare(strict_types=1);

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
    public function getByUsername(string $username): UserInterface;

    /**
     *
     * @return UserInterface[]
     */
    public function getListByMandatorId(int $id): array;

    public function updateUser(UserInterface $user): UserInterface;
}
