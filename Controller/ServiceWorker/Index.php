<?php

namespace Krisznal\PWA\Controller\ServiceWorker;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Asset\Repository;

class Index extends Action
{
    const SERVICE_WORKER_FILE = 'Krisznal_PWA::js/serviceWorker.js';

    const RESPONSE_CONTENT_TYPE = 'text/javascript';

    /** @var Repository */
    protected $assetRepository;

    /** @var Raw */
    protected $response;

    public function __construct(Context $context, Repository $assetRepository)
    {
        parent::__construct($context);

        $this->assetRepository = $assetRepository;

        $this->response = $this->resultFactory->create(ResultFactory::TYPE_RAW);
    }

    public function execute()
    {
        $this->setContentTypeHeader();

        $this->response->setContents($this->getServiceWorkerFileContent());

        return $this->response;
    }

    protected function setContentTypeHeader()
    {
        $this->response->setHeader('Content-type', self::RESPONSE_CONTENT_TYPE);
    }

    protected function getServiceWorkerFileContent()
    {
        return $this->assetRepository
            ->createAsset(self::SERVICE_WORKER_FILE)
            ->getContent();
    }

}
