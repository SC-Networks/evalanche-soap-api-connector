<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

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
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticleInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotItemInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplatesSourcesInterface;
use stdClass;

/**
 * Class MailingTemplateClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
class MailingTemplateClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var MailingTemplateClient
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
            'addArticles',
            'getArticles',
            'removeAllArticles',
            'removeArticles',
            'applyTemplate',
            'getConfiguration',
            'setConfiguration',
            'setSources',
            'getSources',
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

        $this->subject = new MailingTemplateClient(
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

    public function testRemoveArticlesCanReturnArrayOfMailingArticle(): void
    {
        $id = 1234;
        $referenceIds = [
            1,
            2,
            3,
            4,
        ];

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(MailingArticleInterface::class);
        $otherObject = $this->createMock(MailingArticleInterface::class);

        $response = new stdClass();
        $response->removeArticlesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingArticleConfig')
            ->willReturn($config);
        
        $this->soapClient->expects($this->once())
            ->method('removeArticles')
            ->with([
                'mailing_template_id' => $id,
                'reference_ids' => $referenceIds,
            ])
            ->willReturn($response);
        
        $this->responseMapper->expects($this->once())
            ->method('getObjects')->with(
                $response,
                'removeArticlesResult',
                $config
            )
            ->willReturn($response->removeArticlesResult);

        $this->assertContainsOnlyInstancesOf(
            MailingArticleInterface::class,
            $this->subject->removeArticles($id, $referenceIds)
        );
    }
    
    public function testAddArticlesAdd(): void
    {
        $id = 1234;
        $articles = [
            $this->createMock(MailingArticleInterface::class),
            $this->createMock(MailingArticleInterface::class)
        ];

        $config = $this->createMock(HydratorConfigInterface::class);

        $response = new stdClass();
        $response->addArticlesResult = $articles;

        $extractedData = [
            [
                'some' => 'data'
            ],
            [
                'some' => 'other data'
            ]
        ];

        $this->extractor->expects($this->once())
            ->method('extractArray')
            ->with(
                $config,
                $articles
            )
            ->willReturn($extractedData);
        
        $this->hydratorConfigFactory->expects($this->exactly(2))
            ->method('createMailingArticleConfig')
            ->willReturn($config);
        
        $this->soapClient->expects($this->once())
            ->method('addArticles')
            ->with([
                'mailing_template_id' => $id,
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
            MailingArticleInterface::class,
            $this->subject->addArticles($id, $articles)
        );
    }
    
    public function testGetArticlesByMailingTemplateIdReturnsListOfMailingArticle(): void
    {
        $id = 123;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(MailingArticleInterface::class);
        $otherObject = $this->createMock(MailingArticleInterface::class);

        $response = new stdClass();
        $response->getArticlesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingArticleConfig')
            ->willReturn($config);
        
        $this->soapClient->expects($this->once())
            ->method('getArticles')
            ->with([
                'mailing_template_id' => $id,
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
            MailingArticleInterface::class,
            $this->subject->getArticlesByMailingTemplateId($id)
        );
    }
    
    public function testRemoveAllArticlesRemoves(): void
    {
        $id = 123;

        $response = new stdClass();
        $response->removeAllArticlesResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeAllArticles')
            ->with(['mailing_template_id' => $id])
            ->willReturn($response);
        
        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->willReturn($response->removeAllArticlesResult);

        $this->assertTrue($this->subject->removeAllArticles($id));
    }
    
    public function testApplyTemplateApplies(): void
    {
        $id = 123;
        $mailingId = 666;

        $response = new stdClass();
        $response->applyTemplateResult = true;

        $this->soapClient->expects($this->once())
            ->method('applyTemplate')
            ->with(['mailing_template_id' => $id, 'mailing_ids' => [$mailingId]])
            ->willReturn($response);

        $this->responseMapper->expects($this->once())
            ->method('getBoolean')
            ->willReturn($response->applyTemplateResult);

        $this->assertTrue($this->subject->applyTemplate($id, [$mailingId]));
    }
    
    public function testGetConfigurationCanReturnsMailingTemplateConfiguration(): void
    {
        $id = 1234;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(MailingTemplateConfigurationInterface::class);

        $response = new stdClass();
        $response->getConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingTemplateConfigurationConfig')
            ->willReturn($config);
        
        $this->soapClient->expects($this->once())
            ->method('getConfiguration')
            ->with([
                'mailing_template_id' => $id,
            ])
            ->willReturn($response);
        
        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getConfigurationResult',
                $config
            )
            ->willReturn($response->getConfigurationResult);

        self::assertInstanceOf(
            MailingTemplateConfigurationInterface::class,
            $this->subject->getConfiguration($id)
        );
    }

    public function testSetConfigurationReturnsMailingTemplateConfiguration(): void
    {
        $id = 123;
        $configuration = $this->createMock(MailingTemplateConfigurationInterface::class);
        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(MailingTemplateConfigurationInterface::class);

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new stdClass();
        $response->setConfigurationResult = $object;

        $this->extractor->expects($this->once())
            ->method('extract')
            ->with($config, $configuration)
            ->willReturn($extractedData);
        
        $this->hydratorConfigFactory->expects($this->exactly(2))
            ->method('createMailingTemplateConfigurationConfig')
            ->willReturn($config);
        
        $this->soapClient->expects($this->once())
            ->method('setConfiguration')->with([
                'mailing_template_id' => $id,
                'configuration' => $extractedData,
            ])
            ->willReturn($response);
        
        $this->responseMapper->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'setConfigurationResult',
                $config
            )
            ->willReturn($response->setConfigurationResult);

        self::assertInstanceOf(
            MailingTemplateConfigurationInterface::class,
            $this->subject->setConfiguration($id, $configuration)
        );
    }

    public function testGetSourcesReturnsSources(): void
    {
        $id = 1234;

        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(MailingTemplatesSourcesInterface::class);

        $response = new stdClass();
        $response->getSourcesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingTemplateSourcesConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getSources')
            ->with([
                'mailing_template_id' => $id,
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
        $configuration = $this->createMock(MailingTemplatesSourcesInterface::class);
        $config = $this->createMock(HydratorConfigInterface::class);
        $object = $this->createMock(MailingTemplatesSourcesInterface::class);
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
            ->method('createMailingTemplateSourcesConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('setSources')->with([
                'mailing_template_id' => $id,
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

    public function testRemoveSlotRemoves(): void
    {
        $id = 123;
        $slotId = 666;

        $response = new stdClass();
        $response->removeSlotResult = true;

        $this->soapClient->expects($this->once())
            ->method('removeSlot')
            ->with([
                'mailing_template_id' => $id,
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
                'mailing_template_id' => $id,
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
        $object = $this->createMock(MailingSlotConfigurationInterface::class);

        $response = new stdClass();
        $response->getSlotConfigurationResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingSlotConfigurationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('getSlotConfiguration')
            ->with([
                'mailing_template_id' => $id,
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
        $object = $this->createMock(MailingSlotInterface::class);

        $response = new stdClass();
        $response->addSlotResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingSlotConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('addSlot')
            ->with([
                'mailing_template_id' => $id,
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
        $object = $this->createMock(MailingSlotInterface::class);

        $response = new stdClass();
        $response->updateSlotResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingSlotConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('updateSlot')
            ->with([
                'mailing_template_id' => $id,
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
        $object = $this->createMock(MailingSlotItemInterface::class);

        $response = new stdClass();
        $response->addTemplatesToSlotResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingSlotItemConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('addTemplatesToSlot')
            ->with([
                'mailing_template_id' => $id,
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
        $object = $this->createMock(MailingSlotItemInterface::class);

        $response = new stdClass();
        $response->updateSlotTemplatesResult = $object;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createMailingSlotItemConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())
            ->method('updateSlotTemplates')
            ->with([
                'mailing_template_id' => $id,
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
