<?php

namespace Krisznal\PWA\Model;

use Krisznal\PWA\Helper\ConfigProvider;
use Magento\Framework\Serialize\Serializer\Json;

class Generator
{
    const PNG_FILE_TYPE = 'image/png';

    /** @var ConfigProvider */
    protected $configProvider;

    /** @var Json */
    protected $json;

    /** @var Logo */
    protected $logo;

    /** @var array */
    protected $manifest;

    public function __construct(
        ConfigProvider $configProvider,
        Json $json,
        Logo $logo
    ) {
        $this->configProvider = $configProvider;
        $this->json = $json;
        $this->logo = $logo;
    }

    public function generate()
    {
        $this->manifest = [];

        $this->addName();
        $this->addShortName();
        $this->addBackgroundTheme();
        $this->addThemeColor();
        $this->addDisplay();
        $this->addOrientation();
        $this->addStartUrl();
        $this->addScope();
        $this->addIcons();

        return $this->json->serialize($this->manifest);
    }

    protected function addName()
    {
        $this->manifest['name'] = $this->configProvider->getName();
    }

    protected function addShortName()
    {
        $this->manifest['short_name'] = $this->configProvider->getShortName();
    }

    protected function addBackgroundTheme()
    {
        $this->manifest['background_color'] = $this->configProvider->getBackgroundColor();
    }

    protected function addThemeColor()
    {
        $this->manifest['theme_color'] = $this->configProvider->getThemeColor();
    }

    protected function addDisplay()
    {
        $this->manifest['display'] = $this->configProvider->getDisplayMode();
    }

    protected function addOrientation()
    {
        $this->manifest['orientation'] = $this->configProvider->getOrientation();
    }

    protected function addStartUrl()
    {
        $this->manifest['start_url'] = '/';
    }

    protected function addScope()
    {
        $this->manifest['scope'] = $this->configProvider->getStoreBaseUrl();
    }

    protected function addIcons()
    {
        $logoImageName = $this->configProvider->getLogo();

        foreach (ConfigProvider::ICONS_DIMENSIONS as $dimension) {
            $this->manifest['icons'][] = [
                'src' => $this->logo->getResized($logoImageName, $dimension['width'], $dimension['height']),
                'sizes' => $dimension['width'] . 'x' . $dimension['height'],
                'type' => self::PNG_FILE_TYPE
            ];
        }
    }
}
