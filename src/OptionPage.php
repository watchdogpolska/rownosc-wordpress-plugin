<?php

namespace Rownosc;

class OptionPage {

    function init() {
        register_setting( 'rownosc', Options::OPTION_KEY );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
        add_action( 'admin_menu', array( $this, 'options_page' ) );
        add_filter( 'plugin_action_links_' . R_PLUGIN_BASENAME, array( $this, 'add_action_links' ) );

    }

    function add_action_links ( $links ) {
        $mylinks = array(
            'settings' => '<a href="' . esc_url(admin_url( 'options-general.php?page=rownosc' )) . '">' . __( 'Settings', 'r' ) . '</a>',
            'support' => '<a href="http://siecobywatelska.pl/">' . __( 'Support', 'r' ) . '</a>',
        );
        return array_merge( $mylinks, $links);
    }

    function settings_init() {

        register_setting( 'rownosc', Options::OPTION_KEY );

        add_settings_section(
            'r_general', __( 'General', 'r' ), null, 'rownosc'
        );

        add_settings_section(
            'r_autorization', __( 'Authorization', 'r' ), null, 'rownosc'
        );


        add_settings_field(
            'endpoint_page',
            __( 'Endpoint page', 'r' ),
            array($this, 'combo_select_page'),
            'rownosc',
            'r_general',
            array(
                'class' => 'r_row',
                'label_for' => 'endpoint_page'
            )
        );

        add_settings_field(
            'token',
            __( 'Access Token', 'r' ),
            array($this, 'field_text_cb'),
            'rownosc',
            'r_autorization',
            array(
                'class' => 'r_row',
                'label_for' => 'token',
            )
        );

	    add_settings_field(
		    'site_id',
		    __( 'Sites ID', 'r' ),
		    array($this, 'field_text_cb'),
		    'rownosc',
		    'r_autorization',
		    array(
			    'class' => 'r_row',
			    'label_for' => 'site_id',
		    )
	    );


    }


    function field_text_cb($args) {
        ?>
        <input id="<?php echo esc_attr( $args['label_for'] ); ?>"
               name="r_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
               value="<?= Options::get($args['label_for']); ?>"
               class="regular-text"
               type="text">
        <?php
    }

    function combo_select_page($args) {
        wp_dropdown_pages(
            array(
                'id' => $args['label_for'],
                'name' => 'r_options[endpoint_page]',
                'echo' => 1,
                'show_option_none' => __( '&mdash; Select &mdash;' ),
                'option_none_value' => '0',
                'selected' => Options::get($args['label_for'])
            )
        );
    }
    /**
     * top level menu
     */
    function options_page() {
        // add top level menu page
        add_options_page(
            __('Równość.info Integration', 'r'),
            __('Równość.info'),
            'manage_options',
            'rownosc',
            array( $this, 'options_page_html' )
        );
    }


    function options_page_html() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        settings_errors( 'r_messages' );
        ?>
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields( 'rownosc' );
                do_settings_sections( 'rownosc' );
                submit_button( __('Save Settings', 'r') );
                ?>
            </form>
        </div>
        <?php
    }
}