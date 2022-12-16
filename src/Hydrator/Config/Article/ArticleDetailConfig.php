<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Article;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ArticleDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Article
 */
class ArticleDetailConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ArticleDetail();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'url' => StringValue::set('url'),
            'type_id' => IntegerValue::set('typeId'),
            'category_id' => IntegerValue::set('folderId'),
            'customer_id' => IntegerValue::set('mandatorId'),
            'article_type_id' => IntegerValue::set('articleTypeId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'url' => StringValue::get('url'),
            'type_id' => IntegerValue::get('typeId'),
            'category_id' => IntegerValue::get('folderId'),
            'customer_id' => IntegerValue::get('mandatorId'),
            'article_type_id' => IntegerValue::get('articleTypeId'),
        ];
    }
}
