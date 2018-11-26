<?php

namespace Scn\EvalancheSoapApiConnector;

use Scn\EvalancheSoapApiConnector\Client;
use Scn\EvalancheSoapApiConnector\Extractor\Extractor;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactory;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapper;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use Scn\Hydrator\Hydrator;

/**
 * Class EvalancheConnection
 *
 * @package Scn\EvalancheSoapApiConnector
 */
final class EvalancheConnection implements EvalancheConnectionInterface
{
    /**
     * @var SoapClientFactoryInterface
     */
    private $soapClientFactory;

    /**
     * @var EvalancheConfigInterface
     */
    private $config;

    /**
     * @var ResponseMapperInterface
     */
    private $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface
     */
    private $hydratorConfigFactory;

    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * @param EvalancheConfigInterface $config
     * @param SoapClientFactoryInterface $soapClientFactory
     * @param ResponseMapperInterface $responseMapper
     * @param HydratorConfigFactoryInterface $hydratorConfigFactory
     * @param ExtractorInterface $extractor
     */
    public function __construct(
        EvalancheConfigInterface $config,
        SoapClientFactoryInterface $soapClientFactory,
        ResponseMapperInterface $responseMapper,
        HydratorConfigFactoryInterface $hydratorConfigFactory,
        ExtractorInterface $extractor
    ) {
        $this->config = $config;
        $this->soapClientFactory = $soapClientFactory;
        $this->responseMapper = $responseMapper;
        $this->hydratorConfigFactory = $hydratorConfigFactory;
        $this->extractor = $extractor;
    }

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param bool $debugMode
     *
     * @return EvalancheConnectionInterface
     */
    public static function create(string $hostname, string $username, string $password, $debugMode = false): EvalancheConnectionInterface
    {
        return new EvalancheConnection(
            new EvalancheConfig(
                $hostname,
                $username,
                $password,
                $debugMode
            ),
            new SoapClientFactory(),
            new ResponseMapper(
                new Hydrator()
            ),
            new HydratorConfigFactory(),
            new Extractor(
                new Hydrator()
            )
        );
    }

    /**
     *
     * @return Client\Account\AccountClientInterface
     */
    public function createAccountClient(): Client\Account\AccountClientInterface
    {
        return $this->createClient(Client\Account\AccountClient::class);
    }

    /**
     * @param string $clientClass
     *
     * @return Client\ClientInterface
     */
    private function createClient(string $clientClass): Client\ClientInterface
    {
        /* @var $clientClass Client\ClientInterface */
        $soapClient = $this->soapClientFactory->create($this->config, $clientClass::getWsdlUri());

        return new $clientClass($soapClient, $this->responseMapper, $this->hydratorConfigFactory, $this->extractor);
    }

    /**
     *
     * @return Client\Article\ArticleClientInterface
     */
    public function createArticleClient(): Client\Article\ArticleClientInterface
    {
        return $this->createClient(Client\Article\ArticleClient::class);
    }

    /**
     *
     * @return Client\Article\ArticleTemplateClientInterface
     */
    public function createArticleTemplateClient(): Client\Article\ArticleTemplateClientInterface
    {
        return $this->createClient(Client\Article\ArticleTemplateClient::class);
    }

    /**
     *
     * @return Client\Article\ArticleTypeClientInterface
     */
    public function createArticleTypeClient(): Client\Article\ArticleTypeClientInterface
    {
        return $this->createClient(Client\Article\ArticleTypeClient::class);
    }

    /**
     *
     * @return Client\Folder\FolderClientInterface
     */
    public function createFolderClient(): Client\Folder\FolderClientInterface
    {
        return $this->createClient(Client\Folder\FolderClient::class);
    }

    /**
     *
     * @return Client\Container\ContainerClientInterface
     */
    public function createContainerClient(): Client\Container\ContainerClientInterface
    {
        return $this->createClient(Client\Container\ContainerClient::class);
    }

    /**
     *
     * @return Client\Container\ContainerTypeClientInterface
     */
    public function createContainerTypeClient(): Client\Container\ContainerTypeClientInterface
    {
        return $this->createClient(Client\Container\ContainerTypeClient::class);
    }

