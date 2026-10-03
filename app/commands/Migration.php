<?php

/**
 * Run database migrations through LavaLust's CLI router.
 */
class Migration
{
    public static $command = 'migration';
    public static $description = 'Run database migrations';
    public static $arguments = [
        'action' => 'Action: run, create-migration, rollback, rollback-all, refresh, or status',
        '[name]' => 'Migration name (used with create-migration)',
    ];

    public function handle($action = null, array $flags = [], $name = null)
    {
        $routes = [
            'run' => 'migrate',
            'create-migration' => 'create-migration',
            'rollback' => 'rollback',
            'rollback-all' => 'rollback-all',
            'refresh' => 'refresh',
            'status' => 'status',
        ];

        if (!isset($routes[$action])) {
            fwrite(STDERR, "Usage: php lava migration <run|create-migration|rollback|rollback-all|refresh|status> [name]\n");
            exit(1);
        }

        // The current CLI dispatcher passes only the first positional value to
        // handle(); read the second one here for create-migration.
        if ($name === null && isset($_SERVER['argv'][3])) {
            $name = $_SERVER['argv'][3];
        }

        $route = $routes[$action];
        if ($action === 'create-migration') {
            if (!$name) {
                fwrite(STDERR, "A migration name is required for create-migration.\n");
                exit(1);
            }
            $route .= '/' . rawurlencode($name);
        }

        $index = PUBLIC_DIR . 'index.php';
        $command = 'php ' . escapeshellarg($index) . ' ' . escapeshellarg($route);
        passthru($command, $exit_code);
        if ($exit_code !== 0) {
            exit($exit_code);
        }
    }
}
