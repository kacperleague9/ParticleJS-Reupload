<?php
if($user->isLoggedIn()){
	if(!$user->canViewACP()){
		// No
		Redirect::to(URL::build('/'));
		die();
	}
	if(!$user->isAdmLoggedIn()){
		Redirect::to(URL::build('/panel/auth'));
		die();
	} else {
		if(!$user->hasPermission('admincp.modules')){
			Redirect::to(URL::build('/'));
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}

define('PAGE', 'panel');
define('PARENT_PAGE', 'ParticlesJS');
define('PANEL_PAGE', 'ParticlesJS');
$page_title = 'ParticlesJS';
require_once(ROOT_PATH . '/core/templates/backend_init.php');


// Load modules + template
Module::loadPage($user, $pages, $cache, $smarty, array($navigation, $cc_nav, $mod_nav), $widgets);
$cachete = new Cache;
        
$cachete->setCache('templatecache');
$TemplateDefault = $cachete->retrieve('default');

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		
		$Archivo = '
{
	"particles": {
		"Altura": "'.$_POST['Altura'].'",
		"number": {
			"value": '.$_POST['Cantidad'].',
			"density": {
				"enable": true,
				"value_area": '.$_POST['Dencidad'].' 
			}
		},
		"color": {
			"value": "'.$_POST['Color'].'"
		},
		"shape": {
			"type": "'.$_POST['Tipo'].'",
			"stroke": {
				"width": 0,
				"color": "#000000"
			},
			"polygon": {
				"nb_sides": 5
			},
			"image": {
				"src": "'.$_POST['Imagen'].'",
				"width": '.$_POST['AL'].',
				"height": '.$_POST['AN'].'
			}
		},
		"opacity": {
			"value": 0.8,
			"random": true,
			"anim": {
				  "enable": true,
				  "speed": 1,
				  "opacity_min": 0.1,
				  "sync": false
			}
		},
		"size": {
			"value": '.$_POST['Tamano'].',
			"random": false,
			"anim": {
			  "enable": false,
			  "speed": 40,
			  "size_min": 0.1,
			  "sync": false
			}
		},
		"line_linked": {
			"enable": '.$_POST['Enlazado'].',
			"distance": '.$_POST['DE'].',
			"color": "'.$_POST['CE'].'",
			"opacity": '.$_POST['OE'].',
			"width": '.$_POST['WE'].'
		},
		"move": {
			"enable": '.$_POST['Movimiento'].',
			"speed": '.$_POST['DV'].',
			"direction": "'.$_POST['DMovimiento'].'",
			"random": true,
			"straight": false,
			"out_mode": "out",
			"bounce": false,
				"attract": {
					"enable": true,
				  	"rotateX": 600,
				  	"rotateY": 1200
				}
			}
		},
		"interactivity": {
		  "detect_on": "canvas",
		  "events": {
			"onhover": {
			  "enable": true,
			  "mode": "repulse"
			},
			"onclick": {
			  "enable": false,
			  "mode": "push"
			},
			"resize": true
			},
		  	"modes": {
				"grab": {
					"distance": 400,
				  	"line_linked": {
					"opacity": 1
				}
			},
			"bubble": {
				"distance": 400,
				"size": 40,
				"duration": 2,
				"opacity": 8,
				"speed": 3
			},
			"repulse": {
				"distance": 200,
				"duration": 0.4
			},
			"push": {
				"particles_nb": 4
			},
			"remove": {
				"particles_nb": 2
			}
		}
	},
	"retina_detect": false
}';
		$file = ROOT_PATH . '/modules/ParticlesJS/particles/particles.json';
		file_put_contents($file, $Archivo);

		$ArchivoExterno = file_get_contents($file);

		if ($ArchivoExterno === $Archivo){
			$correcto[] = 'La informacion fue enviadad';
		} else {
			$malo[] = 'No detectamos cambios en el archivo';
		}


	} else {	
		$malo[] = 'Ocurrio un error en el token';
	}
}
$file = ROOT_PATH . '/modules/ParticlesJS/particles/particles.json';

$Archivo = file_get_contents($file);
$JSON_DECODE = json_decode($Archivo, true);
$smarty->assign(array(
	'VALUE' => $JSON_DECODE['particles']
));

