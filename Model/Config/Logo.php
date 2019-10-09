<?php

namespace Krisznal\PWA\Model\Config;

use Magento\Config\Model\Config\Backend\Image;

class Logo extends Image
{
    const ALLOWED_LOGO_EXTENSION = ['png'];

    public function _getAllowedExtensions()
    {
        return self::ALLOWED_LOGO_EXTENSION;
    }
}
