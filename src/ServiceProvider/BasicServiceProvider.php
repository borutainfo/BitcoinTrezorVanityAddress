<?php declare(strict_types=1);
/**
 * @author Sebastian Boruta <sebastian@boruta.info>
 */

namespace Boruta\BitcoinVanity\ServiceProvider;


use Boruta\CommonAbstraction\Config\DatabaseConfig;
use Boruta\CommonAbstraction\DependencyInjector\DependencyInjector;
use Boruta\CommonAbstraction\ServiceProvider\ServiceProviderInterface;

/**
 * Class BasicServiceProvider
 * @package Boruta\BitcoinVanity\ServiceProvider
 */
class BasicServiceProvider implements ServiceProviderInterface
{
    public function register(): void
    {
        DependencyInjector::set(DatabaseConfig::class, function () {
            return new DatabaseConfig(__DIR__ . '/../../config/database.yml');
        });
    }
}
