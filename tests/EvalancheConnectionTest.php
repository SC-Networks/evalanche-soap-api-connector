<?php

namespace Scn\EvalancheSoapApiConnector;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Client;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;

/**
 * Class EvalancheConnectionTest
 *
 * @package Scn\EvalancheSoapApiConnector
 */
class EvalancheConnectionTest extends TestCase
{

    /**
     * @var EvalancheConnection
     */
    private $subject;

    /**
     * @var EvalancheConfigInterface|MockObject
     */
    private $config;

    /**
     * @var SoapClientFactoryInterface|MockObject
     */
    private $soapClientFactory;

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
    private $extrator;

    public function setUp()
    {
        $this->config = $this->getMockBuilder(EvalancheConfigInterface::class)->getMock();
        $this->soapClientFactory = $this->getMockBuilder(SoapClientFactoryInterface::class)->getMock();
        $this->responseMapper = $this->getMockBuilder(ResponseMapperInterface::class)->getMock();
        $this->hydratorConfigFactory = $this->getMockBuilder(HydratorConfigFactoryInterface::class)->getMock();
        $this->extrator = $this->getMockBuilder(ExtractorInterface::class)->getMock();

        $this->subject = new EvalancheConnection(
            $this->config,
            $this->soapClientFactory,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extrator
        );
    }

    public function testCreateAccountClientCanReturnInstanceOfAccountClient()
    {
        $this->assertInstanceOf(
            Client\Account\AccountClientInterface::class,
            $this->subject->createAccountClient()
        );
    }

    public function testCreateArticleClientCanReturnInstanceOfArticleClient()
    {
        $this->assertInstanceOf(
            Client\Article\ArticleClientInterface::class,
            $this->subject->createArticleClient()
        );
    }

    public function testCreateArticleTemplateClientCanReturnInstanceOfArticleTemplateClient()
    {
        $this->assertInstanceOf(
            Client\Article\ArticleTemplateClientInterface::class,
            $this->subject->createArticleTemplateClient()
        );
    }

    public function testCreateArticleTypeClientCanReturnInstanceOfArticleTypeClient()
    {
        $this->assertInstanceOf(
            Client\Article\ArticleTypeClientInterface::class,
            $this->subject->createArticleTypeClient()
        );
    }

    public function testCreateFolderClientCanReturnInstanceOfCategoryClient()
    {
        $this->assertInstanceOf(
            Client\Folder\FolderClientInterface::class,
            $this->subject->createFolderClient()
        );
    }

    public function testCreateContainerClientCanReturnInstanceOfContainerClient()
    {
        $this->assertInstanceOf(
            Client\Container\ContainerClientInterface::class,
            $this->subject->createContainerClient()
        );
    }

    public function testCreateContainerTypeClientCanReturnInstanceOfContainerTypeClient()
    {
        $this->assertInstanceOf(
            Client\Container\ContainerTypeClientInterface::class,
            $this->subject->createContainerTypeClient()
        );
    }

    public function testCreateDocumentClientCanReturnInstanceOfDocumentClient()
    {
        $this->assertInstanceOf(
            Client\Document\DocumentClientInterface::class,
            $this->subject->createDocumentClient()
        );
    }

    public function testCreateFormClientCanReturnInstanceOfFormClient()
    {
        $this->assertInstanceOf(
            Client\Form\FormClientInterface::class,
            $this->subject->createFormClient()
        );
    }

    public function testCreateTargetGroupClientCanReturnInstanceOfTargetGroupClient()
    {
        $this->assertInstanceOf(
            Client\TargetGroup\TargetGroupClientInterface::class,
            $this->subject->createTargetGroupClient()
        );
    }

    public function testCreateImageClientCanReturnInstanceOfImageClient()
    {
        $this->assertInstanceOf(
            Client\Image\ImageClientInterface::class,
            $this->subject->createImageClient()
        );
    }

    public function testCreateMailingclientCanReturnInstanceOfMailingClient()
    {
        $this->assertInstanceOf(
            Client\Mailing\MailingClientInterface::class,
            $this->subject->createMailingClient()
        );
    }

    public function testCreateMailingTemplateClientCanReturnInstanceOfMailingTemplateClient()
    {
        $this->assertInstanceOf(
            Client\Mailing\MailingTemplateClientInterface::class,
            $this->subject->createMailingTemplateClient()
        );
    }

    public function testCreateMandatorClientCanReturnInstanceOfMandatorClient()
    {
        $this->assertInstanceOf(
            Client\Mandator\MandatorClientInterface::class,
            $this->subject->createMandatorClient()
        );
    }

    public function testCreatePoolClientCanReturnInstanceOfPoolClient()
    {
        $this->assertInstanceOf(
            Client\Pool\PoolClientInterface::class,
            $this->subject->createPoolClient()
        );
    }

    public function testCreatePoolDataMinerClientCanReturnInstanceOfPoolDataMinerClient()
    {
        $this->assertInstanceOf(
            Client\Pool\PoolDataMinerClientInterface::class,
            $this->subject->createPoolDataMinerClient()
        );
    }

    public function testCreateProfileClientCanReturnInstanceOfProfileClient()
    {
        $this->assertInstanceOf(
            Client\Profile\ProfileClientInterface::class,
            $this->subject->createProfileClient()
        );
    }

    public function testCreateReportClientCanReturnInstanceOfReportClient()
    {
        $this->assertInstanceOf(
            Client\Report\ReportClientInterface::class,
            $this->subject->createReportClient()
        );
    }

    public function testCreateScoringClientCanReturnInstanceOfScoringClient()
    {
        $this->assertInstanceOf(
            Client\Scoring\ScoringClientInterface::class,
            $this->subject->createScoringClient()
        );
    }

    public function testCreateSmartLinkClientCanReturnInstanceOfSmartLinkClient()
    {
        $this->assertInstanceOf(
            Client\Smartlink\SmartLinkClientInterface::class,
            $this->subject->createSmartLinkClient()
        );
    }

    public function testCreateUserClientCanReturnInstanceOfUserClient()
    {
        $this->assertInstanceOf(
            Client\User\UserClientInterface::class,
            $this->subject->createUserClient()
        );
    }

    public function testCreateWorkflowClientCanReturnInstanceOfWorkflowClient()
    {
        $this->assertInstanceOf(
            Client\Workflow\WorkflowClientInterface::class,
            $this->subject->createWorkflowClient()
        );
    }

    public function testCreateCanReturnInstanceOfEvalancheConnection()
    {
        $this->assertInstanceOf(
            EvalancheConnectionInterface::class,
            $this->subject::create('some host', 'some user', 'some password')
        );
    }

    public function testCreateBlackListClientCanReturnInstanceOfBlackListClient()
    {
        $this->assertInstanceOf(
            Client\Blacklist\BlackListClient::class,
            $this->subject->createBlackListClient()
        );
    }

    public function testCreateWebhookClientCanReturnInstanceOfWebhookClient()
    {
        $this->assertInstanceOf(
            Client\Webhook\WebhookClient::class,
            $this->subject->createWebhookClient()
        );
    }
}
