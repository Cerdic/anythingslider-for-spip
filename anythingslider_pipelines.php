<?php
/**
 * Plugin AnythingSlider
 * Licence GPL (c) 2011 Cedric Morin / Tetue
 *
 */


/**
 * Insertion dynamique du js en pied de page,
 * uniquement en presence de video sur la page
 * 
 * @param string $flux
 * @return string
 */
function anythingslider_affichage_final($flux){
	if (stripos($flux,'slider-anythingslider')){
		$script = find_in_path('javascript/anythingslider.init.js');
		include_spip('filtres/compresseur');
		if (function_exists('compacte'))
			$script = compacte($script,'js');
		lire_fichier($script, $js);
		$js = "var dir_anythingslider='"._DIR_PLUGIN_ANYTHINGSLIDER."anythingslider/';"
		  . "var css_anythinslider='".find_in_path("anythingslider/css/anythingslider.css")."';"
		  . $js;
		$js = '<script type="text/javascript">/*<![CDATA[*/'.$js.'/*]]>*/</script>';
		if ($p=stripos($flux,'</body>'))
			$flux = substr_replace($flux,$js,$p,0);
		else
			$flux .= $js;
	}
	return $flux;
}

/**
 * Insertion statique dans l'espace prive, car on ne sait pas faire mieux pour le moment,
 *
 * @param string $flux
 * @return string
 */
function anythingslider_header_prive($flux){
	$js = "var dir_anythingslider='"._DIR_PLUGIN_ANYTHINGSLIDER."anythingslider/';"
	  . "var css_anythinslider='".find_in_path("anythingslider/css/anythingslider.css")."';";
	$js = '<script type="text/javascript">/*<![CDATA[*/'.$js.'/*]]>*/</script>';

	$flux = $js
		. $flux
		. "<script type='text/javascript' src='".find_in_path('javascript/anythingslider.init.js')."'></script>";
	return $flux;
}