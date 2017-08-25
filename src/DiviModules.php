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
        new SocialLockerStartModule($this->container);
        new SocialLockerEndModule($this->container);
    }
}
