<?php

/*
Plugin Name: FxWidget
Plugin URI: http://www.finango.de/fxwidget
Description: Shows official ECB conversion rates for the Euro
Version: 0.1
Author: Finango
Author URI: http://www.finango.de/

Copyright 2010 Finango  (email : mail@finango.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


class Fx_Widget extends WP_Widget {

	function Fx_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'fx_widget', 'description' => __('Shows ECB exchange rates for the Euro.', 'fxwidget') );

		/* Widget control settings. */
		// $control_ops = array( 'width' => 350, 'height' => 350, 'id_base' => 'fx_widget-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'fx_widget-widget', __('FxWidget', 'fxwidget'), $widget_ops );
	}
	
	function widget($args, $instance) {
		global $wp_query,$wpdb,$wp_rewrite;
		
		extract($args);

		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );		
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Euro Exchange Rates', 'fxwidget' ) : $instance['title']);
		// $title = apply_filters('widget_title', empty( $instance['title'] ) ? 'Euro Exchange Rates' : $instance['title']);
		$usd = isset($instance['usd']) ? (bool) $instance['usd'] :true;
		$jpy = isset($instance['jpy']) ? (bool) $instance['jpy'] :true;
		$bgn = isset($instance['bgn']) ? (bool) $instance['bgn'] :true;
		$czk = isset($instance['czk']) ? (bool) $instance['czk'] :true;
		$dkk = isset($instance['dkk']) ? (bool) $instance['dkk'] :true;
		$eek = isset($instance['eek']) ? (bool) $instance['eek'] :true;
		$gbp = isset($instance['gbp']) ? (bool) $instance['gbp'] :true;
		$huf = isset($instance['huf']) ? (bool) $instance['huf'] :true;
		$ltl = isset($instance['ltl']) ? (bool) $instance['ltl'] :true;
		$lvl = isset($instance['lvl']) ? (bool) $instance['lvl'] :true;
		$pln = isset($instance['pln']) ? (bool) $instance['pln'] :true;
		$ron = isset($instance['ron']) ? (bool) $instance['ron'] :true;
		$sek = isset($instance['sek']) ? (bool) $instance['sek'] :true;
		$chf = isset($instance['chf']) ? (bool) $instance['chf'] :true;
		$nok = isset($instance['nok']) ? (bool) $instance['nok'] :true;
		$hrk = isset($instance['hrk']) ? (bool) $instance['hrk'] :true;
		$rub = isset($instance['rub']) ? (bool) $instance['rub'] :true;
		$try = isset($instance['try']) ? (bool) $instance['try'] :true;
		$aud = isset($instance['aud']) ? (bool) $instance['aud'] :true;
		$brl = isset($instance['brl']) ? (bool) $instance['brl'] :true;
		$cad = isset($instance['cad']) ? (bool) $instance['cad'] :true;
		$cny = isset($instance['cny']) ? (bool) $instance['cny'] :true;
		$hkd = isset($instance['hkd']) ? (bool) $instance['hkd'] :true;
		$idr = isset($instance['idr']) ? (bool) $instance['idr'] :true;
		$inr = isset($instance['inr']) ? (bool) $instance['inr'] :true;
		$krw = isset($instance['krw']) ? (bool) $instance['krw'] :true;
		$mxn = isset($instance['mxn']) ? (bool) $instance['mxn'] :true;
		$myr = isset($instance['myr']) ? (bool) $instance['myr'] :true;
		$nzd = isset($instance['nzd']) ? (bool) $instance['nzd'] :true;
		$php = isset($instance['php']) ? (bool) $instance['php'] :true;
		$sgd = isset($instance['sgd']) ? (bool) $instance['sgd'] :true;
		$thb = isset($instance['thb']) ? (bool) $instance['thb'] :true;
		$zar = isset($instance['zar']) ? (bool) $instance['zar'] :true;
		
		$footerlink = isset($instance['footerlink']) ? (bool) $instance['footerlink'] :true;
				
		echo $before_widget.$before_title.$title.$after_title;
		$rates = $this->getRates();
		if($rates) {
			echo '<table>';
			if($aud) {echo '<tr><td>AUD</td><td>'.$rates['AUD'].'</td></tr>';}
			if($bgn) {echo '<tr><td>BGN</td><td>'.$rates['BGN'].'</td></tr>';}
			if($brl) {echo '<tr><td>BRL</td><td>'.$rates['BRL'].'</td></tr>';}
			if($cad) {echo '<tr><td>CAD</td><td>'.$rates['CAD'].'</td></tr>';}
			if($chf) {echo '<tr><td>CHF</td><td>'.$rates['CHF'].'</td></tr>';}
			if($cny) {echo '<tr><td>CNY</td><td>'.$rates['CNY'].'</td></tr>';}
			if($czk) {echo '<tr><td>CZK</td><td>'.$rates['CZK'].'</td></tr>';}
			if($dkk) {echo '<tr><td>DKK</td><td>'.$rates['DKK'].'</td></tr>';}
			if($eek) {echo '<tr><td>EEK</td><td>'.$rates['EEK'].'</td></tr>';}
			if($gbp) {echo '<tr><td>GBP</td><td>'.$rates['GBP'].'</td></tr>';}
			if($hkd) {echo '<tr><td>HKD</td><td>'.$rates['HKD'].'</td></tr>';}
			if($hrk) {echo '<tr><td>HRK</td><td>'.$rates['HRK'].'</td></tr>';}
			if($huf) {echo '<tr><td>HUF</td><td>'.$rates['HUF'].'</td></tr>';}
			if($idr) {echo '<tr><td>IDR</td><td>'.$rates['IDR'].'</td></tr>';}
			if($inr) {echo '<tr><td>INR</td><td>'.$rates['INR'].'</td></tr>';}
			if($jpy) {echo '<tr><td>JPY</td><td>'.$rates['JPY'].'</td></tr>';}
			if($krw) {echo '<tr><td>KRW</td><td>'.$rates['KRW'].'</td></tr>';}
			if($ltl) {echo '<tr><td>LTL</td><td>'.$rates['LTL'].'</td></tr>';}
			if($lvl) {echo '<tr><td>LVL</td><td>'.$rates['LVL'].'</td></tr>';}
			if($mxn) {echo '<tr><td>MXN</td><td>'.$rates['MXN'].'</td></tr>';}
			if($myr) {echo '<tr><td>MYR</td><td>'.$rates['MYR'].'</td></tr>';}
			if($nok) {echo '<tr><td>NOK</td><td>'.$rates['NOK'].'</td></tr>';}
			if($nzd) {echo '<tr><td>NZD</td><td>'.$rates['NZD'].'</td></tr>';}
			if($php) {echo '<tr><td>PHP</td><td>'.$rates['PHP'].'</td></tr>';}
			if($pln) {echo '<tr><td>PLN</td><td>'.$rates['PLN'].'</td></tr>';}
			if($ron) {echo '<tr><td>RON</td><td>'.$rates['RON'].'</td></tr>';}
			if($rub) {echo '<tr><td>RUB</td><td>'.$rates['RUB'].'</td></tr>';}
			if($sek) {echo '<tr><td>SEK</td><td>'.$rates['SEK'].'</td></tr>';}
			if($sgd) {echo '<tr><td>SGD</td><td>'.$rates['SGD'].'</td></tr>';}
			if($thb) {echo '<tr><td>THB</td><td>'.$rates['THB'].'</td></tr>';}
			if($try) {echo '<tr><td>TRY</td><td>'.$rates['TRY'].'</td></tr>';}
			if($usd) {echo '<tr><td>USD</td><td>'.$rates['USD'].'</td></tr>';}
			if($zar) {echo '<tr><td>ZAR</td><td>'.$rates['ZAR'].'</td></tr>';}
			echo '</table>';
			if($footerlink) {
				echo '<div class="fxwidget_footer">' . __('FxWidget by', 'fxwidget') . ' <a href="http://www.toptentagesgeld.de/" target="_blank">TopTenTagesgeld</a></div>';	
			}
		} else {
			echo __('No rates found', 'fxwidget');
		}

		echo $after_widget;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'usd' => true,
															'jpy' => true,
															'bgn' => true,
															'czk' => true,
															'dkk' => true,
															'eek' => true,
															'gbp' => true,
															'huf' => true,
															'ltl' => true,
															'lvl' => true,
															'pln' => true,
															'ron' => true,
															'sek' => true,
															'chf' => true,
															'nok' => true,
															'hrk' => true,
															'rub' => true,
															'try' => true,
															'aud' => true,
															'brl' => true,
															'cad' => true,
															'cny' => true,
															'hkd' => true,
															'idr' => true,
															'inr' => true,
															'krw' => true,
															'mxn' => true,
															'myr' => true,
															'nzd' => true,
															'php' => true,
															'sgd' => true,
															'thb' => true,
															'zar' => true,
															'title' => '',
															'footerlink' => true) );
		$title = esc_attr( $instance['title'] );
		$footerlink = esc_attr( $instance['footerlink'] );
		$usd = esc_attr( $instance['usd'] );
		$jpy = esc_attr( $instance['jpy'] );
		$bgn = esc_attr( $instance['bgn'] );
		$czk = esc_attr( $instance['czk'] );
		$dkk = esc_attr( $instance['dkk'] );
		$eek = esc_attr( $instance['eek'] );
		$gbp = esc_attr( $instance['gbp'] );
		$huf = esc_attr( $instance['huf'] );
		$ltl = esc_attr( $instance['ltl'] );
		$lvl = esc_attr( $instance['lvl'] );
		$pln = esc_attr( $instance['pln'] );
		$ron = esc_attr( $instance['ron'] );
		$sek = esc_attr( $instance['sek'] );
		$chf = esc_attr( $instance['chf'] );
		$nok = esc_attr( $instance['nok'] );
		$hrk = esc_attr( $instance['hrk'] );
		$rub = esc_attr( $instance['rub'] );
		$try = esc_attr( $instance['try'] );
		$aud = esc_attr( $instance['aud'] );
		$brl = esc_attr( $instance['brl'] );
		$cad = esc_attr( $instance['cad'] );
		$cny = esc_attr( $instance['cny'] );
		$hkd = esc_attr( $instance['hkd'] );
		$idr = esc_attr( $instance['idr'] );
		$inr = esc_attr( $instance['inr'] );
		$krw = esc_attr( $instance['krw'] );
		$mxn = esc_attr( $instance['mxn'] );
		$myr = esc_attr( $instance['myr'] );
		$nzd = esc_attr( $instance['nzd'] );
		$php = esc_attr( $instance['php'] );
		$sgd = esc_attr( $instance['sgd'] );
		$thb = esc_attr( $instance['thb'] );
		$zar = esc_attr( $instance['zar'] );	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'fxwidget'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('aud'); ?>" name="<?php echo $this->get_field_name('aud'); ?>"<?php checked( $aud ); ?> /><label for="<?php echo $this->get_field_id('aud'); ?>">AUD</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('bgn'); ?>" name="<?php echo $this->get_field_name('bgn'); ?>"<?php checked( $bgn ); ?> /><label for="<?php echo $this->get_field_id('bgn'); ?>">BGN</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('brl'); ?>" name="<?php echo $this->get_field_name('brl'); ?>"<?php checked( $brl ); ?> /><label for="<?php echo $this->get_field_id('brl'); ?>">BRL</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('cad'); ?>" name="<?php echo $this->get_field_name('cad'); ?>"<?php checked( $cad ); ?> /><label for="<?php echo $this->get_field_id('cad'); ?>">CAD</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('chf'); ?>" name="<?php echo $this->get_field_name('chf'); ?>"<?php checked( $chf ); ?> /><label for="<?php echo $this->get_field_id('chf'); ?>">CHF</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('cny'); ?>" name="<?php echo $this->get_field_name('cny'); ?>"<?php checked( $cny ); ?> /><label for="<?php echo $this->get_field_id('cny'); ?>">CNY</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('czk'); ?>" name="<?php echo $this->get_field_name('czk'); ?>"<?php checked( $czk ); ?> /><label for="<?php echo $this->get_field_id('czk'); ?>">CZK</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dkk'); ?>" name="<?php echo $this->get_field_name('dkk'); ?>"<?php checked( $dkk ); ?> /><label for="<?php echo $this->get_field_id('dkk'); ?>">DKK</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('eek'); ?>" name="<?php echo $this->get_field_name('eek'); ?>"<?php checked( $eek ); ?> /><label for="<?php echo $this->get_field_id('eek'); ?>">EEK</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('gbp'); ?>" name="<?php echo $this->get_field_name('gbp'); ?>"<?php checked( $gbp ); ?> /><label for="<?php echo $this->get_field_id('gbp'); ?>">GBP</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hkd'); ?>" name="<?php echo $this->get_field_name('hkd'); ?>"<?php checked( $hkd ); ?> /><label for="<?php echo $this->get_field_id('hkd'); ?>">HKD</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hrk'); ?>" name="<?php echo $this->get_field_name('hrk'); ?>"<?php checked( $hrk ); ?> /><label for="<?php echo $this->get_field_id('hrk'); ?>">HRK</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('huf'); ?>" name="<?php echo $this->get_field_name('huf'); ?>"<?php checked( $huf ); ?> /><label for="<?php echo $this->get_field_id('huf'); ?>">HUF</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('idr'); ?>" name="<?php echo $this->get_field_name('idr'); ?>"<?php checked( $idr ); ?> /><label for="<?php echo $this->get_field_id('idr'); ?>">IDR</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('inr'); ?>" name="<?php echo $this->get_field_name('inr'); ?>"<?php checked( $inr ); ?> /><label for="<?php echo $this->get_field_id('inr'); ?>">INR</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('jpy'); ?>" name="<?php echo $this->get_field_name('jpy'); ?>"<?php checked( $jpy ); ?> /><label for="<?php echo $this->get_field_id('jpy'); ?>">JPY</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('krw'); ?>" name="<?php echo $this->get_field_name('krw'); ?>"<?php checked( $krw ); ?> /><label for="<?php echo $this->get_field_id('krw'); ?>">KRW</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('ltl'); ?>" name="<?php echo $this->get_field_name('ltl'); ?>"<?php checked( $ltl ); ?> /><label for="<?php echo $this->get_field_id('ltl'); ?>">LTL</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('lvl'); ?>" name="<?php echo $this->get_field_name('lvl'); ?>"<?php checked( $lvl ); ?> /><label for="<?php echo $this->get_field_id('lvl'); ?>">LVL</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('mxn'); ?>" name="<?php echo $this->get_field_name('mxn'); ?>"<?php checked( $mxn ); ?> /><label for="<?php echo $this->get_field_id('mxn'); ?>">MXN</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('myr'); ?>" name="<?php echo $this->get_field_name('myr'); ?>"<?php checked( $myr ); ?> /><label for="<?php echo $this->get_field_id('myr'); ?>">MYR</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('nok'); ?>" name="<?php echo $this->get_field_name('nok'); ?>"<?php checked( $nok ); ?> /><label for="<?php echo $this->get_field_id('nok'); ?>">NOK</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('nzd'); ?>" name="<?php echo $this->get_field_name('nzd'); ?>"<?php checked( $nzd ); ?> /><label for="<?php echo $this->get_field_id('nzd'); ?>">NZD</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('php'); ?>" name="<?php echo $this->get_field_name('php'); ?>"<?php checked( $php ); ?> /><label for="<?php echo $this->get_field_id('php'); ?>">PHP</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('pln'); ?>" name="<?php echo $this->get_field_name('pln'); ?>"<?php checked( $pln ); ?> /><label for="<?php echo $this->get_field_id('pln'); ?>">PLN</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('ron'); ?>" name="<?php echo $this->get_field_name('ron'); ?>"<?php checked( $ron ); ?> /><label for="<?php echo $this->get_field_id('ron'); ?>">RON</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('rub'); ?>" name="<?php echo $this->get_field_name('rub'); ?>"<?php checked( $rub ); ?> /><label for="<?php echo $this->get_field_id('rub'); ?>">RUB</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('sek'); ?>" name="<?php echo $this->get_field_name('sek'); ?>"<?php checked( $sek ); ?> /><label for="<?php echo $this->get_field_id('sek'); ?>">SEK</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('sgd'); ?>" name="<?php echo $this->get_field_name('sgd'); ?>"<?php checked( $sgd ); ?> /><label for="<?php echo $this->get_field_id('sgd'); ?>">SGD</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('thb'); ?>" name="<?php echo $this->get_field_name('thb'); ?>"<?php checked( $thb ); ?> /><label for="<?php echo $this->get_field_id('thb'); ?>">THB</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('try'); ?>" name="<?php echo $this->get_field_name('try'); ?>"<?php checked( $try ); ?> /><label for="<?php echo $this->get_field_id('try'); ?>">TRY</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('usd'); ?>" name="<?php echo $this->get_field_name('usd'); ?>"<?php checked( $usd ); ?> /><label for="<?php echo $this->get_field_id('usd'); ?>">USD</label></div>
			<div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('zar'); ?>" name="<?php echo $this->get_field_name('zar'); ?>"<?php checked( $zar ); ?> /><label for="<?php echo $this->get_field_id('zar'); ?>">ZAR</label></div>			
			<br clear="all"/>
		</p>
		<p><div class="fxwidget_checkbox"><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('footerlink'); ?>" name="<?php echo $this->get_field_name('footerlink'); ?>"<?php checked( $footerlink ); ?> /><label for="<?php echo $this->get_field_id('footerlink'); ?>"><?php _e( 'Give developer credit', 'fxwidget' ); ?></label></div><br clear="all"/></p>
		
		<?php
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['usd'] = $new_instance['usd'] ? true : false;
		$instance['jpy'] = $new_instance['jpy'] ? true : false;
		$instance['bgn'] = $new_instance['bgn'] ? true : false;
		$instance['czk'] = $new_instance['czk'] ? true : false;
		$instance['dkk'] = $new_instance['dkk'] ? true : false;
		$instance['eek'] = $new_instance['eek'] ? true : false;
		$instance['gbp'] = $new_instance['gbp'] ? true : false;
		$instance['huf'] = $new_instance['huf'] ? true : false;
		$instance['ltl'] = $new_instance['ltl'] ? true : false;
		$instance['lvl'] = $new_instance['lvl'] ? true : false;
		$instance['pln'] = $new_instance['pln'] ? true : false;
		$instance['ron'] = $new_instance['ron'] ? true : false;
		$instance['sek'] = $new_instance['sek'] ? true : false;
		$instance['chf'] = $new_instance['chf'] ? true : false;
		$instance['nok'] = $new_instance['nok'] ? true : false;
		$instance['hrk'] = $new_instance['hrk'] ? true : false;
		$instance['rub'] = $new_instance['rub'] ? true : false;
		$instance['try'] = $new_instance['try'] ? true : false;
		$instance['aud'] = $new_instance['aud'] ? true : false;
		$instance['brl'] = $new_instance['brl'] ? true : false;
		$instance['cad'] = $new_instance['cad'] ? true : false;
		$instance['cny'] = $new_instance['cny'] ? true : false;
		$instance['hkd'] = $new_instance['hkd'] ? true : false;
		$instance['idr'] = $new_instance['idr'] ? true : false;
		$instance['inr'] = $new_instance['inr'] ? true : false;
		$instance['krw'] = $new_instance['krw'] ? true : false;
		$instance['mxn'] = $new_instance['mxn'] ? true : false;
		$instance['myr'] = $new_instance['myr'] ? true : false;
		$instance['nzd'] = $new_instance['nzd'] ? true : false;
		$instance['php'] = $new_instance['php'] ? true : false;
		$instance['sgd'] = $new_instance['sgd'] ? true : false;
		$instance['thb'] = $new_instance['thb'] ? true : false;
		$instance['zar'] = $new_instance['zar'] ? true : false;
		$instance['footerlink'] = $new_instance['footerlink'] ? true : false;
		
		return $instance;
	}
	
	function getRates() {
		$XMLContent= file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
		//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
		
		if(!$XMLContent) {
			return '';
		} else {
			foreach ($XMLContent as $line) {
				if (ereg("currency='([[:alpha:]]+)'",$line,$currencyCode)) {
			    	if (ereg("rate='([[:graph:]]+)'",$line,$rate)) {
						$rates[$currencyCode[1]] = $rate[1];
	                	//Output the value of 1 EUR for a currency code 
	                    // echo '1 &euro; = '.$rate[1].' '.$currencyCode[1].'<br />';
		            }
		        }
			} // end of foreach
			return $rates;
		} // end of else

	} // end of function getRates()

} // end of class Fx_Widget

function admin_register_head() {
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/fxwidgetadm.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'admin_register_head');

function register_head() {
	$siteurl = get_option('siteurl');
	$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/fxwidget.css';
	echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('wp_head', 'register_head');

function fxwidget_load_widget() {
	register_widget('Fx_Widget' );
}

add_action('widgets_init', 'fxwidget_load_widget' );

function fxwidget_init() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'fxwidget', false, $plugin_dir.'/languages/' );
	
}
add_action('init', 'fxwidget_init');

// Admin menu
// add_action('admin_menu', 'fxwidget_plugin_menu');
// 
// function fxwidget_plugin_menu() {
//   add_options_page('FxWidget Options', 'FxWidget', 'manage_options', 'fxwidget-menu', 'fxwidget_plugin_options');
// }
// 
// function fxwidget_plugin_options() {
// 	echo '<div class="wrap">';
// 	echo '<h2>FxWidget Options</h2>';
// 	echo '<form method="post" action="options.php">';
// 	wp_nonce_field('update-options');
// 	echo '</div>';
// }


?>