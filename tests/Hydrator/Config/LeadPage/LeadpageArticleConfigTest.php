<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPage;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticleInterface;

/**
 * Class MailingArticleConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Leadpage
 */
class LeadpageArticleConfigTest extends TestCase
{
    private LeadpageArticleConfig $subject;

    /** @var list<string> */
    private array $arrayKeys = [
        'id',
        'article_id',
        'targetgroup_id',
        'landingpage_preset_id',
        'mobile_preset_id',
        'sort_pos',
        'slot',
    ];

    public function setUp(): void
    {
        $this->subject = new LeadpageArticleConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            LeadpageArticleInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
