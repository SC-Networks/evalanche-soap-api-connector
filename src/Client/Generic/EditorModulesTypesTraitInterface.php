<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;

interface EditorModulesTypesTraitInterface
{
    /**
     * @throws EmptyResultException
     */
    public function updateModuleTypes(int $resourceId, string $moduleTypeContent): bool;

    /**
     * @throws EmptyResultException
     */
    public function getModuleTypes(int $resourceId): string;
}
