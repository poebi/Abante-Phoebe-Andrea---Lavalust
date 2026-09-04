<?php
/**
 * Command: Migrate
 *
 * Runs database migrations for LavaLust.
 */
class Migrate
{
    public static $command = 'migrate';
    public static $description = 'Run all pending database migrations';
    public static $arguments = [];

    public function handle($input = null, array $flags = [])
    {
        if (!defined('PREVENT_DIRECT_ACCESS')) {
            define('PREVENT_DIRECT_ACCESS', TRUE);
        }

        $root = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;

        if (!defined('ROOT_DIR'))   define('ROOT_DIR', $root);
        if (!defined('SYSTEM_DIR')) define('SYSTEM_DIR', ROOT_DIR . 'scheme' . DIRECTORY_SEPARATOR);
        if (!defined('PUBLIC_DIR')) define('PUBLIC_DIR', 'public');

        require_once SYSTEM_DIR . 'kernel/LavaLust.php';
        require_once SYSTEM_DIR . 'libraries/Migration.php';

        $migration = new Migration();
        $migration->migrate();
    }
}
