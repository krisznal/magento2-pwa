<?php

namespace Krisznal\PWA\Controller;

use Krisznal\PWA\Controller\Router\FileRedirect;

class ManifestRouter extends FileRedirect
{
    const FILE_NAME = 'manifest.json';

    const ROUTE_FRONT_NAME = 'manifest_json';

    const ROUTE_CONTROLLER = 'manifest';

}
