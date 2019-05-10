<?php
namespace DF\SocialLocker;

use Pimple\Container as PimpleContainer;

/**
 * DI Container.
 */
class Container extends PimpleContainer
{

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initObjects();
    }

    /**
     * Define dependancies.
     */
    public function initObjects()
    {
        $this['activation'] = function ($container) {
            return new Activation($container);
        };

        $this['divi_modules'] = function ($container) {
            return new DiviModules($container);
        };

        $this['plugins'] = function ($container) {
            return new Plugins($container);
        };

        $this['themes'] = function ($container) {
            return new Themes($container);
        };

    }

    /**
     * Start the plugin
     */
    public function run()
    {
        // divi module register.
        add_action('et_builder_ready', array($this['divi_modules'], 'register'), 1);
        add_action('divi_extensions_init', [$this['divi_modules'], 'register_extensions']);

        // check for plugin dependancies.
        add_action('plugins_loaded', array($this['plugins'], 'checkDependancies'));
        add_action('plugins_loaded', array($this['themes'], 'checkDependancies'));

        add_filter('the_content', array($this, 'the_content_social_locker_shortcode'), 10000);

        add_action('admin_head', array($this, 'flushLocalStorage'));

        // remove divi frontend builder styles since we don't want them.
        add_action('wp_print_styles', [$this['divi_modules'], 'wp_print_styles']);
    }

    /**
     * Process the shortcode.
     */
    public function the_content_social_locker_shortcode($content)
    {
        if (strpos($content, '[/sociallocker]')) {
            $content = do_shortcode($content);
        }
        return $content;
    }

    /**
     * Flush local storage items.
     *
     * @return [type] [description]
     */
    public function flushLocalStorage()
    {
        echo "<script>" .
        "localStorage.removeItem('et_pb_templates_et_pb_df_social_locker_end');" .
        "localStorage.removeItem('et_pb_templates_et_pb_df_social_locker_start');" .
        "</script>";
    }

}
