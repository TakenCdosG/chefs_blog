<?php
// ReduxFramework Sample Config File
// For full documentation, please visit: https://docs.reduxframework.com
if ( !class_exists( 'Redux_Framework_sample_config' ) ) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if ( !class_exists( 'ReduxFramework' ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
            }

        }

        public function initSettings() {

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( !isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        public function setSections() {
            // General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __( 'General', 'familia' ),
                'fields' => array(
                    array(
                        'id'                    	=> 'section-general-post',
                        'type'                		=> 'info',
                        'icon'						=> 'el-icon-info-sign',
                        'title'    		            => __('Post Settings', 'familia'),
                        'desc'                	    => __('Post common settings.', 'familia'),
                    ),

                    array(
                        'id'                   		=> 'post_excerpt_length',
                        'type'                 		=> 'slider',
                        'title'                		=> __('Post Excerpt Length', 'familia'),
                        'default'              		=> 27,
                        'min'                  	    => 20,
                        'step'                 		=> 1,
                        'max'                   	=> 65,
                        'display_value'        		=> 'text'
                    ),

                    array(
                        'id'                        => 'share_buttons',
                        'type'                      => 'switch',
                        'title'                     => __('Display Share Buttons', 'familia'),
                        'desc'                      => __('Display share buttons in post detail.', 'familia'),
                        'default'                   => 1,
                    ),

                    array(
                        'id'                        => 'display_author_',
                        'type'                      => 'switch',
                        'title'                     => __('Display Author Bio', 'familia'),
                        'desc'                      => __('Display author bio in post detail.', 'familia'),
                        'default'                   => 1,
                    ),

                    array(
                        'id'                        => 'related_posts',
                        'type'                      => 'switch',
                        'title'                     => __('Display Related Articles', 'poris'),
                        'default'                   => 1,
                    ),

                    array(
                        'id'                        => 'display_comments',
                        'type'                      => 'switch',
                        'title'                     => __('Display Comments', 'familia'),
                        'desc'                      => __('Display comments in post detail.', 'familia'),
                        'default'                   => 1,
                    ),

                    array(
                        'id'                        => 'display_featured_post',
                        'type'                      => 'switch',
                        'title'                     => __('Display Featured Posts', 'familia'),
                        "default"                   => 1,
                    ),

                    array(
                        'id'                        => 'featured_post_cat',
                        'type'                      => 'select',
                        'data'                      => 'categories',
                        'multi'                     => true,
                        'title'                     => __('Featured Posts', 'familia'),
                        'desc'                      => __('Select category to display on featured post section. You can select more than one category. If there\'s no category defined it will display posts from all categories', 'familia'),
                        'required'                  => array('display_featured_post', 'equals', '1'),
                    ),

                    array(
                        'id'                        => 'featured_post_word_count',
                        'type'                      => 'select', 
                        'required'                  => array('display_featured_post', 'equals', '1'),
                        'title'                     => __('Limit Post Title', 'familia'),
                        'desc'                      => __('Post title word limit.', 'familia'),
                        'options'                   => array(
                                                        '1' => '1',
                                                        '2' => '2',
                                                        '3' => '3',
                                                        '4' => '4',
                                                        '5' => '5'
                                                    ),
                        'default'                   => '4'
                    ),

                    array(
                        'id'                        => 'display_featured_image',
                        'type'                      => 'switch',
                        'title'                     => __('Display Featured Image', 'familia'),
                        'desc'                      => __('Display featured image on single post', 'familia'),
                        "default"                   => 1,
                    ),
                )
            );

            // Appearance Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => __( 'Appearance', 'familia' ),
                'fields' => array(
                    array(
                        'id'                => 'logo_type',
                        'type'              => 'button_set',
                        'title'             => __('Logo Type', 'familia'), 
                        'desc'              => sprintf(__('Use site <a href="%s" target="_blank">title & desription</a> or use image logo.', 'familia'), admin_url('/options-general.php') ),
                        'options'           => array('1' => __('Site Title', 'familia'), '2' => __('Image', 'familia')),
                        'default'           => '2'
                    ),

                    array(
                        'id'                => 'logo_image',
                        'type'              => 'media', 
                        'url'               => true,
                        'required'          => array('logo_type', 'equals', '2'),
                        'title'             => __('Image Logo', 'familia'),
                        'output'            => 'true',
                        'desc'              => __('Upload your logo or type the URL on the text box.', 'familia'),
                        'default'           => array('url' => get_stylesheet_directory_uri() .'/images/logo.png'),
                    ),

                    array(
                        'id'                =>'favicon',
                        'type'              => 'media', 
                        'title'             => __('Favicon', 'familia'),
                        'output'            => 'true',
                        'mode'              => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'              => __('Upload your favicon.', 'familia'),
                        'default'           => array('url' => get_stylesheet_directory_uri().'/images/favicon.png'),
                    ),

                    array(
                        'id'                => 'custom_css',
                        'type'              => 'ace_editor',
                        'title'             => __('Custom CSS Codes', 'familia'),
                        'mode'              => 'css',
                        'theme'             => 'monokai',
                        'desc'              => __('Type your custom CSS codes here, alternatively you can also write down you custom CSS styles on the custom.css file located on the theme root directory.', 'moticia'),
                        'default'                   => ''
                    ),
                )
            );

             // Typography Settings
            $this->sections[] = array(
                'icon'    => 'el-icon-text-width',
                'title'   => __( 'Typography', 'familia' ),
                'fields'  => array(
                    array(
                        'id'                => 'site_title_font',
                        'type'              => 'typography',
                        'title'             => __('Site Title', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#logo .box-site-title h2.site-title'),
                        'default'           => array(
                            'font-family'       => 'Source Sans Pro',
                            'font-size'         => '50px',
                            'font-weight'       => '700',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'site_desc_font_wp',
                        'type'              => 'typography',
                        'title'             => __('Site Description in Logo', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('#logo h4.site-desc'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#cccccc'
                        )
                    ),

                    array(
                        'id'                => 'body_font',
                        'type'              => 'typography',
                        'title'             => __('Text Body', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => true,
                        'letter-spacing'    => false,
                        'output'            => array('body'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '14px',
                            'line-height'       => '24px',
                            'font-weight'       => '400',
                            'color'             => '#757575'
                        )
                    ),

                    array(
                        'id'                => 'main_menu_font',
                        'type'              => 'typography',
                        'title'             => __('Main Menu', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'letter-spacing'    => true,
                        'text-transform'    => true,
                        'output'            => array('.site-navigation ul.main-menu li a'),
                        'default'           => array(
                            'font-family'       => 'Playfair Display',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#eeeeee',
                            'letter-spacing'    => '1px',
                            'text-transform'    => 'uppercase'
                        )
                    ),

                    array(
                        'id'                => 'breadcrumbs_wp',
                        'type'              => 'typography',
                        'title'             => __('Breadcrumbs', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'text-transform'    => true,
                        'output'            => array('.breadcrumbs'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '12px',
                            'font-weight'       => '700',
                            'color'             => '#666'
                        )
                    ),

                    array(
                        'id'                => 'featured_posts_title_font',
                        'type'              => 'typography',
                        'title'             => __('Featured Post Title', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'all_styles'        => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'text-transform'    => true,
                        'output'            => array('#featured-posts h2.post-title'),
                        'default'           => array(
                            'font-family'       => 'Playfair Display',
                            'font-size'         => '26px',
                            'line-height'       => '28px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'posts_title_font',
                        'type'              => 'typography',
                        'title'             => __('Post Title', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'all_styles'        => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'text-transform'    => true,
                        'output'            => array('article.hentry header.entry-header h3.post-title'),
                        'default'           => array(
                            'font-family'       => 'Playfair Display',
                            'font-size'         => '25px',
                            'line-height'       => '30px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'title_post_detail',
                        'type'              => 'typography',
                        'title'             => __('Post Title Detail', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'output'            => array('article.hentry h1.post-title', 'h1.page-title', 'h1.entry-title', '.page-title h1'),
                        'default'           => array(
                            'font-family'       => 'Playfair Display',
                            'font-size'         => '40px',
                            'line-height'       => '45px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'archive_page_title',
                        'type'              => 'typography',
                        'title'             => __('Archive Page Detail', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'letter-spacing'    => false,
                        'output'            => array('#maincontent h2.archive-title'),
                        'default'           => array(
                            'font-family'       => 'Playfair Display',
                            'font-size'         => '30px',
                            'line-height'       => '40px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'post_category_font',
                        'type'              => 'typography',
                        'title'             => __('Post Category Font', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'all_styles'        => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'font-style'        => true,
                        'text-align'        => false,
                        'output'            => array('.post-category', '.post-category a'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '10px',
                            'line-height'       => '18px',
                            'font-weight'       => '400',
                            'color'             => '#df6d83'
                        )
                    ),

                    array(
                        'id'                => 'featured_post_category_font',
                        'type'              => 'typography',
                        'title'             => __('Featured Post Category Font', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'all_styles'        => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'font-style'        => true,
                        'text-align'        => false,
                        'output'            => array('#featured-posts .category span'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '10px',
                            'line-height'       => '11px',
                            'font-weight'       => '400',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'sidebar_widget_title_font',
                        'type'              => 'typography',
                        'title'             => __('Sidebar Widget Title', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'all_styles'        => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'letter-spacing'    => true,
                        'text-transform'    => true,
                        'output'            => array('#secondary-content h4.widget-title', '#footer-widgets h4.widget-title'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '13px',
                            'line-height'       => '20px',
                            'font-weight'       => '400',
                            'color'             => '#555555'
                        )
                    ),

                    array(
                        'id'                => 'sidebar_font',
                        'type'              => 'typography',
                        'title'             => __('Sidebar Font Style', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'letter-spacing'    => true,
                        'text-transform'    => true,
                        'output'            => array('#secondary-content .widget'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '12px',
                            'line-height'       => '20px',
                            'font-weight'       => '400',
                            'color'             => '#555555'
                        )
                    ),

                    array(
                        'id'                => 'entry_meta_font',
                        'type'              => 'typography',
                        'title'             => __('Entry Post Meta', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'all_styles'        => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'font-style'        => true,
                        'text-align'        => false,
                        'output'            => array('.entry-meta'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '12px',
                            'line-height'       => '18px',
                            'font-weight'       => '400',
                            'color'             => '#8fa6b3'
                        )
                    ),

                    array(
                        'id'                => 'post_format_quote_font',
                        'type'              => 'typography',
                        'title'             => __('Post Format Quote', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'font-style'        => true,
                        'letter-spacing'    => true,
                        'text-align'        => false,
                        'output'            => array('article.blog-post.hentry.quote-post blockquote'),
                        'default'           => array(
                            'font-family'       => 'Playfair Display',
                            'font-size'         => '36px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'single_post_section_font',
                        'type'              => 'typography',
                        'title'             => __('Single Post Section', 'familia'),
                        'desc'             => __('Section such as comment list, comment form, about author box, etc', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'text-transform'    => true,
                        'output'            => array('.article-widget h4.widget-title'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '20px',
                            'line-height'       => '25px',
                            'font-weight'       => '400',
                            'color'             => '#000',
                            'text-transform'    => 'none'
                        )
                    ),

                    array(
                        'id'                => 'post_tag_wp',
                        'type'              => 'typography',
                        'title'             => __('Tags Post Content', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'font-style'        => true,
                        'letter-spacing'    => true,
                        'text-align'        => false,
                        'output'            => array('article.hentry .tags'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '14px',
                            'font-weight'       => '400',
                            'color'             => '#8fa6b3'
                        )
                    ),

                    array(
                        'id'                => 'warrior_category_font',
                        'type'              => 'typography',
                        'title'             => __('Warrior Category Widget Number Font', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('li.category-list .number'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '30px',
                            'font-weight'       => '400',
                            'font-style'        => 'italic',
                            'line-height'       => '24px',
                            'color'             => '#c9c9c9'
                        )
                    ),

                    array(
                        'id'                => 'warrior_category_meta_font',
                        'type'              => 'typography',
                        'title'             => __('Warrior Category Widget Meta Font', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('li.category-list .detail .entry-meta'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '13px',
                            'font-weight'       => '400',
                            'line-height'       => '18px',
                            'color'             => '#989898'
                        )
                    ),

                    array(
                        'id'                => 'pagination_font',
                        'type'              => 'typography',
                        'title'             => __('Pagination', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'letter-spacing'    => true,
                        'output'            => array('.pagination'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                            'letter-spacing'    => '1px'
                        )
                    ),

                    array(
                        'id'                    => 'form_field_font',
                        'type'                  => 'typography',
                        'title'                 => __('Form Text Field', 'familia'),
                        'google'                => true,
                        'subsets'               => true,
                        'preview'               => true,
                        'line-height'           => false,
                        'text-transform'        => true,
                        'output'                => array('form input[type="text"]', 'form input[type="password"]', 'form input[type="email"]', 'select', 'form textarea', '.input textarea', 'form input[type="url"]'),
                        'default'               => array(
                                'font-family'       => 'Domine',
                                'font-size'         => '12px',
                                'font-weight'       => '400',
                                'color'             => '#858585',
                        )
                    ),

                    array(
                        'id'                => 'text-widgets-footer',
                        'type'              => 'typography',
                        'title'             => __('Footer Widget Text', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('footer#colophone #footer-widgets'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '14px',
                            'font-weight'       => '400',
                            'color'             => '#9e9e9e',
                            'line-height'       => '22px'
                        )
                    ),

                    array(
                        'id'                => 'comment_author_font',
                        'type'              => 'typography',
                        'title'             => __('Comment Author', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('.comments-widget ul li .comment-meta span.author'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '15px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                            'line-height'       => '24px'
                        )
                    ),

                    array(
                        'id'                => 'footer_oopyright_font',
                        'type'              => 'typography',
                        'title'             => __('Footer Font', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('#footer-bottom'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '14px',
                            'font-weight'       => '400',
                            'color'             => '#858585',
                            'line-height'       => '20px'
                        )
                    ),

                    array(
                        'id'                => 'image_caption',
                        'type'              => 'typography',
                        'title'             => __('Image Caption', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'letter-spacing'    => true,
                        'output'            => array('.wp-caption p.wp-caption-text'),
                        'default'           => array(
                            'font-family'       => 'Lato',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#c0c0c0',
                            'letter-spacing'    => '1px'
                        )
                    ),

                    array(
                        'id'                => 'heading_1',
                        'type'              => 'typography',
                        'title'             => __('Heading 1 (h1)', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#maincontent article.hentry .entry-content h1'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '40px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                        )
                    ),

                    array(
                        'id'                => 'heading_2',
                        'type'              => 'typography',
                        'title'             => __('Heading 2 (h2)', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#maincontent article.hentry .entry-content h2'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '32px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                        )
                    ),

                    array(
                        'id'                => 'heading_3',
                        'type'              => 'typography',
                        'title'             => __('Heading 3 (h3)', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#maincontent article.hentry .entry-content h3'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '27px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                        )
                    ),

                    array(
                        'id'                => 'heading_4',
                        'type'              => 'typography',
                        'title'             => __('Heading 4 (h4)', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#maincontent article.hentry .entry-content h4'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '22px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                        )
                    ),

                    array(
                        'id'                => 'heading_5',
                        'type'              => 'typography',
                        'title'             => __('Heading 5 (h5)', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#maincontent article.hentry .entry-content h5'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '16px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                        )
                    ),

                    array(
                        'id'                => 'heading_6',
                        'type'              => 'typography',
                        'title'             => __('Heading 6 (h6)', 'familia'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#maincontent article.hentry .entry-content h6'),
                        'default'           => array(
                            'font-family'       => 'Domine',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                        )
                    ),
                ),
            );

              
            // Color Settings
            $this->sections[] = array(
                'icon'    => 'el-icon-brush',
                'title'   => __( 'Colors', 'familia' ),
                'fields'  => array(
                     array(
                        'id'                    => 'main_link',
                        'type'                  => 'link_color',
                        'title'                 => __('Main Link Color in Post Content', 'familia'),
                        'active'                => false,
                        'output'                => array('#maincontent article.hentry .entry-content a'),
                        'default'               => array(
                                                    'regular'  => '#0277bd',
                                                    'hover'    => '#b71c1c',
                        )
                    ),

                    array(
                        'id'                    => 'main_menu_link',
                        'type'                  => 'link_color',
                        'title'                 => __('Main Menu Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('.site-navigation ul.main-menu li a'),
                        'default'               => array(
                                                    'regular'  => '#333333',
                                                    'hover'    => '#795548',
                        )
                    ),

                    array(
                        'id'                    => 'main_menu_sub_link',
                        'type'                  => 'link_color',
                        'title'                 => __('Sub Menu Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('.site-navigation ul.main-menu ul.sub-menu li a'),
                        'default'               => array(
                                                    'regular'  => '#555555',
                                                    'hover'    => '#555555',
                        )
                    ),

                    array(
                        'id'                    => 'site_title_link',
                        'type'                  => 'link_color',
                        'title'                 => __('Site Title Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('header#masthead .site-title h2.site-title a'),
                        'default'               => array(
                                                    'regular'  => '#ffffff',
                                                    'hover'    => '#df6d83',
                        )
                    ),

                    array(
                        'id'                    => 'feature-post',
                        'type'                  => 'link_color',
                        'title'                 => __('Feature Post Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('#featured-posts h2.post-title a'),
                        'default'               => array(
                                                    'regular'  => '#ffffff',
                                                    'hover'    => '#fff59d',
                        )
                    ),

                    array(
                        'id'                    => 'post_title_link',
                        'type'                  => 'link_color',
                        'title'                 => __('Post Title Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('article.hentry h3.post-title a', 'article.hentry h1.post-title a'),
                        'default'               => array(
                                                    'regular'  => '#333333',
                                                    'hover'    => '#b71c1c',
                        )
                    ),

                    array(
                        'id'                    => 'post_category',
                        'type'                  => 'link_color',
                        'title'                 => __('Category Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('.entry-header .post-category a'),
                        'default'               => array(
                                                    'regular'  => '#f57c00',
                                                    'hover'    => '#df6d83',
                        )
                    ),

                    array(
                        'id'                    => 'meta_post_wp',
                        'type'                  => 'link_color',
                        'title'                 => __('Post Meta Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('.entry-meta span a'),
                        'default'               => array(
                                                    'regular'  => '#2e7d32',
                                                    'hover'    => '#61bd66',
                        )
                    ),

                    array(
                        'id'                    => 'post_format_icon',
                        'type'                  => 'color_rgba',
                        'output'                => array('#maincontent article.hentry .format-icon:before'),
                        'title'                 => __('Icon Featured Image Color', 'familia'),
                        'default'               => array(
                                                    'color'     => '#fff',
                                                    'alpha'     => 1
                        ),
                        'options'               => array(
                                                    'show_input'                => true,
                                                    'show_initial'              => true,
                                                    'show_alpha'                => true,
                                                    'show_palette'              => true,
                                                    'show_palette_only'         => false,
                                                    'show_selection_palette'    => true,
                                                    'max_palette_size'          => 10,
                                                    'allow_empty'               => true,
                                                    'clickout_fires_change'     => false,
                                                    'choose_text'               => 'Choose',
                                                    'cancel_text'               => 'Cancel',
                                                    'show_buttons'              => true,
                                                    'use_extended_classes'      => true,
                                                    'palette'                   => null,  // show default
                                                    'input_text'                => 'Select Color'
                        ),                        
                    ),

                    array(
                        'id'                    => 'button_form_wp',
                        'type'                  => 'link_color',
                        'title'                 => __('Submit Button Color', 'familia'),
                        'active'                => false,
                        'output'                => array('form input[type="submit"]', 'form button[type="submit"]'),
                        'default'               => array(
                                                    'regular'  => '#fff',
                                                    'hover'    => '#fff',
                        )
                    ),

                    array(
                        'id'                    => 'post_tag_link_color_wp',
                        'type'                  => 'link_color',
                        'title'                 => __('Post Tag Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('article.hentry .tags a'),
                        'default'               => array(
                                                    'regular'       => '#666',
                                                    'hover'         => '#000'
                        )
                    ),

                    array(
                        'id'                    => 'button_sosmed',
                        'type'                  => 'link_color',
                        'title'                 => __('Social Media Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('.social ul li a'),
                        'default'               => array(
                                                    'regular'  => '#455a64',
                                                    'hover'    => '#455a64',
                        )
                    ),

                    array(
                        'id'                    => 'info-sidebar-color',
                        'type'                  => 'info',
                        'icon'                  => 'el-icon-info-sign',
                        'title'                 => __('Link Color in Sidebar', 'familia'),
                    ),

                    array(
                        'id'                    => 'sidebar_link_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Sidebar Widget Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('#secondary-content .widget a', '#secondary-content .widget a.detail h3.category-name'),
                        'default'               => array(
                                                    'regular'  => '#333333',
                                                    'hover'    => '#b71c1c'
                        )
                    ),

                    array(
                        'id'                    => 'tags_link_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Tag Widget Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('#secondary-content .widget_tag_cloud .tagcloud a'),
                        'default'               => array(
                                                    'regular'  => '#666',
                                                    'hover'    => '#000'
                        )
                    ),

                     array(
                        'id'                    => 'info-footer-color',
                        'type'                  => 'info',
                        'icon'                  => 'el-icon-info-sign',
                        'title'                 => __('Link Color in Footer', 'familia'),
                    ),

                    array(
                        'id'                    => 'footer_widgets_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Footer Widget Link Color', 'familia'),
                        'active'                => false,
                        'output'                => array('#footer-widgets a'),
                        'default'               => array(
                                                    'regular'  => '#333333',
                                                    'hover'    => '#b71c1c'
                        )
                    ),

                    array(
                        'id'                    => 'footer_social_media',
                        'type'                  => 'link_color',
                        'title'                 => __('Social Media Link Color in footer', 'familia'),
                        'active'                => false,
                        'output'                => array('#social-profiles ul li a'),
                        'default'               => array(
                                                    'regular'  => '#c0c0c0',
                                                    'hover'    => '#ddd'
                        )
                    ),

                    array(
                        'id'                    => 'info-background-color',
                        'type'                  => 'info',
                        'icon'                  => 'el-icon-info-sign',
                        'title'                 => __('Background Color', 'familia'),
                    ),

                    array(
                        'id'                    => 'background-header',
                        'type'                  => 'background',
                        'title'                 => __('Header Background', 'familia'),
                        'output'                => array('#masthead #main-header'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#ffffff',
                        )
                    ),

                    array( 
                        'id'                    => 'header-bottom-border',
                        'type'                  => 'border',
                        'title'                 => __('Header Bottom Border', 'familia'),
                        'style'                 => false,
                        'all'                   => false,
                        'top'                   => false,
                        'left'                  => false,
                        'right'                 => false,
                        'output'                => array('#masthead #main-header'),
                        'default'               => array(
                                                    'border-color'  => '#e9e9e9', 
                                                    'border-style'  => 'double', 
                                                    'border-bottom' => '4px',
                        )
                    ),  

                    array(
                        'id'                    => 'main_menu_sub_link_bg',
                        'type'                  => 'background',
                        'title'                 => __('Sub Menu Background Color', 'familia'),
                        'output'                => array('.site-navigation ul.main-menu ul.sub-menu'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#f9f9f9',
                        )
                    ),

                    array(
                        'id'                    => 'main_menu_sub_link_hover_bg',
                        'type'                  => 'background',
                        'title'                 => __('Sub Menu Background Hover Color', 'familia'),
                        'output'                => array('.site-navigation ul.main-menu ul.sub-menu li a:hover'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#f0f0f0',
                        )
                    ),

                    array(
                        'id'                    => 'bg-tags-sidebar',
                        'type'                  => 'background',
                        'title'                 => __('Tag Widget Background Color', 'familia'),
                        'output'                => array('#secondary-content .widget_tag_cloud .tagcloud a'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => 'transparent',
                        )
                    ),

                    array(
                        'id'                    => 'background-button',
                        'type'                  => 'background',
                        'title'                 => __('Submit Button Color', 'familia'),
                        'output'                => array('form input[type="submit"]', 'form button[type="submit"]'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#6dd087',
                        )
                    ),

                    array(
                        'id'                    => 'background-button-hover',
                        'type'                  => 'background',
                        'title'                 => __('Submit Button Hover Color', 'familia'),
                        'output'                => array('form input[type="submit"]:hover', 'form button[type="submit"]:hover'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#6dd087',
                        )
                    ),

                    array(
                        'id'                    => 'background-instagram-feed',
                        'type'                  => 'background',
                        'title'                 => __('Instagram Feed Background Heading', 'familia'),
                        'output'                => array('#instagram-feed-widget .heading'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#37474f',
                        )
                    ),

                    array(
                        'id'                    => 'background-footer-widgets',
                        'type'                  => 'background',
                        'title'                 => __('Footer Background', 'familia'),
                        'output'                => array('#footer-widgets'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#ffffff',
                        )
                    ),

                    array(
                        'id'                    => 'bg-footer-socialmedia',
                        'type'                  => 'background',
                        'title'                 => __('Social Media Background Color', 'familia'),
                        'output'                => array('#social-profiles'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#fefefe',
                        )
                    ), 

                    array( 
                        'id'                    => 'social_media_border',
                        'type'                  => 'border',
                        'title'                 => __('Social Media Top Border', 'familia'),
                        'output'                => array('#social-profiles'),
                        'all'                   => false,
                        'bottom'                => false,
                        'right'                 => false,
                        'left'                  => false,
                        'default'               => array(
                            'border-top'              => '1px', 
                            'border-color'            => '#f9f9f9', 
                            'border-style'            => 'solid'
                        )
                    ),

                    array(
                        'id'                    => 'background-postformat-icon',
                        'type'                  => 'background',
                        'title'                 => __('Post Format Background', 'familia'),
                        'output'                => array('#maincontent article.hentry .format-icon'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color' => '#e8c24f',
                        )
                    ),
                ),
            );


            // Social Networks
            $this->sections[] = array(
                'icon' => 'el el-user',
                'title' => __('Social Networks', 'familia'),
                'fields' => array(
                    array(
                        'id'                    => 'author_description',
                        'type'                  => 'textarea', 
                        'title'                 => __('Author Short Description', 'familia'),
                        'default'               => __('Write a short description about your self and what you do. That way your blog readers could get to know you better.', 'familia')
                    ),

                    array(
                        'id'                => 'author_avatar',
                        'type'              => 'media', 
                        'url'               => true,
                        'title'             => __('Author Avatar', 'familia'),
                        'output'            => 'true',
                        'default'           => array('url' => get_template_directory_uri() .'/images/avatar.jpg'),
                    ),

                    array(
                        'id'                    => 'url_facebook',
                        'type'                  => 'text', 
                        'title'                 => __('Facebook Profile', 'familia'),
                        'desc'                  => __('Your Facebook profile page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_twitter',
                        'type'                  => 'text', 
                        'title'                 => __('Twitter Profile', 'familia'),
                        'desc'                  => __('Your Twitter profile page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_instagram',
                        'type'                  => 'text', 
                        'title'                 => __('Instagram Profile', 'familia'),
                        'desc'                  => __('Your Instagram profile page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_gplus',
                        'type'                  => 'text', 
                        'title'                 => __('Google+ Profile', 'familia'),
                        'desc'                  => __('Your Google+ profile page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_flickr',
                        'type'                  => 'text', 
                        'title'                 => __('Flickr Profile', 'familia'),
                        'desc'                  => __('Your Flickr profile page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_linkedin',
                        'type'                  => 'text', 
                        'title'                 => __('LinkedIn Profile', 'familia'),
                        'desc'                  => __('Your LinkedIn profile page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_pinterest',
                        'type'                  => 'text', 
                        'title'                 => __('Pinterest Profile', 'familia'),
                        'desc'                  => __('Your Pinterest page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_youtube',
                        'type'                  => 'text', 
                        'title'                 => __('YouTube Profile', 'familia'),
                        'desc'                  => __('Your YouTube video page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),

                    array(
                        'id'                    => 'url_vimeo',
                        'type'                  => 'text', 
                        'title'                 => __('Vimeo Profile', 'familia'),
                        'desc'                  => __('Your Vimeo video page.', 'familia'),
                        'placeholder'           => 'http://',
                        'default'               => '#'
                    ),
                )
            );
        }


        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __( 'Theme Information 1', 'familia' ),
                'content'   => __( '<p>This is the tab content, HTML is allowed.</p>', 'familia' )
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __( 'Theme Information 2', 'familia' ),
                'content'   => __( '<p>This is the tab content, HTML is allowed.</p>', 'familia' )
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'familia' );
        }

        //  All the possible arguments for Redux.
        //  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'             => 'familia_option',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'         => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'      => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'            => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'       => true,
                // Show the sections below the admin menu item or not
                'menu_title'           => __( 'Theme Options', 'familia' ),
                'page_title'           => __( 'Theme Options', 'familia' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'       => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'     => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'            => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon'       => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority'   => 50,
                // Choose an priority for the admin bar menu
                'global_variable'      => '',
                // Ajax save
                'ajax_save'            => true,
                // Set a different name for your global variable other than the opt_name
                'dev_mode'             => false,
                // Show the time the page took to load, etc
                'update_notice'        => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer'           => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'        => 61,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'          => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'     => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'            => get_template_directory_uri() .'/images/warrior-icon.png',
                // Specify a custom URL to an icon
                'last_tab'             => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'            => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'            => 'warriorpanel',
                // Page slug used to denote the panel
                'save_defaults'        => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'         => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'         => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export'   => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'       => 60 * MINUTE_IN_SECONDS,
                'output'               => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'           => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'             => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'          => false,
                // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                    'hide'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/themewarrior',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/themewarrior',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://themeforest.net/user/ThemeWarriors/portfolio',
                'title' => 'See our portfolio',
                'icon' => 'el-icon-check'
            );

            // Panel Intro text -> before the form
            $this->args['intro_text'] = __( '<p>If you like this theme, please consider giving it a 5 star rating on ThemeForest. <a href="http://themeforest.net/downloads" target="_blank">Rate now</a>.</p>', 'familia' );

            // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'familia');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}