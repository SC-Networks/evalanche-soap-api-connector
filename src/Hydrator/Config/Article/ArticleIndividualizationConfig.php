<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Article;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualization;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\BooleanValue;

class ArticleIndividualizationConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ArticleIndividualization();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'has_fallback' => BooleanValue::set('hasFallback'),
            'individualization_items' => ArrayOfObjectValue::set('individualizationItems', new ArticleIndividualizationItemConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'has_fallback' => BooleanValue::get('hasFallback'),
            'individualization_items' => ArrayOfObjectValue::get('individualizationItems', new ArticleIndividualizationItemConfig()),
        ];
    }
}