    /**
     *
     * @return Client\Document\DocumentClientInterface
     */
    public function createDocumentClient(): Client\Document\DocumentClientInterface
    {
        return $this->createClient(Client\Document\DocumentClient::class);
    }

    /**
     *
     * @return Client\Form\FormClientInterface
     */
    public function createFormClient(): Client\Form\FormClientInterface
    {
        return $this->createClient(Client\Form\FormClient::class);
    }

    /**
     *
     * @return Client\TargetGroup\TargetGroupClientInterface
     */
    public function createTargetGroupClient(): Client\TargetGroup\TargetGroupClientInterface
    {
        return $this->createClient(Client\TargetGroup\TargetGroupClient::class);
    }

    /**
     *
     * @return Client\Image\ImageClientInterface
     */
    public function createImageClient(): Client\Image\ImageClientInterface
    {
        return $this->createClient(Client\Image\ImageClient::class);
    }

    /**
     *
     * @return Client\Mailing\MailingClientInterface
     */
    public function createMailingClient(): Client\Mailing\MailingClientInterface
    {
        return $this->createClient(Client\Mailing\MailingClient::class);
    }

    /**
     *
     * @return Client\Mailing\MailingTemplateClientInterface
     */
    public function createMailingTemplateClient(): Client\Mailing\MailingTemplateClientInterface
    {
        return $this->createClient(Client\Mailing\MailingTemplateClient::class);
    }

    /**
     *
     * @return Client\Mandator\MandatorClientInterface
     */
    public function createMandatorClient(): Client\Mandator\MandatorClientInterface
    {
        return $this->createClient(Client\Mandator\MandatorClient::class);
    }

    /**
     *
     * @return Client\Pool\PoolClientInterface
     */
    public function createPoolClient(): Client\Pool\PoolClientInterface
    {
        return $this->createClient(Client\Pool\PoolClient::class);
    }

    /**
     *
     * @return Client\Pool\PoolDataMinerClientInterface
     */
    public function createPoolDataMinerClient(): Client\Pool\PoolDataMinerClientInterface
    {
        return $this->createClient(Client\Pool\PoolDataMinerClient::class);
    }

    /**
     *
     * @return Client\Profile\ProfileClientInterface
     */
    public function createProfileClient(): Client\Profile\ProfileClientInterface
    {
        return $this->createClient(Client\Profile\ProfileClient::class);
    }

    /**
     *
     * @return Client\Report\ReportClientInterface
     */
    public function createReportClient(): Client\Report\ReportClientInterface
    {
        return $this->createClient(Client\Report\ReportClient::class);
    }

    /**
     *
     * @return Client\Scoring\ScoringClientInterface
     */
    public function createScoringClient(): Client\Scoring\ScoringClientInterface
    {
        return $this->createClient(Client\Scoring\ScoringClient::class);
    }

    /**
     *
     * @return Client\Smartlink\SmartLinkClientInterface
     */
    public function createSmartLinkClient(): Client\Smartlink\SmartLinkClientInterface
    {
        return $this->createClient(Client\Smartlink\SmartLinkClient::class);
    }

    /**
     *
     * @return Client\User\UserClientInterface
     */
    public function createUserClient(): Client\User\UserClientInterface
    {
        return $this->createClient(Client\User\UserClient::class);
    }

    /**
     *
     * @return Client\Workflow\WorkflowClientInterface
     */
    public function createWorkflowClient(): Client\Workflow\WorkflowClientInterface
    {
        return $this->createClient(Client\Workflow\WorkflowClient::class);
    }

    /**
     *
     * @return Client\Blacklist\BlackListClientInterface
     */
    public function createBlackListClient(): Client\Blacklist\BlackListClientInterface
    {
        return $this->createClient(Client\Blacklist\BlackListClient::class);
    }

    /**
     * @return Client\Webhook\WebhookClientInterface
     */
    public function createWebhookClient(): Client\Webhook\WebhookClientInterface {
        return $this->createClient(Client\Webhook\WebhookClient::class);
    }
}