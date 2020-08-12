<?php

namespace Scn\EvalancheSoapApiConnector\Client\Marketplace;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\CategoryInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\ProductInterface;

interface MarketplaceClientInterface extends ClientInterface
{

    /**
     * @param int $languageId
     * @return CategoryInterface[]
     */
    public function getCategories(int $languageId): array;

    /**
     * @param int $categoryId
     * @param int $languageId
     * @return ProductInterface[]
     */
    public function getProducts(int $categoryId, int $languageId): array;

    public function purchaseProduct(string $productId, int $mandatorId, int $languageId): string;
}
