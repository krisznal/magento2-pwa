<?php

namespace Krisznal\PWA\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class Orientation implements OptionSourceInterface
{
    const ORIENTATION_ANY = '';
    const ORIENTATION_PORTRAIT = 'portrait';
    const ORIENTATION_LANDSCAPE = 'landscape';

    public function toOptionArray()
    {
        return [
            ['value' => self::ORIENTATION_ANY, 'label' => __('Any')],
            ['value' => self::ORIENTATION_PORTRAIT, 'label'  => __('Portrait')],
            ['value' => self::ORIENTATION_LANDSCAPE, 'label'  => __('Landscape')]
        ];
    }
}
