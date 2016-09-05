<?php
// Custom Functions

// Add home or internal class to body tag
function body_classes($classes) {

  $classes[] = is_front_page() ? 'home' : 'internal';
  return $classes;

}
add_filter('body_class', 'body_classes', 10, 1);

// Allow SVG files to be uploaded via Media Library
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Remove Emoji Support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Tweet
function get_tweet() {
require dirname( __FILE__ ) . '/twitter/tmhOAuth.php';
require dirname( __FILE__ ) . '/twitter/tmhUtilities.php';
$tmhOAuth = new tmhOAuth(array(
  'consumer_key'        => 'jJEOMbyUQq3PGL6dVYjcyWQqv',
  'consumer_secret'     => 'z6sMzBKE6yIoHjY8wUlYxr30ctzpN8OsRJdpXW986zVL2vJpiL',
  'user_token'          => '338781770-LimiozRWBNR5sljOM3oMpunIdkM5OOlnR9Imwprp',
  'user_secret'         => 'sRs92EI3bVQSnsWFW0F5tME5MEAh8Uj6dO76R1epz1HpP',
  'curl_ssl_verifypeer' => false
));
$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
  'screen_name' => 'username',
  'count' => '1'
));
$response = $tmhOAuth->response['response'];
$tweets = json_decode($response, true);
foreach($tweets as $tweet):
  ?>
  <!-- Begin tweet -->
  <p class="tweet">
    <?php
    // Access as an object
    $tweetText = $tweet['text'];
    $tweetDate = strtotime($tweet['created_at']);
    //Convert urls to <a> links
    $tweetText = preg_replace('/https?:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank" rel="nofollow">http://$1</a>', $tweetText);
    //Convert attags to twitter profiles in &lt;a&gt; links
    $tweetText = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank" rel="nofollow">@$1</a>', $tweetText);
    //Convert hashtags to twitter searches in <a> links
    $tweetText = preg_replace('/#([A-Za-z0-9\/\.]*)/', '<a href="http://twitter.com/search?q=$1" target="_blank" rel="nofollow">#$1</a>', $tweetText);
    // Output
    echo $tweetText;
    ?>
  </p>
  <!-- End tweet -->
<?php
endforeach;
}
 
/* ------------------------------------------------------------------------
  Google Tag Manager - admin field
------------------------------------------------------------------------ */
/*$googletagmanager = new googletagmanager();

class googletagmanager {
    function googletagmanager( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'googletagmanager', 'esc_attr' );
        add_settings_field('googletagmanager', '<label for="googletagmanager">'.__('Google Tag Manager ID' , 'googletagmanager' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'googletagmanager', '' );
        echo '<input type="text" id="googletagmanager" name="googletagmanager" value="' . $value . '" />';
    }
}*/

/* ------------------------------------------------------------------------
  Birdbrain settings - Admin options page
------------------------------------------------------------------------ */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Birdbrain Settings',
		'menu_title'	=> 'Birdbrain',
		'menu_slug' 	=> 'birdbrain',
    'icon_url'    =>  get_template_directory_uri() . '/lib/img/bb.png',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));

  acf_add_options_sub_page(array(
		'page_title' 	=> 'Contact Information',
		'menu_title' 	=> 'Contact Information',
		'parent_slug' 	=> 'birdbrain',
	));

  acf_add_options_sub_page(array(
		'page_title' 	=> 'SEO & Social',
		'menu_title' 	=> 'SEO & Social',
		'parent_slug' 	=> 'birdbrain',
	));
}

/* ------------------------------------------------------------------------
  Change Wordpress admin login logo
------------------------------------------------------------------------ */
add_action("login_head", "my_login_head");
function my_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/assets/img/birdbrain.svg') no-repeat scroll center top transparent;
    background-size: contain;
		height: 90px;
		width: 100%;
    margin-bottom: 20px;
	}
	</style>
	";
}

/* ------------------------------------------------------------------------
  Admin footer modification
------------------------------------------------------------------------ */
function remove_footer_admin ()
{
    echo '<span id="footer-thankyou">Developed by <a href="https://www.birdbrain.com.au" target="_blank">Birdbrain</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
?>
