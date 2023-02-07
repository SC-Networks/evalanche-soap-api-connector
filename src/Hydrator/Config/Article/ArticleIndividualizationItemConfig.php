<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Article;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualizationItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

class ArticleIndividualizationItemConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ArticleIndividualizationItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'targetgroup_id' => IntegerValue::set('targetgroupId'),
            'article_id' => IntegerValue::set('articleId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'targetgroup_id' => IntegerValue::get('targetgroupId'),
            'article_id' => IntegerValue::get('articleId'),
        ];
    }
}
