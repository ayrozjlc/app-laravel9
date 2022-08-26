<?php

namespace App\Console;

use App\Utilities\Enums\Enviroments as Env;
use Composer\Script\Event;
use Throwable;

class ComposerCommand
{
    public static function config(Event $event)
    {
        try {
            $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
            $autoload = $vendorDir . '/autoload.php';
            $args = self::parseArguments($event->getArguments());
            $args['env'] = Env::local->validEnv($args);
            $nodev = Env::local->noDev($args['env']);
            $install = 'install --no-dev --optimize-autoloader';

            if (file_exists($autoload)) {
                if ($nodev) {
                    $command = $install;
                } else {
                    $command = 'update --prefer-dist --prefer-stable';
                }
            } else {
                if ($nodev) {
                    $command = $install;
                } else {
                    $command = 'install';
                }
            }

            $BannerComposer = '
           ______
          / ____/___  ____ ___  ____  ____  ________  _____
         / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
        / /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
        \____/\____/_/ /_/ /_/ .___/\____/____/\___/_/  ' . $command . '
                            /_/';
            echo "\033[0;34m \033[1m" . $BannerComposer;
            passthru('printf "\n\n"');

            return passthru('composer ' . $command);
        } catch (Throwable $e) {
            echo "\033[0;34m \033[1m Error:" . $e->getMessage() . "\n";
            $event->stopPropagation();
            return null;
        }
    }

    public static function parseArguments(array $args): array
    {
        $parsed = [];
        foreach ($args as $arg) {
            $parse = explode('=', $arg);
            if (!isset($parse[1])) {
                $parsed[$parse[0]] = true;
            } else {
                $parsed[$parse[0]] = $parse[1];
            }
        }

        return $parsed;
    }
}
