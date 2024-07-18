<?php

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;

interface EditorModulesTypesTraitInterface
{
    /**
     * @param int $resourceId
     * @param string $moduleTypeContent
     * @return bool
     * @throws EmptyResultException
     */
    public function updateModuleTypes(int $resourceId, string $moduleTypeContent): bool;

    /**
     * @param int $resourceId
     * @return string
     * @throws EmptyResultException
     */
    public function getModuleTypes(int $resourceId): string;
}
