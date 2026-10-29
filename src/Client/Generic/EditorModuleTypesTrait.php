<?php

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;

trait EditorModuleTypesTrait
{
    /**
     * @throws EmptyResultException
     */
    public function updateModuleTypes(int $resourceId, string $moduleTypeContent): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->updateModuleTypes(
                [
                    'resource_id' => $resourceId,
                    'module_type_content' => $moduleTypeContent,
                ]
            ),
            'updateModuleTypesResult'
        );
    }

    /**
     * @throws EmptyResultException
     */
    public function getModuleTypes(int $resourceId): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->retrieveModuleTypes(
                [
                    'resource_id' => $resourceId,
                ]
            ),
            'retrieveModuleTypesResult'
        );
    }
}