if(!isset($_GET['action'])){
	$LOL = 'LOL';
} else {
	if($_GET['action'] == 'reinstall'){		
		if ($TemplateDefault == 'Cesium'){
			//Instalacion en la plantilla
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/Cesium/header.tpl');
			if (!strpos($contenidotpl, 'ParticlesCSS')) {
				try {
					$salida = str_replace('</head>', '{$ParticlesCSS}'.PHP_EOL.'</head>', $contenidotpl);

					file_put_contents(ROOT_PATH . '/custom/templates/Cesium/header.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/Cesium/navbar.tpl');
			if (!strpos($contenidotpl, 'PARTICLESJsD')) {
				try {
					
					$salida = str_replace('<div id="wrapper">', '<div id="wrapper">'.PHP_EOL.'{$PARTICLESJsD}', $contenidotpl);
					file_put_contents(ROOT_PATH . '/custom/templates/Cesium/navbar.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/Cesium/footer.tpl');
			if (!strpos($contenidotpl, '$PJS')) {
				try {
					$salida = str_replace('</body>', '{foreach from=$PARTICLESJS item=PJS}{$PJS}{/foreach}'.PHP_EOL.'</body>', $contenidotpl);

					file_put_contents(ROOT_PATH . '/custom/templates/Cesium/footer.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
		} elseif ($TemplateDefault == 'DefaultRevamp') {
			//Instalacion en la plantilla
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/header.tpl');
			if (!strpos($contenidotpl, 'ParticlesCSS')) {
				try {
					$salida = str_replace('</head>', '{$ParticlesCSS}'.PHP_EOL.'</head>', $contenidotpl);

					file_put_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/header.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/navbar.tpl');
			if (!strpos($contenidotpl, 'PARTICLESJsD')) {
				try {
					$salida = $contenidotpl . PHP_EOL . '{$PARTICLESJsD}';
					file_put_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/navbar.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/footer.tpl');
			if (!strpos($contenidotpl, '$PJS')) {
				try {
					$salida = str_replace('</body>', '{foreach from=$PARTICLESJS item=PJS}{$PJS}{/foreach}'.PHP_EOL.'</body>', $contenidotpl);

					file_put_contents(ROOT_PATH . '/custom/templates/DefaultRevamp/footer.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
		} else {
			//Instalacion en la plantilla
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/'.$TemplateDefault.'/header.tpl');
			if (!strpos($contenidotpl, 'ParticlesCSS')) {
				try {
					$salida = str_replace('</head>', '{$ParticlesCSS}'.PHP_EOL.'</head>', $contenidotpl);
							file_put_contents(ROOT_PATH . '/custom/templates/'.$TemplateDefault.'/header.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/'.$TemplateDefault.'/header.tpl');
			if (!strpos($contenidotpl, 'PARTICLESJsD')) {
				try {
					$salida = $contenidotpl . PHP_EOL . '{$PARTICLESJsD}';
					file_put_contents(ROOT_PATH . '/custom/templates/'.$TemplateDefault.'/header.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
			$contenidotpl = file_get_contents(ROOT_PATH . '/custom/templates/'.$TemplateDefault.'/footer.tpl');
			if (!strpos($contenidotpl, '$PJS')) {
				try {
					$salida = str_replace('</body>', '{foreach from=$PARTICLESJS item=PJS}{$PJS}{/foreach}'.PHP_EOL.'</body>', $contenidotpl);
							file_put_contents(ROOT_PATH . '/custom/templates/'.$TemplateDefault.'/footer.tpl', $salida);
				} catch (\Throwable $th) {
					//throw $th;
				}
			}
		}

	} else if($_GET['action'] == 'LG'){
		Redirect::to('https://LatinGamers.co.ve');
		die();
	}
}

if (isset($malo)) {
	$smarty->assign(array(
		'ERROR' => $malo
	));
} else {
	$smarty->assign(array(
		'CORRECTO' => $correcto
	));
}

$smarty->assign(array(
	'PARENT_PAGE' => PARENT_PAGE,
	'Template_Default' => $TemplateDefault,
	'INSTALL_PLANTILLA' => URL::build('/panel/P/ParticlesJS/?action=reinstall'),
	'DASHBOARD' => $language->get('admin', 'dashboard'),
	'LINK_NAVBAR' => $language->get('admin', 'page_link_navbar'),
	'LINK_MORE' => $language->get('admin', 'page_link_more'),
	'LINK_FOOTER' => $language->get('admin', 'page_link_footer'),
	'LINK_NONE' => $language->get('admin', 'page_link_none'),
	'ICON_VALUE' => Output::getClean(htmlspecialchars_decode($icon)),
	
	'TOKEN' => Token::get(),
	'SUBMIT' => $language->get('general', 'submit')
));

$page_load = microtime(true) - $start;
define('PAGE_LOAD_TIME', str_replace('{x}', round($page_load, 3), $language->get('general', 'page_loaded_in')));


require(ROOT_PATH . '/core/templates/panel_navbar.php');

// Display template
$template->displayTemplate('../../../modules/ParticlesJS/pages/panel/panel.tpl', $smarty);