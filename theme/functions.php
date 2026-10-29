<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


// DRH Breadcrumb Shortcode
function drh_custom_breadcrumb_shortcode() {

    $home_url = home_url('/');

    // Current page title
    $current_title = get_the_title();

    ob_start();
    ?>
    
    <nav class="drh-breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url($home_url); ?>" class="drh-breadcrumb-home">
            HOME
        </a>

        <span class="drh-breadcrumb-separator">/</span>

        <span class="drh-breadcrumb-current">
            <?php echo esc_html($current_title); ?>
        </span>
    </nav>

    <?php
    return ob_get_clean();
}
add_shortcode('drh_breadcrumb', 'drh_custom_breadcrumb_shortcode');

/**
 * Back to top button (all pages).
 * Fixed bottom-right arrow, shown after scrolling; not rendered in admin / Elementor editor.
 */
function mindly_back_to_top_button() {
	if ( is_admin() || is_customize_preview() ) {
		return;
	}
	if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->preview ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		return;
	}
	?>
<style id="mindly-btt-css">
.mindly-btt{position:fixed;right:22px;bottom:92px;z-index:9990;width:48px;height:48px;margin:0;padding:0;border-radius:50%;
  border:1px solid rgba(255,255,255,.16);background:#111113;color:#c2d517;display:flex;align-items:center;justify-content:center;
  cursor:pointer;box-shadow:0 10px 30px rgba(0,0,0,.28);opacity:0;visibility:hidden;transform:translateY(12px);
  -webkit-tap-highlight-color:transparent;
  transition:opacity .25s ease,transform .25s ease,visibility .25s ease,background .2s ease,color .2s ease}
.mindly-btt.is-visible{opacity:1;visibility:visible;transform:none}
.mindly-btt:hover,.mindly-btt:focus-visible{background:#c2d517;color:#09090b}
.mindly-btt:focus-visible{outline:2px solid #c2d517;outline-offset:3px}
.mindly-btt svg{display:block}
@media (max-width:767px){.mindly-btt{right:14px;bottom:80px;width:44px;height:44px}}
@media print{.mindly-btt{display:none}}
</style>
<button type="button" id="mindly-btt" class="mindly-btt" aria-label="Torna su" title="Torna su">
	<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
</button>
<script>
(function(){
	var b=document.getElementById('mindly-btt'); if(!b) return;
	var ticking=false;
	function update(){ ticking=false; b.classList.toggle('is-visible',(window.pageYOffset||document.documentElement.scrollTop)>500); }
	window.addEventListener('scroll',function(){ if(!ticking){ ticking=true; requestAnimationFrame(update); } },{passive:true});
	b.addEventListener('click',function(){
		var reduce=window.matchMedia&&window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		window.scrollTo({top:0,behavior:reduce?'auto':'smooth'});
	});
	update();
})();
</script>
	<?php
}
add_action( 'wp_footer', 'mindly_back_to_top_button', 20 );

/**
 * Header: solid dark bar once the page is scrolled (keeps the menu readable on light/lime sections).
 * Adds .mm-scrolled to <body> after ~40px of scroll; the CSS targets the existing .header-sticky bars.
 */
function mindly_header_scrolled() {
	if ( is_admin() || is_customize_preview() ) {
		return;
	}
	if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->preview ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		return;
	}
	?>
<style id="mindly-header-scrolled-css">
.elementor-location-header #header-sticky,.elementor-location-header .header-sticky{transition:background-color .25s ease,border-color .25s ease,box-shadow .25s ease}
body.mm-scrolled .elementor-location-header #header-sticky,body.mm-scrolled .elementor-location-header .header-sticky{
  background-color:rgba(12,12,14,.92)!important;
  -webkit-backdrop-filter:blur(18px) saturate(1.3)!important;backdrop-filter:blur(18px) saturate(1.3)!important;
  border-color:rgba(255,255,255,.14)!important;
  box-shadow:0 12px 32px rgba(0,0,0,.28)!important}
</style>
<script>
(function(){
	var b=document.body, ticking=false;
	function upd(){ ticking=false; b.classList.toggle('mm-scrolled',(window.pageYOffset||document.documentElement.scrollTop)>40); }
	window.addEventListener('scroll',function(){ if(!ticking){ ticking=true; requestAnimationFrame(upd); } },{passive:true});
	upd();
})();
</script>
	<?php
}
add_action( 'wp_footer', 'mindly_header_scrolled', 25 );

/**
 * Fonts: Geist Mono self-hosted (variable, 100-900) and Geist as the base font of the site,
 * to match the design handoff. Elementor loads Geist itself (custom font).
 */
