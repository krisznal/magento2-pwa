<?php

namespace Krisznal\PWA\Block;

use Krisznal\PWA\Helper\ConfigProvider;
use Krisznal\PWA\Model\Logo;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class MetaTags implements ArgumentInterface
{
    /** @var ConfigProvider */
    protected $configProvider;

    /** @var Logo */
    protected $logo;

    /**
     * MetaTags constructor.
     *
     * @param ConfigProvider $configProvider
     * @param Logo $logo
     */
    public function __construct(ConfigProvider $configProvider, Logo $logo)
    {
        $this->configProvider =  $configProvider;
        $this->logo = $logo;
    }

    /**
     * Returns theme color
     * @return string
     */
    public function getThemeColor()
    {
        return $this->configProvider->getThemeColor();
    }

    /**
     * Returns a link to resized logo
     *
     * @param int $width
     * @param int $height
     *
     * @return string
     */
    public function getResizedLogo($width, $height)
    {
        return $this->logo->getResized($this->configProvider->getLogo(), $width, $height);
    }
}
