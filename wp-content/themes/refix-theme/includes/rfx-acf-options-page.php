<?php
/**
 * Plugin Name:       REFIX ACF Options Page
 * Plugin URI:        https://refix.pl/
 * Description:       Tworzy stronę z opcjami przez pola ACF.
 * Version:           1.0
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            Piotr Pac
 * Author URI:        https://refix.pl/
 * Update URI:        https://refix.pl/
 * Text Domain:       refix
 * Domain Path:       /languages
 */


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'REFIX General Settings',
		'menu_title'	=> 'Refix Settings',
		'menu_slug' 	=> 'refix-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
} else {
	function no_acf_notice(){
		?>
		<div class="error notice">
			<p>Wtyczka <b> REFIX ACF Options Page </b> do prawidłowego działania potrzebuje zainstalowania wtyczki ACF PRO</p>
		</div>
		<?php
	}// no_acf_notice()
	add_action( 'admin_notices', 'no_acf_notice' );
}//koniec ifa




add_shortcode('rfx_option', 'rfx_option');
function rfx_option($atts){

	if( ! class_exists('ACF') )  {
		return 'ACF : nie jest zainstalowany!';
	}

	extract(shortcode_atts(array(
		'pole' => '',
		'repeater' => '',
	 ), $atts));

	 $wartosc = get_field($pole, 'option');


	if(!$wartosc) {
		$wartosc =  '<pre style="background:#f4f4f4; border:solid 1px;">Błędny shortcode "rfx_option" dla parametru pole = "'. $pole.'"</pre>';
	}

	if($pole == 'repeater'){
		$powtrzalne = get_field('repeater','option');
		$tresc = '';
		foreach($powtrzalne as $wiersz){
			
			if($repeater == $wiersz['nazwa_pola']) {
				$tresc = $wiersz['tresc'];	
			}
		}
		if($tresc) {
			$wartosc = $tresc;
		} else {
			$wartosc = '<pre style="background:#f4f4f4; border:solid 1px;">Błędny shortcode "rfx_option" dla parametru pole = "repeater" && repeater = "'. $repeater.'"</pre>';
		}
	}

	

	return $wartosc;


}//koniec rfx_option()


