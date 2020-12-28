<?php
/**
 * Nextcloud - Spacedeck
 *
 *
 * @author Julien Veyssier <eneiluj@posteo.net>
 * @copyright Julien Veyssier 2020
 */

namespace OCA\Spacedeck\AppInfo;

use OCP\IContainer;

use OCP\AppFramework\App;
use OCP\AppFramework\IAppContainer;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;

use OCA\Spacedeck\Notification\Notifier;

/**
 * Class Application
 *
 * @package OCA\Spacedeck\AppInfo
 */
class Application extends App implements IBootstrap {

    public const APP_ID = 'integration_spacedeck';

    /**
     * Constructor
     *
     * @param array $urlParams
     */
    public function __construct(array $urlParams = []) {
        parent::__construct(self::APP_ID, $urlParams);

        $container = $this->getContainer();
        $server = $container->getServer();
        $eventDispatcher = $server->getEventDispatcher();
        $this->addPrivateListeners($eventDispatcher);
    }

    protected function addPrivateListeners($eventDispatcher) {
        $eventDispatcher->addListener('OCA\Files::loadAdditionalScripts',
            function () {
                \OCP\Util::addscript(self::APP_ID, self::APP_ID . '-filetypes');
                // \OCP\Util::addStyle(self::APP_ID,'style');
            });
        }

    public function register(IRegistrationContext $context): void {
    }

    public function boot(IBootContext $context): void {
    }
}

