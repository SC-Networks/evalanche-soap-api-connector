<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Marketplace;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Enum\LanguageEnum;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Marketplace\CategoryInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\ProductInterface;
use stdClass;

class MarketplaceClientTest extends TestCase
{

    /**
     * @var MarketplaceClient
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
            'getCategoryList',
            'getProductList',
            'purchaseProduct',
        ]);
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extractor = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new MarketplaceClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetCategoriesCanReturnArrayOfCategoryInterface(): void
    {
        $languageId = LanguageEnum::ES;

        $result = new stdClass();
        $result->items = [
            $this->getMockBuilder(CategoryInterface::class)->getMock(),
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createMarketplaceCategoryConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('getCategoryList')
            ->with(
                ['LanguageId' => $languageId]
            )->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObjectsDirectly')
            ->with($result, $config)
            ->willReturn($result->items);

        $this->assertContainsOnlyInstancesOf(
            CategoryInterface::class,
            $this->subject->getCategories($languageId)
        );
    }

    public function testGetProductsCanReturnArrayOfProductInterface(): void
    {
        $categoryId = 123;
        $languageId = LanguageEnum::ES;

        $result = new stdClass();
        $result->items = [
            $this->getMockBuilder(ProductInterface::class)->getMock(),
        ];

        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $this->hydratorConfigFactory
            ->expects($this->once())
            ->method('createMarketplaceProductConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('getProductList')
            ->with(
                [
                    'CategoryId' => $categoryId,
                    'LanguageId' => $languageId
                ]
            )->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObjectsDirectly')
            ->with($result, $config)
            ->willReturn($result->items);

        $this->assertContainsOnlyInstancesOf(
            ProductInterface::class,
            $this->subject->getProducts($categoryId, $languageId)
        );
    }

    public function testPurchaseProductCanReturnString(): void
    {
        $productId = 'some product id';
        $mandatorId = 45;
        $languageId = LanguageEnum::EN;

        $result_string = 'my result';
        $result = new stdClass();
        $result->RecipeId = $result_string;

        $this->soapClient->expects($this->once())->method('purchaseProduct')
            ->with(
                ['ProductId' => $productId,
                    'MandatorId' => $mandatorId,
                    'LanguageId' => $languageId
                ]
            )->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getString')
            ->with($result, 'RecipeId')
            ->willReturn($result_string);
        $this->assertSame(
            $result_string,
            $this->subject->purchaseProduct($productId, $mandatorId, $languageId)
        );
    }
}
