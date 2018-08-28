<?php
namespace DF\SocialLocker;

/**
 * Register divi modules
 */
class DiviModules
{

    protected $container;


    public function __construct($container)
    {
        $this->container = $container;
    }



    /**
     * Register divi modules.
     */
    public function register()
    {
        new \Social_Locker_Divi_Modules\SocialLockerStartModule\SocialLockerStartModule($this->container);
        new \Social_Locker_Divi_Modules\SocialLockerEndModule\SocialLockerEndModule($this->container);
    }

    public function register_extensions(){
        new \Social_Locker_Divi_Modules\SocialLockerEndExtension($this->container);
        new \Social_Locker_Divi_Modules\SocialLockerStartExtension($this->container);
    }

    public function wp_print_styles(){
        // divi frontend builder styles. 
        wp_dequeue_style( 'et_pb_df_social_locker_start-styles' );
        wp_dequeue_style( 'et_pb_df_social_locker_end-styles' );
        
   }

}
