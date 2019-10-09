<?php

namespace Krisznal\PWA\Controller\Router;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Route\ConfigInterface;
use Magento\Framework\App\Router\ActionList;
use Magento\Framework\App\RouterInterface;

class FileRedirect implements RouterInterface
{
    const FILE_NAME = 'serviceWorker.js';

    const ROUTE_FRONT_NAME = 'manifest_json';

    const ROUTE_CONTROLLER = '';

    const ROUTE_ACTION = 'index';

    /** @var ActionFactory */
    protected $actionFactory;

    /** @var ActionList */
    protected $actionList;

    /** @var ConfigInterface */
    protected $routeConfig;

    public function __construct(
        ActionFactory $actionFactory,
        ActionList $actionList,
        ConfigInterface $routerConfig
    ) {
        $this->actionFactory = $actionFactory;
        $this->actionList = $actionList;
        $this->routeConfig = $routerConfig;
    }

    public function match(RequestInterface $request)
    {
        if ($this->getIdentifier($request) !== static::FILE_NAME) {
            return null;
        }

        $actionClassName = $this->actionList->get($this->getModuleName(), null, static::ROUTE_CONTROLLER, static::ROUTE_ACTION);
        return $this->actionFactory->create($actionClassName);
    }

    protected function getIdentifier(RequestInterface $request)
    {
        return trim($request->getPathInfo(), '/');
    }

    protected function getModuleName()
    {
        $modules = $this->routeConfig->getModulesByFrontName(static::ROUTE_FRONT_NAME);

        return $modules[0];
    }
}
