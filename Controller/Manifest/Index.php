<?php

namespace Krisznal\PWA\Controller\Manifest;

use Krisznal\PWA\Model\Generator;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http;

class Index extends Action
{
    const RESPONSE_CONTENT_TYPE = 'application/manifest+json';

    /** @var Generator */
    protected $generator;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param Generator $generator
     */
    public function __construct(Context $context, Generator $generator)
    {
        parent::__construct($context);

        $this->generator = $generator;
    }

    public function execute()
    {
        $this->setContentTypeHeader();

        /** @var Http $response */
        $response = $this->getResponse();
        $response->setContent($this->generator->generate());

        return $response;
    }

    protected function setContentTypeHeader()
    {
        $this->getResponse()->setHeader('Content-Type', self::RESPONSE_CONTENT_TYPE);
    }
}
