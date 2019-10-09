<?php

namespace Krisznal\PWA\Controller;

use Krisznal\PWA\Controller\Router\FileRedirect;

class ServiceWorkerRouter extends FileRedirect
{
    const FILE_NAME = 'serviceWorker.js';

    const ROUTE_FRONT_NAME = 'manifest_json';

    const ROUTE_CONTROLLER = 'serviceWorker';

}
