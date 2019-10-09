<?php

namespace Krisznal\PWA\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayMode implements OptionSourceInterface
{
    const DISPLAY_MODE_FULLSCREEN = 'fullscreen';
    const DISPLAY_MODE_MINIMAL = 'minimal-ui';
    const DISPLAY_MODE_STANDALONE = 'standalone';

    public function toOptionArray()
    {
        return [
            ['value' => self::DISPLAY_MODE_FULLSCREEN, 'label'  => __('Fullscreen')],
            ['value' => self::DISPLAY_MODE_MINIMAL, 'label'  => __('Minimal UI')],
            ['value' => self::DISPLAY_MODE_STANDALONE, 'label'  => __('Standalone')]
        ];
    }
}
