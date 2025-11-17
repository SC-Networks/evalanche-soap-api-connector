<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticleInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotItemInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\LeadpageTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\TemplatesSourcesInterface;
use stdClass;

class LeadpageTemplateClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var LeadpageTemplateClient
     */
    private $subject;

    /**
     * @var EvalancheSoapClient|MockObject
     */
    private $soapClient;

    /**
     * @var ResponseMapperInterface|MockObject
     */
    private $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface|MockObject
     */
    private $hydratorConfigFactory;

    /**
     * @var ExtractorInterface|MockObject
     */
    private $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->getWsdlMock([
            'create',
            'rename',
            'copy',
            'move',
            'delete',
            'getConfiguration',
            'setConfiguration',
            'setSources',
            'getSources',
            'removeAllArticles',
            'removeArticles',
            'getArticles',
            'addArticles',
            'removeSlot',
            'removeTemplateFromSlot',
            'getSlotConfiguration',
            'addSlot',
            'updateSlot',
            'addTemplatesToSlot',
            'updateSlotTemplates',
        ]);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

        $this->subject = new LeadpageTemplateClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateReturnsResourceInformationInterface(): void
    {
        $folderId = 123;
        $title = 'some title';

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('create')
            ->with([
                'name' => $title,
                'category_id' => $folderId,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'createResult',
                $config
            )
            ->willReturn($response->createResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($title, $folderId)
        );
    }

    public function testUpdateTitleCanReturnInstanceOfResourceInformationInterface(): void
    {
        $id = 123;
        $title = 'some title';

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->renameResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('rename')
            ->with([
                'resource_id' => $id,
                'name' => $title,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'renameResult',
                $config
            )
            ->willReturn($response->renameResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->updateTitle($id, $title)
        );
    }

    public function testGetSourcesReturnsSources(): void
    {
        $id = 1234;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(TemplatesSourcesInterface::class);

        $response = new stdClass();
        $response->getSourcesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageTemplateSourcesConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getSources')
            ->with([
                'leadpage_template_id' => $id,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getSourcesResult',
                $config
            )
            ->willReturn($response->getSourcesResult);

        self::assertSame(
            $object,
            $this->subject->getSources($id)
        );
    }

    public function testSetSourcesReturnsSources(): void
    {
        $id = 123;
        $configuration = $this->createMock(TemplatesSourcesInterface::class);
        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(TemplatesSourcesInterface::class);
        $overwrite = true;

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new stdClass();
        $response->setSourcesResult = $object;

        $this->extractor->expects($this->once())
            ->method('extract')
            ->with($config, $configuration)
            ->willReturn($extractedData);

        $this->hydratorConfigFactory->expects($this->exactly(2))
            ->method('createLeadpageTemplateSourcesConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('setSources')->with([
                'leadpage_template_id' => $id,
                'sources' => $extractedData,
                'overwrite' => $overwrite
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'setSourcesResult',
                $config
            )
            ->willReturn($response->setSourcesResult);

        self::assertSame(
            $object,
            $this->subject->setSources($id, $configuration, $overwrite)
        );
    }

    public function testSetConfigurationCanReturnInstanceOfLeadpageTemplateConfiguration(): void
    {
        $id = 128;
        $configuration = $this->getMockBuilder(LeadpageTemplateConfigurationInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(LeadpageTemplateConfigurationInterface::class)->getMock();

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new stdClass();
        $response->setConfigurationResult = $object;

        $this->extractor->expects($this->once())->method('extract')->with($config, $configuration)->willReturn($extractedData);
        $this->hydratorConfigFactory->expects($this->exactly(2))->method('createLeadpageTemplateConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('setConfiguration')->with([
            'leadpage_template_id' => $id,
            'configuration' => $extractedData,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'setConfigurationResult',
            $config
        )->willReturn($response->setConfigurationResult);

        self::assertInstanceOf(
            LeadpageTemplateConfigurationInterface::class,
            $this->subject->setConfiguration($id, $configuration)
        );
    }

    public function testGetConfigurationCanReturnInstanceOfLeadpageTemplateConfiguration(): void
    {
        $id = 667;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(LeadpageTemplateConfigurationInterface::class)->getMock();

        $response = new stdClass();
        $response->getConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createLeadpageTemplateConfigurationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getConfiguration')->with([
            'leadpage_template_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getConfigurationResult',
            $config
        )->willReturn($response->getConfigurationResult);

        self::assertInstanceOf(
            LeadpageTemplateConfigurationInterface::class,
            $this->subject->getConfiguration($id),
        );
    }

    public function testRemoveAllArticlesCalls(): void
    {
        $id = 23;

        $response = new stdClass();
        $response->removeAllArticleResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeAllArticles')
            ->with([
                'leadpage_template_id' => $id
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->with(
                $response,
                'removeAllArticlesResult'
            )
            ->willReturn($response->removeAllArticleResult);


        static::assertTrue(
            $this->subject->removeAllArticles($id)
        );
    }

    public function testRemoveArticlesCalls(): void
    {
        $id = 23;
        $referenceIds = [42, 666];
        $response = new stdClass();
        $result = ['some-result'];

        $config = $this->createMock(HydratorConfigInterface::class);

        $this->soapClient->expects($this->once())
            ->method('removeArticles')
            ->with([
                'leadpage_template_id' => $id,
                'reference_ids' => $referenceIds,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'removeArticlesResult',
                $config,
            )
            ->willReturn($result);

        $this->hydratorConfigFactory->expects(static::once())
            ->method('createLeadpageArticleConfig')
            ->willReturn($config);

        static::assertSame(
            $result,
            $this->subject->removeArticles($id, $referenceIds)
        );
    }

    public function testAddArticlesCalls(): void
    {
        $id = 1234;
        $articles = [
            $this->createMock(LeadpageArticleInterface::class),
        ];

        $config = $this->createMock(HydratorConfigInterface::class);

        $response = new stdClass();
        $response->addArticlesResult = $articles;

        $extractedData = [
            [
                'some' => 'data'
            ],
        ];

        $this->extractor->expects($this->once())
            ->method('extractArray')
            ->with(
                $config,
                $articles
            )
            ->willReturn($extractedData);

        $this->hydratorConfigFactory->expects($this->exactly(2))
            ->method('createLeadpageArticleConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('addArticles')
            ->with([
                'leadpage_template_id' => $id,
                'articles' => $extractedData
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'addArticlesResult',
                $config
            )
            ->willReturn($response->addArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            LeadpageArticleInterface::class,
            $this->subject->addArticles($id, $articles)
        );
    }

    public function testGetArticlesByLeadpageTemplateIdCallsAndReturnsArticles(): void
    {
        $id = 123;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(LeadpageArticleInterface::class);

        $response = new stdClass();
        $response->getArticlesResult = [
            $object,
        ];

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageArticleConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getArticles')
            ->with([
                'leadpage_template_id' => $id,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObjects')
            ->with(
                $response,
                'getArticlesResult',
                $config
            )
            ->willReturn($response->getArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            LeadpageArticleInterface::class,
            $this->subject->getArticlesByLeadpageTemplateId($id)
        );
    }

    public function testRemoveSlotRemoves(): void
    {
        $id = 123;
        $slotId = 666;

        $response = new stdClass();
        $response->removeSlotResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeSlot')
            ->with([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->willReturn($response->removeSlotResult);

        $this->assertTrue($this->subject->removeSlot($id, $slotId));
    }

    public function testRemoveTemplateFromSlotRemoves(): void
    {
        $id = 123;
        $slotId = 666;
        $templateType = 444;
        $articleTypeId = 333;

        $response = new stdClass();
        $response->removeTemplateFromSlotResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeTemplateFromSlot')
            ->with([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'template_type' => $templateType,
                'article_type_id' => $articleTypeId
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->willReturn($response->removeTemplateFromSlotResult);

        $this->assertTrue(
            $this->subject->removeTemplateFromSlot(
                $id,
                $slotId,
                $templateType,
                $articleTypeId
            )
        );
    }

    public function testGetSlotConfigurationReturnsResult(): void
    {
        $id = 1234;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(LeadpageSlotConfigurationInterface::class);

        $response = new stdClass();
        $response->getSlotConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageSlotConfigurationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getSlotConfiguration')
            ->with([
                'leadpage_template_id' => $id,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getSlotConfigurationResult',
                $config
            )
            ->willReturn($response->getSlotConfigurationResult);

        self::assertSame(
            $object,
            $this->subject->getSlotConfiguration($id)
        );
    }

    public function testAddSlotAddsSlots(): void
    {
        $id = 1234;
        $slotNumber = 666;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(LeadpageSlotInterface::class);

        $response = new stdClass();
        $response->addSlotResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageSlotConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('addSlot')
            ->with([
                'leadpage_template_id' => $id,
                'slot_number' => $slotNumber
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'addSlotResult',
                $config
            )
            ->willReturn($response->addSlotResult);

        self::assertSame(
            $object,
            $this->subject->addSlot($id, $slotNumber)
        );
    }

    public function testUpdateSlotUpdatesSlot(): void
    {
        $id = 1234;
        $slotNumber = 666;
        $slotId = 555;
        $name = 'some-name';
        $sortTypeId = 444;
        $sortValue = 333;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(LeadpageSlotInterface::class);

        $response = new stdClass();
        $response->updateSlotResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageSlotConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('updateSlot')
            ->with([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'slot_number' => $slotNumber,
                'name' => $name,
                'sort_type_id' => $sortTypeId,
                'sort_value' => $sortValue
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'updateSlotResult',
                $config
            )
            ->willReturn($response->updateSlotResult);

        self::assertSame(
            $object,
            $this->subject->updateSlot(
                $id,
                $slotId,
                $slotNumber,
                $name,
                $sortTypeId,
                $sortValue
            )
        );
    }

    public function testAddTemplatesToSlotAdds(): void
    {
        $id = 1234;
        $slotId = 555;
        $data = $this->createMock(HashMapInterface::class);
        $articleTypeId = 666;
        $allowedTemplates = [];

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(LeadpageSlotItemInterface::class);

        $response = new stdClass();
        $response->addTemplatesToSlotResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageSlotItemConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('addTemplatesToSlot')
            ->with([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'data' => $data,
                'article_type_id' => $articleTypeId,
                'allowed_templates' => $allowedTemplates,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'addTemplatesToSlotResult',
                $config
            )
            ->willReturn($response->addTemplatesToSlotResult);

        self::assertSame(
            $object,
            $this->subject->addTemplatesToSlot(
                $id,
                $slotId,
                $data,
                $articleTypeId,
                $allowedTemplates
            )
        );
    }

    public function testUpdateSlotTemplatesUpdates(): void
    {
        $id = 1234;
        $slotId = 555;
        $data = $this->createMock(HashMapInterface::class);
        $articleTypeId = 666;
        $allowedTemplates = [];

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(LeadpageSlotItemInterface::class);

        $response = new stdClass();
        $response->updateSlotTemplatesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createLeadpageSlotItemConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('updateSlotTemplates')
            ->with([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'data' => $data,
                'article_type_id' => $articleTypeId,
                'allowed_templates' => $allowedTemplates,
            ])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'updateSlotTemplatesResult',
                $config
            )
            ->willReturn($response->updateSlotTemplatesResult);

        self::assertSame(
            $object,
            $this->subject->updateSlotTemplates(
                $id,
                $slotId,
                $data,
                $articleTypeId,
                $allowedTemplates
            )
        );
    }
}
