<?php
namespace Social_Locker_Divi_Modules\SocialLockerStartModule;

use ET_Builder_Module;
use ET_Builder_Element;
use WP_Query;

/**
 *
 */
class SocialLockerStartModule extends ET_Builder_Module
{
    public $name = 'DF - Social Locker Start';
    public $slug = 'df_social_locker_start';
    public $fields;
    protected $container;
    public $vb_support = 'on';

    protected $module_credits = array(
        'module_uri' => 'https://www.diviframework.com',
        'author'     => 'Divi Framework',
        'author_uri' => 'https://www.diviframework.com',
    );

    public function __construct($container)
    {
        $this->container = $container;
        $this->initFields();
        parent::__construct();
    }


    /**
     * Initialise the fields.
     */
    private function initFields()
    {
        $this->fields = array();

        $this->fields['id'] = array(
            'label' => 'Select Locker',
            'type' => 'select',
            'options' => $this->get_lockers(),
            'default' => '',
        );


        $this->fields['admin_label'] = array(
            'label'       => __('Admin Label', 'et_builder'),
            'type'        => 'text',
            'description' => __('This will change the label of the module in the builder for easy identification.', 'et_builder'),
            );
    }


    /**
     * List of the social blocker locks.
     */
    public function get_lockers()
    {
        $list = array('' => 'Select One');

        $posts = get_posts(array(
            'post_type' => 'opanda-item',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'suppress_filters' => true,
            ));

        if ($posts) {
            foreach ($posts as $post) {
                $list[$post->ID] = $post->post_title;
            }
        }


        return $list;
    }

    /**
     * Init module.
     */
    public function init()
    {
        $this->whitelisted_fields = array_keys($this->fields);

        if (strpos($this->slug, 'et_pb_') !== 0) {
            $this->slug = 'et_pb_'.$this->slug;
        }

        $defaults = array();

        foreach ($this->fields as $field => $options) {
            if (isset($options['default'])) {
                $defaults[$field] = $options['default'];
            }
        }

        $this->field_defaults = $defaults;
    }

    /**
     * Get Fields
     *
     */
    public function get_fields()
    {
        return $this->fields;
    }

    /**
     * Shortcode render.
     */
    public function render($atts, $content = null, $function_name)
    {
        $atts = wp_parse_args($atts, array('id'));
        return sprintf("[sociallocker id='%s']", $atts['id']);
    }


    protected function _render_module_wrapper($output = '', $render_slug = '')
    {
        return $output;
    }
}
