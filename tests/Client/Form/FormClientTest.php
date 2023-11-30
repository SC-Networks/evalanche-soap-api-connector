<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Form;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Form\FormConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormStatisticInterface;
use stdClass;

/**
 * Class FormClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Form
 */
class FormClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var FormClient
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
            'addAttribute',
            'addAttributeOption',
            'createAlias',
            'getAliases',
            'getFormByAlias',
            'getStatistics',
            'removeAttribute',
            'removeAttributeOption',
            'rename',
            'move',
            'copy',
            'delete',
            'updateTemplate',
            'create',
            'getConfiguration',
            'setConfiguration',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new FormClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testAddAttributeCanReturnInteger()
    {
        $id = 123;
        $poolAttributeId = 653;

        $response = new stdClass();
        $response->addAttributeResult = 1;

        $this->soapClient->expects($this->once())->method('addAttribute')->with([
            'form_id' => $id,
            'pool_attribute_id' => $poolAttributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getInteger')->with(
            $response,
            'addAttributeResult'
        )->willReturn($response->addAttributeResult);

        self::assertSame(
            $response->addAttributeResult,
            $this->subject->addAttribute($id, $poolAttributeId)
        );
    }

    public function testAddAttributeOptionCanReturnBoolean()
    {
        $id = 45;
        $optionId = 555;

        $response = new stdClass();
        $response->addAttributeOptionResult = true;

        $this->soapClient->expects($this->once())->method('addAttributeOption')->with([
            'form_id' => $id,
            'option_id' => $optionId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'addAttributeOptionResult'
        )->willReturn($response->addAttributeOptionResult);

        $this->assertTrue($this->subject->addAttributeOption($id, $optionId));
    }

    public function testCreateAliasCanReturnInstanceOfResourceInformation()
    {
        $id = 123;
        $title = 'some title';
        $folderId = 99;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->createAliasResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('createAlias')->with([
            'form_id' => $id,
            'name' => $title,
            'category_id' => $folderId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createAliasResult',
            $config
        )->willReturn($response->createAliasResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->createAlias($id, $title, $folderId)
        );
    }

    public function testGetAliasesCanReturnArrayOfResourceInformation()
    {
        $id = 456;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getAliasesResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getAliases')->with([
            'form_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getAliasesResult',
            $config
        )->willReturn($response->getAliasesResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getAliases($id)
        );
    }

    public function testGetFormByAliasCanReturnInstanceOfResourceInformation()
    {
        $id = 932;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->getFormByAliasResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getFormByAlias')->with([
            'formalias_id' => $id,
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getFormByAliasResult',
            $config
        )->willReturn($response->getFormByAliasResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->getFormByAlias($id)
        );
    }

    public function testGetStatisticsCanReturnInstanceOfFormStatistic()
    {
        $id = 932;
        $includeAliases = false;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FormStatisticInterface::class)->getMock();
        $otherObject = $this->getMockBuilder(FormStatisticInterface::class)->getMock();

        $response = new stdClass();
        $response->getStatisticsResult = [
            $object,
            $otherObject
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createFormStatisticConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('getStatistics')->with([
            'formular_id' => $id,
            'with_aliases' => $includeAliases
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObjects')->with(
            $response,
            'getStatisticsResult',
            $config
        )->willReturn($response->getStatisticsResult);

        $this->assertContainsOnlyInstancesOf(
            FormStatisticInterface::class,
            $this->subject->getStatistics($id, $includeAliases)
        );
    }

    public function testRemoteAttributeCanReturnBoolean()
    {
        $id = 123;
        $formAttributeId = 44;

        $response = new stdClass();
        $response->removeAttributeResult = false;

        $this->soapClient->expects($this->once())->method('removeAttribute')->with([
            'form_id' => $id,
            'form_attribute_id' => $formAttributeId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'removeAttributeResult'
        )->willReturn($response->removeAttributeResult);

        $this->assertFalse($this->subject->removeAttribute($id, $formAttributeId));
    }

    public function testRemoteAttributeOptionCanReturnBoolean()
    {
        $id = 123;
        $optionId = 44;

        $response = new stdClass();
        $response->removeAttributeOptionResult = false;

        $this->soapClient->expects($this->once())->method('removeAttributeOption')->with([
            'form_id' => $id,
            'option_id' => $optionId
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getBoolean')->with(
            $response,
            'removeAttributeOptionResult'
        )->willReturn($response->removeAttributeOptionResult);

        $this->assertFalse($this->subject->removeAttributeOption($id, $optionId));
    }

    public function testUpdateTemplateCanReturnInstanceOfResourceInformation()
    {
        $id = 123;
        $templateHtml = '<p>some html</p>';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->updateTemplateResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('updateTemplate')->with([
            'form_id' => $id,
            'source' => $templateHtml
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'updateTemplateResult',
            $config
        )->willReturn($response->updateTemplateResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->updateTemplate($id, $templateHtml)
        );
    }

    public function testCreateCanReturnInstanceOfResourceInformation()
    {
        $poolId = 999;
        $title = 'some title';

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(ResourceInformationInterface::class)->getMock();

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('create')->with([
            'pool_id' => $poolId,
            'name' => $title
        ])->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createResult',
            $config
        )->willReturn($response->createResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($poolId, $title)
        );
    }

    public function testGetConfigurationCanReturnInstanceOfFormConfiguration()
    {
        $id = 1234;

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FormConfigurationInterface::class)->getMock();

        $response = new stdClass();
        $response->getConfigurationResult = $object;

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createFormConfigurationConfig')
            ->willReturn($config);
        $this->soapClient
            ->expects($this->once())
            ->method('getConfiguration')
            ->with([
                'form_id' => $id,
            ])
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'getConfigurationResult',
                $config
            )
            ->willReturn($response->getConfigurationResult);

        self::assertInstanceOf(
            FormConfigurationInterface::class,
            $this->subject->getConfiguration($id)
        );
    }

    public function testSetConfigurationCanReturnInstanceOfMailingConfiguration()
    {
        $id = 123;
        $configuration = $this->getMockBuilder(FormConfigurationInterface::class)->getMock();

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $object = $this->getMockBuilder(FormConfigurationInterface::class)->getMock();

        $extractedData = [
            'some ' => 'data',
        ];

        $response = new stdClass();
        $response->setConfigurationResult = $object;

        $this->extractor
            ->expects($this->once())
            ->method('extract')
            ->with($config, $configuration)
            ->willReturn($extractedData);
        $this->hydratorConfigFactory
            ->expects($this->exactly(2))
            ->method('createFormConfigurationConfig')
            ->willReturn($config);
        $this->soapClient
            ->expects($this->once())
            ->method('setConfiguration')
            ->with([
                'form_id' => $id,
                'configuration' => $extractedData,
            ])
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with(
                $response,
                'setConfigurationResult',
                $config
            )
            ->willReturn($response->setConfigurationResult);

        self::assertInstanceOf(
            FormConfigurationInterface::class,
            $this->subject->setConfiguration($id, $configuration)
        );
    }
}
