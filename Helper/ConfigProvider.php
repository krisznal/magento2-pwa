<?php

namespace Krisznal\PWA\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class ConfigProvider
{
    const CONFIG_PATH_NAME = 'pwa/general/name';
    const CONFIG_PATH_SHORT_NAME = 'pwa/general/short_name';
    const CONFIG_PATH_THEME_COLOR = 'pwa/general/theme_color';
    const CONFIG_PATH_BACKGROUND_COLOR = 'pwa/general/background_color';
    const CONFIG_PATH_DISPLAY_MODE = 'pwa/general/display';
    const CONFIG_PATH_ORIENTATION = 'pwa/general/orientation';
    const CONFIG_PATH_LOGO = 'pwa/general/logo';

    const ICONS_DIMENSIONS = [
        ['width' => 512, 'height' => 512],
        ['width' => 384, 'height' => 384],
        ['width' => 192, 'height' => 192],
        ['width' => 128, 'height' => 128],
        ['width' => 72, 'height' => 72]
    ];

    const APPLE_TOUCH_ICON_SIZES = [
        ['width' => 57, 'height' => 57],
        ['width' => 72, 'height' => 72],
        ['width' => 114, 'height' => 114]
    ];

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /** @var StoreManagerInterface */
    protected $storeManager;

    public function __construct(ScopeConfigInterface $scopeConfig, StoreManagerInterface $storeManager)
    {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    public function getName()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_NAME, ScopeInterface::SCOPE_STORE);
    }

    public function getShortName()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_SHORT_NAME, ScopeInterface::SCOPE_STORE);
    }

    public function getThemeColor()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_THEME_COLOR, ScopeInterface::SCOPE_STORE);
    }

    public function getBackgroundColor()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_BACKGROUND_COLOR, ScopeInterface::SCOPE_STORE);
    }

    public function getDisplayMode()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_DISPLAY_MODE, ScopeInterface::SCOPE_STORE);
    }

    public function getOrientation()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_ORIENTATION, ScopeInterface::SCOPE_STORE);
    }

    public function getLogo()
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_LOGO, ScopeInterface::SCOPE_STORE);
    }

    public function getStoreBaseUrl()
    {
        try {
            /** @var Store $store */
            $store = $this->storeManager->getStore();

            return $store->getBaseUrl();
        } catch (NoSuchEntityException $exception) {
            return '';
        }
    }
}