function mindly_fonts_css() {
	if ( is_admin() ) {
		return;
	}
	$dir = get_stylesheet_directory_uri() . '/fonts/';
	?>
<link rel="preload" href="<?php echo esc_url( $dir . 'GeistMono-latin.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
<style id="mindly-fonts-css">
@font-face{font-family:'Geist Mono';font-style:normal;font-weight:100 900;font-display:swap;
  src:url('<?php echo esc_url( $dir . 'GeistMono-latin-ext.woff2' ); ?>') format('woff2');
  unicode-range:U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C4, U+2113, U+2C60-2C7F, U+A720-A7FF}
@font-face{font-family:'Geist Mono';font-style:normal;font-weight:100 900;font-display:swap;
  src:url('<?php echo esc_url( $dir . 'GeistMono-latin.woff2' ); ?>') format('woff2');
  unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD}
html body{font-family:'Geist',sans-serif}
/* header/footer typography (aligned to the design handoff) */
html body .elementor-location-header .elementor-element-4315622 .elementor-heading-title,
html body .elementor-location-header .elementor-element-4315622 .elementor-heading-title a,
html body .elementor-location-header .elementor-element-5073355 .elementor-heading-title,
html body .elementor-location-header .elementor-element-5073355 .elementor-heading-title a{font-size:15px!important;font-weight:600!important;letter-spacing:.14em!important;line-height:1!important}
html body .elementor-location-header .elementor-element-4315622 .elementor-heading-title span:last-of-type,
html body .elementor-location-header .elementor-element-5073355 .elementor-heading-title span:last-of-type{font-size:8.5px!important;font-weight:400!important;letter-spacing:.38em!important}
html body .elementor-location-header .e-n-menu-title-text{font-size:13.5px!important;font-weight:500!important}
html body .elementor-location-header .e-n-menu-title-text .number,
html body .elementor-location-header .number{font-family:'Geist Mono',monospace!important;font-size:10.5px!important;font-weight:500!important}
html body .elementor-location-header .elementor-button .elementor-button-text{font-size:13.5px!important;font-weight:600!important}
html body .elementor-location-footer .elementor-element-d119ca9 .elementor-heading-title{font-size:24px!important;font-weight:500!important;letter-spacing:-.025em!important;line-height:1.25!important}
html body .elementor-location-footer .elementor-element-6d1a54c .elementor-icon-list-text,
html body .elementor-location-footer .elementor-element-6e12e38 .elementor-icon-list-text{font-size:14.5px!important;font-weight:400!important}
html body .elementor-location-footer .elementor-element-6d1a54c .elementor-icon-list-text{line-height:1.7!important}
html body .elementor-location-footer .elementor-element-a63a28e .elementor-icon-list-text,
html body .elementor-location-footer .elementor-element-05b3f8c .elementor-icon-list-text{font-size:14px!important;font-weight:400!important}
html body .elementor-location-footer .elementor-element-6aa146c .elementor-heading-title,
html body .elementor-location-footer .elementor-element-b20ce76 .elementor-heading-title,
html body .elementor-location-footer .elementor-element-e045c54 .elementor-heading-title,
html body .elementor-location-footer .elementor-element-d0209c2 .elementor-heading-title,
html body .elementor-location-footer .elementor-element-a513e8f .elementor-heading-title,
html body .elementor-location-footer .elementor-element-a513e8f .elementor-heading-title a,
html body .elementor-location-footer .elementor-element-ac42dcb .elementor-heading-title,
html body .elementor-location-footer .elementor-element-ac42dcb .elementor-heading-title a,
html body .elementor-location-footer .elementor-element-e045c54 .elementor-heading-title a{font-family:'Geist Mono',monospace!important;font-size:11px!important;font-weight:400!important;letter-spacing:.14em!important}
html body .elementor-location-footer .elementor-element-c1e2add .elementor-heading-title,
html body .elementor-location-footer .elementor-element-803d266 .elementor-heading-title{font-size:14px!important;font-weight:400!important;line-height:1.65!important}
html body .elementor-location-footer .elementor-element-803d266 .elementor-heading-title b{font-weight:600!important}
html body .elementor-location-footer .elementor-element-b70344f .elementor-heading-title{font-family:'Geist Mono',monospace!important;font-size:12px!important;font-weight:400!important;letter-spacing:.04em!important}
</style>
	<?php
}
add_action( 'wp_head', 'mindly_fonts_css', 5 );

/* Reserve image space (aspect-ratio) so lazy-loaded images do not shift the page (fixes #anchor scrolling) */
function mindly_image_ratio_css() {
	if ( is_admin() ) {
		return;
	}
	$map = array(
		'11'  => array( '2500/750' => array( 'a7a3da4', '21c9c23', 'b05d2e0', '5a30770', 'aeab9b2' ), '950/550' => array( 'eb77183' ), '1500/650' => array( 'c0214b3' ) ),
		'416' => array( '950/534' => array( 'b1c377a' ), '1500/650' => array( 'c0214b3' ) ),
		'443' => array( '950/547' => array( '99038ff' ), '2500/750' => array( '7814c3f', 'f5d4a41' ), '1500/650' => array( 'c0214b3' ) ),
		'518' => array( '950/950' => array( '99038ff' ), '1500/735' => array( '429216f' ), '950/550' => array( '44b71e6', '52b1142' ), '1500/650' => array( 'c0214b3' ) ),
		'632' => array( '1500/650' => array( 'e6313d3' ) ),
		'548' => array( '1500/650' => array( '68cb0ff' ) ),
		'531' => array( '1500/650' => array( '162e525' ) ),
	);
	$css = '';
	foreach ( $map as $page => $ratios ) {
		foreach ( $ratios as $ratio => $ids ) {
			$sel = array();
			$wsel = array();
			foreach ( $ids as $id ) {
				$sel[]  = 'body.page-id-' . $page . ' .elementor-element-' . $id . ' img';
				$wsel[] = 'body.page-id-' . $page . ' .elementor-element-' . $id;
			}
			$css .= implode( ',', $wsel ) . '{width:100%}';
			$css .= implode( ',', $sel ) . '{aspect-ratio:' . $ratio . ';width:100%}';
		}
	}
	echo '<style id="mindly-img-ratio">' . $css . '</style>' . "\n";
}
add_action( 'wp_head', 'mindly_image_ratio_css', 40 );