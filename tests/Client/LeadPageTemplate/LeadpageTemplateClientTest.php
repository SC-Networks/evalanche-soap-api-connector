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
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\LeadpageTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\TemplatesSourcesInterface;
use \stdClass;

class LeadpageTemplateClientTest extends \Scn\EvalancheSoapApiConnector\TestCase
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
}
