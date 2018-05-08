<?php
/**
 * @package BokPlugin
 */

namespace Inc;

final class Init{

    /**
     * @return array full list all classes
     */
    public static function get_services(){
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingLink::class,
        ];
    }

    public static function register_services()
    {
        foreach (self::get_services() as $class){
            $service = self::instantiate( $class );

            if( method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    private static function instantiate( $class ){
        $service = new $class();
        return $service;
    }

}




/*class BokPlugin
{

    public $plugin;

    function __construct()
    {
        $this->plugin = plugin_basename(__FILE__);
    }


    function register()
    {
        // wp_enqueue_scripts
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));

        add_action('admin_menu', array($this, 'add_admin_pages'));

        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    }

    public function settings_link($links){
        $settings_link = '<a href="admin.php?page=bok_plugin">Settings</a>';
        array_push($links,$settings_link);
        return $links;
    }
    public function add_admin_pages()
    {
        add_menu_page(
            'Bok Plugin',
            'Bok',
            'manage_options',
            'bok_plugin',
            array($this, 'admin_index'),
            'dashicons-carrot',
            2
        );

    }

    public function admin_index()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }

    protected function create_post_type()
    {
        add_action('init', array($this, 'custom_post_type'));
    }

    function custom_post_type()
    {
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }

    function enqueue()
    {
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyles.css', __FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
    }

    function activate()
    {
        // require_once plugin_dir_path(__FILE__) . 'inc/bok-plugin-activate.php';
        Activate::activate();
    }

}

if(class_exists('BokPlugin') )
{
    $bokPlugin = new BokPlugin();
    $bokPlugin->register();
}
//activate
register_activation_hook(__FILE__, array($bokPlugin, 'activate'));

//deactivate
// require_once plugin_dir_path( __FILE__) . 'inc/bok-plugin-deactivate.php';
register_deactivation_hook(__FILE__, array('Deactivate', 'deactivate'));*/
