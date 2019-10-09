<?php

namespace Krisznal\PWA\Model;

use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;

class Logo
{
    const UPLOADED_LOGO_DIRECTORY = 'krisznal_pwa';

    /** @var Filesystem */
    protected $filesystem;

    /** @var AdapterFactory */
    protected $imageFactory;

    /** @var StoreManagerInterface */
    protected $storeManager;

    public function __construct(
        Filesystem $filesystem,
        AdapterFactory $image,
        StoreManagerInterface $storeManager
    ) {
        $this->imageFactory = $image;
        $this->storeManager = $storeManager;
        $this->filesystem = $filesystem;
    }

    public function getResized($imageName, $width, $height)
    {
        if (!$width || !$height) {
            return null;
        }

        $path = $this->getResizedImagePath($width, $height);

        if (!$this->fileExists($path . $imageName)) {
            $this->resize($imageName, $width, $height);
        }

        try {
            return $this->getStoreBaseUrl() . $path . $imageName;
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }
    public function resize($imageName, $width, $height)
    {
        try {
            $mediaDirectory = $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA);

            $path = $this->getResizedImagePath($width, $height);

            $absolutePath = $mediaDirectory->getAbsolutePath(self::UPLOADED_LOGO_DIRECTORY) . '/' . $imageName;
            $imageResized = $mediaDirectory->getAbsolutePath($path) . $imageName;

            $image = $this->loadImage($absolutePath);

            if ($image) {
                $image->resize($width, $height);
                $image->save($imageResized);
            }

            return true;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function fileExists($path)
    {
        try {
            return $this->filesystem->getDirectoryWrite(DirectoryList::MEDIA)->isFile($path);
        } catch (FileSystemException $exception) {
            return false;
        }
    }

    protected function getResizedImagePath($width, $height)
    {
        return self::UPLOADED_LOGO_DIRECTORY . '/cache/' . $width . 'x' . $height . '/';
    }

    protected function loadImage($path)
    {
        if ($this->fileExists($path)) {
            /** @var  $image */
            $image = $this->imageFactory->create();
            $image->open($path);
            $image->constrainOnly(true);
            $image->keepTransparency(true);
            $image->keepFrame(true);
            $image->keepAspectRatio(true);

            return $image;
        }

        return null;
    }

    /**
     * @return string
     *
     * @throws NoSuchEntityException
     */
    protected function getStoreBaseUrl()
    {
        /** @var Store $store */
        $store = $this->storeManager->getStore();
        return $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }
}
