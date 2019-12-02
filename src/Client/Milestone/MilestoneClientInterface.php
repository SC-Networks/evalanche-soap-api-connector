<?php declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Milestone;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class MilestoneClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Milestone
 */
interface MilestoneClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     * @param string $name
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $name, int $folderId): ResourceInformationInterface;
}
