<?php

namespace Scn\EvalancheSoapApiConnector\Client\User;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;

/**
 * Class UserClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\User
 */
final class UserClient extends AbstractClient implements UserClientInterface
{
    const PORTNAME = 'user';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * Returns user with given username
     *
     * @param string $username
     *
     * @return UserInterface&StructInterface
     * @throws EmptyResultException
     */
    public function getByUsername(string $username): UserInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getByUsername(['username' => $username]),
            'getByUsernameResult',
            $this->hydratorConfigFactory->createUserConfig()
        );
    }

    /**
     * Returns all users of the given mandator id
     *
     * @param int $id
     *
     * @return UserInterface[]
     * @throws EmptyResultException
     */
    public function getListByMandatorId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAll(['mandator_id' => $id]),
            'getAllResult',
            $this->hydratorConfigFactory->createUserConfig()
        );
    }

    /**
     * Updates a user. If the ID is set to 0, a new user will be created.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     * @throws EmptyResultException
     */
    public function updateUser(UserInterface $user): UserInterface
    {
        $userConfig = $this->hydratorConfigFactory->createUserConfig();

        return $this->responseMapper->getObject(
            $this->soapClient->update([
                'user' => $this->extractor->extract($userConfig, $user)
            ]),
            'updateResult',
            $userConfig
        );
    }
}
