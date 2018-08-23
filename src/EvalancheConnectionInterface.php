<?php

namespace Scn\EvalancheSoapApiConnector;

use Scn\EvalancheSoapApiConnector\Client;

/**
 * Interface EvalancheConnectionInterface
 *
 * @package Scn\EvalancheSoapApiConnector
 */
interface EvalancheConnectionInterface
{

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     *
     * @return EvalancheConnectionInterface
     */
    public static function create(string $hostname, string $username, string $password): EvalancheConnectionInterface;

    /**
     *
     * @return Client\Account\AccountClientInterface
     */
    public function createAccountClient(): Client\Account\AccountClientInterface;

    /**
     *
     * @return Client\Article\ArticleClientInterface
     */
    public function createArticleClient(): Client\Article\ArticleClientInterface;

    /**
     *
     * @return Client\Article\ArticleTemplateClientInterface
     */
    public function createArticleTemplateClient(): Client\Article\ArticleTemplateClientInterface;

    /**
     *
     * @return Client\Article\ArticleTypeClientInterface
     */
    public function createArticleTypeClient(): Client\Article\ArticleTypeClientInterface;

    /**
     *
     * @return Client\Category\CategoryClientInterface
     */
    public function createCategoryClient(): Client\Category\CategoryClientInterface;

    /**
     *
     * @return Client\Container\ContainerClientInterface
     */
    public function createContainerClient(): Client\Container\ContainerClientInterface;

    /**
     *
     * @return Client\Container\ContainerTypeClientInterface
     */
    public function createContainerTypeClient(): Client\Container\ContainerTypeClientInterface;

    /**
     *
     * @return Client\Document\DocumentClientInterface
     */
    public function createDocumentClient(): Client\Document\DocumentClientInterface;

    /**
     *
     * @return Client\Form\FormClientInterface
     */
    public function createFormClient(): Client\Form\FormClientInterface;

    /**
     *
     * @return Client\TargetGroup\TargetGroupClientInterface
     */
    public function createTargetGroupClient(): Client\TargetGroup\TargetGroupClientInterface;

    /**
     *
     * @return Client\Image\ImageClientInterface
     */
    public function createImageClient(): Client\Image\ImageClientInterface;

    /**
     *
     * @return Client\Mailing\MailingClientInterface
     */
    public function createMailingClient(): Client\Mailing\MailingClientInterface;

    /**
     *
     * @return Client\Mailing\MailingTemplateClientInterface
     */
    public function createMailingTemplateClient(): Client\Mailing\MailingTemplateClientInterface;

    /**
     *
     * @return Client\Mandator\MandatorClientInterface
     */
    public function createMandatorClient(): Client\Mandator\MandatorClientInterface;

    /**
     *
     * @return Client\Pool\PoolClientInterface
     */
    public function createPoolClient(): Client\Pool\PoolClientInterface;

    /**
     *
     * @return Client\Pool\PoolDataMinerClientInterface
     */
    public function createPoolDataMinerClient(): Client\Pool\PoolDataMinerClientInterface;

    /**
     *
     * @return Client\Profile\ProfileClientInterface
     */
    public function createProfileClient(): Client\Profile\ProfileClientInterface;

    /**
     *
     * @return Client\Report\ReportClientInterface
     */
    public function createReportClient(): Client\Report\ReportClientInterface;

    /**
     *
     * @return Client\Scoring\ScoringClientInterface
     */
    public function createScoringClient(): Client\Scoring\ScoringClientInterface;

    /**
     *
     * @return Client\Smartlink\SmartLinkClientInterface
     */
    public function createSmartLinkClient(): Client\Smartlink\SmartLinkClientInterface;

    /**
     *
     * @return Client\User\UserClientInterface
     */
    public function createUserClient(): Client\User\UserClientInterface;

    /**
     *
     * @return Client\Workflow\WorkflowClientInterface
     */
    public function createWorkflowClient(): Client\Workflow\WorkflowClientInterface;

    /**
     *
     * @return Client\Blacklist\BlackListClientInterface
     */
    public function createBlackListClient(): Client\Blacklist\BlackListClientInterface;
}