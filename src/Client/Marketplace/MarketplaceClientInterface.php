<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Marketplace;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\CategoryInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\ProductInterface;

interface MarketplaceClientInterface extends ClientInterface
{
    /**
     * @return CategoryInterface[]
     */
    public function getCategories(int $languageId): array;

    /**
     * @return ProductInterface[]
     */
    public function getProducts(int $categoryId, int $languageId): array;

    public function purchaseProduct(int $productId, int $mandatorId, int $languageId): string;
}
