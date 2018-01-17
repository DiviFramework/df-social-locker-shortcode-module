<?php
namespace DF\SocialLocker;

/**
 * Plugins Helper class.
 */
class Plugins
{

    //container.
    protected $container;

    /**
     * Constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Check Dependancies
     */
    public function checkDependancies()
    {
        include_once(ABSPATH . 'wp-admin/includes/plugin.php');

        $is_free_version_active = is_plugin_active('social-locker/sociallocker-next.php');
        $is_pro_version_active = is_plugin_active('sociallocker-next-premium/sociallocker-next.php');

        if ($is_free_version_active || $is_pro_version_active) {
            return;
        }

        $container = $this->container;

        add_action('admin_notices', function () use ($container) {
            $class = 'notice notice-error is-dismissible';
            $message = sprintf('<b>%s</b> requires <b>%s</b> plugin to be installed and activated.', $container['plugin_name'], 'Social Locker | BizPanda');

            printf('<div class="%1$s"><p>%2$s</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>', $class, $message);
        });
    }
}
