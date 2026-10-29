<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client\CommonResourceMethodsTestTrait;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualizationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use stdClass;

/**
 * Class ArticleClientTest
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
class ArticleClientTest extends TestCase
{
    use CommonResourceMethodsTestTrait;
    /**
     * @var ArticleClient
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
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createMock(ExtractorInterface::class);

        $this->subject = new ArticleClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testCreateCanReturnInstanceOfResourceInformation()
    {
        $id = 456;
        $title = 'some title';
        $folderId = 123;
        $hashMap = $this->createStub(HashMapInterface::class);

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $expectedExtractor = [
            'some' => 'value'
        ];

        $response = new stdClass();
        $response->createResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);
        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);

        $this->extractor->expects($this->once())->method('extract')->with(
            $config,
            $hashMap
        )->willReturn($expectedExtractor);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'create',
                [[
                    'article_preset_id' => $id,
                    'name' => $title,
                    'category_id' => $folderId,
                    'data' => $expectedExtractor,
                ]]
            )
            ->willReturn($response);

        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'createResult',
            $config
        )->willReturn($response->createResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->create($id, $title, $folderId, $hashMap)
        );
    }

    public function testGetDetailByIdCanReturnInstanceOfHashMap()
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(HashMapInterface::class);

        $response = new stdClass();
        $response->getDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getData',
                [[
                    'article_id' => $id
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDataResult',
            $config
        )->willReturn($response->getDataResult);

        self::assertInstanceOf(
            HashMapInterface::class,
            $this->subject->getDetailById($id)
        );
    }

    public function testUpdateCanReturnInstanceOfResourceInformation()
    {
        $id = 12;
        $hashMap = $this->createStub(HashMapInterface::class);

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->updateResult = $object;

        $extractedData = [
            'some key' => 'some value',
            'some other key' => 'some other value'
        ];

        $this->hydratorConfigFactory->expects($this->once())->method('createHashMapConfig')->willReturn($config);
        $this->hydratorConfigFactory->expects($this->once())->method('createResourceInformationConfig')->willReturn($config);

        $this->extractor->expects($this->once())->method('extract')->with(
            $config,
            $hashMap
        )->willReturn($extractedData);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'update',
                [[
                    'article_id' => $id,
                    'data' => $extractedData
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'updateResult',
            $config
        )->willReturn($response->updateResult);

        self::assertInstanceOf(
            ResourceInformationInterface::class,
            $this->subject->update($id, $hashMap)
        );
    }

    public function testGetDetailsByIdCanReturnInstanceOfContainerDetail()
    {
        $id = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ArticleDetailInterface::class);

        $response = new stdClass();
        $response->getDataResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createArticleDetailConfig')->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getDetails',
                [[
                    'article_id' => $id,
                ]]
            )
            ->willReturn($response);
        $this->responseMapper->expects($this->once())->method('getObject')->with(
            $response,
            'getDetailsResult',
            $config
        )->willReturn($response->getDataResult);

        self::assertInstanceOf(
            ArticleDetailInterface::class,
            $this->subject->getDetailsById($id)
        );
    }

    public function testGetByArticleTypeIdCanReturnInstancesOfResourceInformation()
    {
        $articleTypeId = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ResourceInformationInterface::class);
        $otherObject = $this->createStub(ResourceInformationInterface::class);

        $response = new stdClass();
        $response->getByArticleTypeIdResult = [$object, $otherObject];

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createResourceInformationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getByArticleTypeId',
                [[
                    'article_type_id' => $articleTypeId
                ]]
            )
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getObjects')
            ->with($response, 'getByArticleTypeIdResult', $config)
            ->willReturn($response->getByArticleTypeIdResult);

        $this->assertContainsOnlyInstancesOf(
            ResourceInformationInterface::class,
            $this->subject->getByArticleTypeId($articleTypeId)
        );
    }

    public function testGetIndividualizationdReturnsData(): void
    {
        $articleId = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(ArticleIndividualizationInterface::class);

        $response = new stdClass();
        $response->getIndividualizationResult = $object;

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createArticleIndividualizationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getIndividualization',
                [[
                    'article_id' => $articleId
                ]]
            )
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($response, 'getIndividualizationResult', $config)
            ->willReturn($response->getIndividualizationResult);

        self::assertInstanceOf(
            ArticleIndividualizationInterface::class,
            $this->subject->getIndividualization($articleId)
        );
    }

    public function testSetIndividualizationSetsData(): void
    {
        $articleId = 123;

        $config = $this->createStub(HydratorConfigInterface::class);
        $individualization = $this->createStub(ArticleIndividualizationInterface::class);

        $extractionResult = ['some-result'];
        $response = new stdClass();
        $response->setIndividualizationResult = true;

        $this->hydratorConfigFactory->expects($this->once())
            ->method('createArticleIndividualizationConfig')
            ->willReturn($config);

        $this->extractor->expects($this->once())
            ->method('extract')
            ->with(
                $config,
                $individualization
            )
            ->willReturn($extractionResult);

        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createArticleIndividualizationConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'setIndividualization',
                [[
                    'article_id' => $articleId,
                    'configuration' => $extractionResult
                ]]
            )
            ->willReturn($response);
        $this->responseMapper
            ->expects($this->once())
            ->method('getBoolean')
            ->with($response, 'setIndividualizationResult')
            ->willReturn($response->setIndividualizationResult);

        self::assertTrue(
            $this->subject->setIndividualization($articleId, $individualization)
        );
    }
}
