# Progressive Web App module for Magento 2.x
This module adds basic PWA features to Magento 2 stores. It will make your store score 100% in PWA section of Google Page Speed Insight.

# Requirements
This module works with Magento 2.x. It was tested on Magento 2.3 but should work without any issues on all versions from Magento 2.1. It requires PHP 7.0.
# Installation
To install this module copy all the files to `app/code/Krisznal/PWA` and run following commands
```
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

# Setting
Setting for this module are located in `Stores > Configuration > General > Web > Progressive Web App`. Please remember to fill those options before enabling the module.



