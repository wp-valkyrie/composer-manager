<?php
/**
 * Plugin Name: WP-Core | Composer Manager
 * Description: Composer management handler for the wp valkyrie system
 * Plugin URI: https://github.com/wp-valkyrie/module_composer-manager
 * Author: Jannik Schäfer <me@jschaefer.io>
 * Author URI: https://jschaefer.io/
 * Version: 1.0
 */

use Valkyrie\Module;
use Valkyrie\RequireHandler;
use Valkyrie\System;

add_action('after_setup_theme', function (){
    if (!class_exists('\Valkyrie\System')) {
        return true;
    }
    System::addModule(new class('_COMPOSER_', 10, ['_CORE_']) extends Module{

        /**
         * Includes the combined autoload file
         */
        public function init(): void{
            $this->requireGroup('autoload');
        }

        /**
         * Stages the composer autoload file
         * @param RequireHandler $handler A fresh RequireHandler to add files to
         * @return RequireHandler The combined RequireHandler
         */
        public function require(RequireHandler $handler): RequireHandler{
            $handler->addFile(__DIR__ . '/vendor/autoload.php', 'autoload');
            return $handler;
        }

        /**
         * The Module does not have any frontend assets
         */
        public function enqueue(): void{
            return;
        }

        /**
         * The Module does not have any backend assets
         */
        public function adminEnqueue(): void{
            return;
        }
    });
});