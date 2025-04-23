<?php

/**
 * Plugin Setup with extensibility
 *
 * @package Maverick
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Plugin Setup Class
 */
class Maverick_Plugin_Setup
{
    /**
     * Plugin version
     *
     * @var string
     */
    private $version;

    /**
     * Plugin name
     *
     * @var string
     */
    private $plugin_name;

    /**
     * Plugin file
     *
     * @var string
     */
    private $plugin_file;

    /**
     * Constructor
     *
     * @param string $plugin_file The main plugin file.
     * @param string $version     The plugin version.
     */
    public function __construct(string $plugin_file, string $version = '1.0.0')
    {
        $this->plugin_file = $plugin_file;
        $this->version = $version;
        $this->plugin_name = basename($plugin_file, '.php');

        $this->init();
    }

    /**
     * Initialize the plugin
     */
    private function init(): void
    {
        // Default initialization parameters
        $init_params = [
            'version' => $this->version,
            'plugin_name' => $this->plugin_name,
            'plugin_file' => $this->plugin_file,
            'plugin_dir' => plugin_dir_path($this->plugin_file),
            'plugin_url' => plugin_dir_url($this->plugin_file),
        ];

        // Allow other plugins/themes to modify initialization
        $init_params = apply_filters('maverick_plugin_init', $init_params);

        // Register activation and deactivation hooks
        register_activation_hook($this->plugin_file, [$this, 'activate']);
        register_deactivation_hook($this->plugin_file, [$this, 'deactivate']);

        // Add uninstall hook
        register_uninstall_hook($this->plugin_file, [__CLASS__, 'uninstall']);

        // Initialize plugin
        add_action('plugins_loaded', [$this, 'load_plugin']);
    }

    /**
     * Plugin activation
     */
    public function activate(): void
    {
        // Default activation tasks
        $activation_tasks = [
            'create_tables' => true,
            'set_default_options' => true,
            'create_roles' => true,
        ];

        // Allow other plugins/themes to modify activation tasks
        $activation_tasks = apply_filters('maverick_plugin_activation', $activation_tasks);

        // Perform activation tasks
        if ($activation_tasks['create_tables']) {
            $this->create_tables();
        }

        if ($activation_tasks['set_default_options']) {
            $this->set_default_options();
        }

        if ($activation_tasks['create_roles']) {
            $this->create_roles();
        }

        // Store version
        update_option($this->plugin_name . '_version', $this->version);
    }

    /**
     * Plugin deactivation
     */
    public function deactivate(): void
    {
        // Default deactivation tasks
        $deactivation_tasks = [
            'clear_schedules' => true,
            'clear_transients' => true,
        ];

        // Allow other plugins/themes to modify deactivation tasks
        $deactivation_tasks = apply_filters('maverick_plugin_deactivation', $deactivation_tasks);

        // Perform deactivation tasks
        if ($deactivation_tasks['clear_schedules']) {
            $this->clear_schedules();
        }

        if ($deactivation_tasks['clear_transients']) {
            $this->clear_transients();
        }
    }

    /**
     * Plugin uninstall
     */
    public static function uninstall(): void
    {
        // Default uninstall tasks
        $uninstall_tasks = [
            'drop_tables' => true,
            'delete_options' => true,
            'delete_roles' => true,
        ];

        // Allow other plugins/themes to modify uninstall tasks
        $uninstall_tasks = apply_filters('maverick_plugin_uninstall', $uninstall_tasks);

        // Perform uninstall tasks
        if ($uninstall_tasks['drop_tables']) {
            self::drop_tables();
        }

        if ($uninstall_tasks['delete_options']) {
            self::delete_options();
        }

        if ($uninstall_tasks['delete_roles']) {
            self::delete_roles();
        }
    }

    /**
     * Load plugin
     */
    public function load_plugin(): void
    {
        // Load text domain
        load_plugin_textdomain('maverick', false, dirname(plugin_basename($this->plugin_file)) . '/languages');

        // Initialize plugin components
        $this->init_components();
    }

    /**
     * Create database tables
     */
    private function create_tables(): void
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        // Default database tables
        $tables = [
            'maverick_data' => [
                'columns' => [
                    'id' => 'bigint(20) NOT NULL AUTO_INCREMENT',
                    'name' => 'varchar(255) NOT NULL',
                    'value' => 'text NOT NULL',
                    'created_at' => 'datetime NOT NULL',
                    'updated_at' => 'datetime NOT NULL',
                ],
                'primary_key' => 'id',
                'indexes' => [
                    'name' => 'name',
                ],
            ],
        ];

        // Allow other plugins/themes to modify tables
        $tables = apply_filters('maverick_plugin_tables', $tables);

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        foreach ($tables as $table_name => $table_data) {
            $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}{$table_name} (";

            // Add columns
            $columns = [];
            foreach ($table_data['columns'] as $column_name => $column_def) {
                $columns[] = "{$column_name} {$column_def}";
            }

            // Add primary key
            if (!empty($table_data['primary_key'])) {
                $columns[] = "PRIMARY KEY ({$table_data['primary_key']})";
            }

            // Add indexes
            if (!empty($table_data['indexes'])) {
                foreach ($table_data['indexes'] as $index_name => $index_column) {
                    $columns[] = "KEY {$index_name} ({$index_column})";
                }
            }

            $sql .= implode(', ', $columns);
            $sql .= ") {$charset_collate};";

            dbDelta($sql);
        }
    }

    /**
     * Set default options
     */
    private function set_default_options(): void
    {
        $default_options = [
            'maverick_option_1' => 'default_value_1',
            'maverick_option_2' => 'default_value_2',
        ];

        foreach ($default_options as $option => $value) {
            if (get_option($option) === false) {
                update_option($option, $value);
            }
        }
    }

    /**
     * Create custom roles
     */
    private function create_roles(): void
    {
        add_role(
            'maverick_manager',
            __('Maverick Manager', 'maverick'),
            [
                'read' => true,
                'manage_maverick' => true,
            ]
        );
    }

    /**
     * Clear scheduled events
     */
    private function clear_schedules(): void
    {
        wp_clear_scheduled_hook('maverick_daily_cleanup');
    }

    /**
     * Clear transients
     */
    private function clear_transients(): void
    {
        delete_transient('maverick_cache');
    }

    /**
     * Drop database tables
     */
    private static function drop_tables(): void
    {
        global $wpdb;

        // Get all tables
        $tables = apply_filters('maverick_plugin_tables', [
            'maverick_data' => [],
        ]);

        // Drop each table
        foreach ($tables as $table_name => $table_data) {
            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}{$table_name}");
        }
    }

    /**
     * Delete options
     */
    private static function delete_options(): void
    {
        delete_option('maverick_option_1');
        delete_option('maverick_option_2');
    }

    /**
     * Delete custom roles
     */
    private static function delete_roles(): void
    {
        remove_role('maverick_manager');
    }

    /**
     * Initialize plugin components
     */
    private function init_components(): void
    {
        // Initialize components here
        // This is where you would load your plugin's main functionality
    }
}
