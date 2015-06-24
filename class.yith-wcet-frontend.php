<?php
/**
 * Frontend class
 *
 * @author Yithemes
 * @package YITH WooCommerce Email Templates
 * @version 1.1.1
 */

if ( ! defined( 'YITH_WCET' ) ) { exit; } // Exit if accessed directly

require_once('functions.yith-wcet.php');

if( ! class_exists( 'YITH_WCET_Frontend' ) ) {
    /**
     * Frontend class.
     * The class manage all the Frontend behaviors.
     *
     * @since 1.0.0
     * @author   Leanza Francesco <leanzafrancesco@gmail.com>
     */
    class YITH_WCET_Frontend {

        /**
         * Single instance of the class
         *
         * @var \YITH_WCQV_Frontend
         * @since 1.0.0
         */
        protected static $instance;

        /**
         * Plugin version
         *
         * @var string
         * @since 1.0.0
         */
        public $version = YITH_WCET_VERSION;


        public $this_is_product = NULL;

        public $templates = array();


        /**
         * Constructor
         *
         * @access public
         * @since 1.0.0
         */
        public function __construct() {

            add_filter('wc_get_template', array( $this, 'custom_template') , 999, 5 );

            add_action( 'yith_wcet_email_header', array( $this, 'email_header' ), 10, 2);
            add_action( 'yith_wcet_email_footer', array( $this, 'email_footer' ), 10, 1);

            add_filter( 'woocommerce_email_styles', '__return_empty_string' );
            add_filter( 'woocommerce_mail_content', array( $this, 'mail_content_styling' ) );
        }

        /**
        * Email Header
        * It's used to pass $mail_type to template email-header
        * @access public
        * @since 1.0.0
        * @author   Leanza Francesco <leanzafrancesco@gmail.com>
        */
        public function email_header( $email_heading, $mail_type){
            wc_get_template( 'emails/email-header.php', array( 'email_heading' => $email_heading, 'mail_type' => $mail_type ) );
        }

        /**
        * Email Footer
        * It's used to pass $mail_type to template email-footer
        * @access public
        * @since 1.0.0
        * @author   Leanza Francesco <leanzafrancesco@gmail.com>
        */
        public function email_footer( $mail_type){
            wc_get_template( 'emails/email-footer.php', array( 'mail_type' => $mail_type ) );
        }

        /**
        * Mail Content Styling
        * 
        * This func transforms css style of the mail in inline style; and return the content with the inline style
        * @return string
        * @access public
        * @since 1.0.0
        * @author   Leanza Francesco <leanzafrancesco@gmail.com>
        */
        public function mail_content_styling( $content ){
            // get CSS styles
            ob_start();
            wc_get_template( 'emails/email-styles.php');
            $css = ob_get_clean();

            try {
                // apply CSS styles inline for picky email clients
                $emogrifier = new Emogrifier( $content, $css );
                $content = $emogrifier->emogrify();

            } catch ( Exception $e ) {

                $logger = new WC_Logger();

                $logger->add( 'emogrifier', $e->getMessage() );
            }

            return $content;
        }

        /**
        * Custom Template
        * 
        * Filters wc_get_template for custom templates
        * @return string
        * @access public
        * @since 1.0.0
        * @author   Leanza Francesco <leanzafrancesco@gmail.com>
        */
        public function custom_template($located, $template_name, $args, $template_path, $default_path){
            
            $this->_templates = array(
                'emails/customer-new-account.php',
                'emails/customer-reset-password.php',
                'emails/email-addresses.php',
                'emails/email-footer.php',
                'emails/email-header.php',
                'emails/email-order-items.php',
                'emails/email-styles.php'
            );

            if( in_array( $template_name, $this->_templates ) )
            return YITH_WCET_TEMPLATE_PATH . '/' . $template_name;

            return $located;
        }

        /**
         * Returns single instance of the class
         *
         * @return \YITH_WCQV_Frontend
         * @since 1.0.0
         */
        public static function get_instance(){
            if( is_null( self::$instance ) ){
                self::$instance = new self();
            }

            return self::$instance;
        }
    }
}
/**
 * Unique access to instance of YITH_WCET_Frontend class
 *
 * @return \YITH_WCET_Frontend
 * @since 1.0.0
 */
function YITH_WCET_Frontend(){
    return YITH_WCET_Frontend::get_instance();
}
?>
