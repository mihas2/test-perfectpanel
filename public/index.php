<?php
require_once __DIR__.'/../vendor/autoload.php';


Luracast\Restler\Defaults::$useUrlBasedVersioning = true;
Luracast\Restler\Defaults::$crossOriginResourceSharing = true;
Luracast\Restler\Defaults::$composeClass = '\Api\Compose';
Luracast\Restler\Defaults::$cacheDirectory = __DIR__ . '/../var/cache';
Luracast\Restler\Format\UploadFormat::$allowedMimeTypes = 0;
Luracast\Restler\Format\UploadFormat::$maximumFileSize = 25 * 1024 * 1024;

$r = new Luracast\Restler\Restler(getenv('APP_ENV') === 'prod');
$r->setAPIVersion(1);
$r->addAuthenticationClass('Api\AccessControl');
$r->setSupportedFormats('JsonFormat', 'UploadFormat');
$r->addAPIClass('Luracast\\Restler\\Resources');
$r->addAPIClass('Explorer');
$r->addAPIClass('Api\\v1\\Rates');
$r->addAPIClass('Api\\v1\\Convert');

$r->handle();
