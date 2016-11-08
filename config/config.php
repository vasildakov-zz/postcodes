<?php
/**
 * https://docs.zendframework.com/zend-expressive/cookbook/modular-layout/
 * https://github.com/mtymek/expressive-config-manager
 */
use Zend\Expressive\ConfigManager\ConfigManager;
use Zend\Expressive\ConfigManager\PhpFileProvider;

$configManager = new ConfigManager([
    Application\ConfigProvider::class,
    Domain\ConfigProvider::class,
    Infrastructure\ConfigProvider::class,
    new PhpFileProvider('config/autoload/{{,*.}global,{,*.}local}.php'),
]);

$config = new ArrayObject($configManager->getMergedConfig());
//var_dump($config); exit();
return $config;
