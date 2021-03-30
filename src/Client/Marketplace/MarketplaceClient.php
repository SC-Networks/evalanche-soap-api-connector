<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Marketplace;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;

final class MarketplaceClient extends AbstractClient implements MarketplaceClientInterface
{
    const PORTNAME = 'marketplace/wsdl';
    const VERSION = ClientInterface::VERSION_V1;

    public function getCategories(int $languageId): array
    {
        return $this->responseMapper->getObjectsDirectly(
            $this->soapClient->getCategoryList(['LanguageId' => $languageId]),
            $this->hydratorConfigFactory->createMarketplaceCategoryConfig()
        );
    }

    public function getProducts(int $categoryId, int $languageId): array
    {
        return $this->responseMapper->getObjectsDirectly(
            $this->soapClient->getProductList(['CategoryId' => $categoryId, 'LanguageId' => $languageId]),
            $this->hydratorConfigFactory->createMarketplaceProductConfig()
        );
    }

    /**
     * @throws EmptyResultException
     */
    public function purchaseProduct(string $productId, int $mandatorId, int $languageId): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->purchaseProduct(['ProductId' => $productId, 'MandatorId' => $mandatorId, 'LanguageId' => $languageId]),
            'RecipeId'
        );
    }

    public static function getWsdlUri(): string
    {
        return sprintf(ClientInterface::WSDL_V1_URI, static::VERSION, static::PORTNAME);
    }
}
