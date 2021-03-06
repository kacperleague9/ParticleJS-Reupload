<?php
/*
 *	Made by Samerton and Jerino
 *  https://github.com/samerton
 *  NamelessMC version 2.0.0-pr6
 *
 *  License: MIT
 *
 *  Particles.js module for NamelessMC
 */
class ParticlesJS_Module extends Module {
    private $_particlesmodule;

	public function __construct($navigation, $cache, $smarty, $language, $user, $pages, $template){
		
		$particlesm = array(
			'name' => 'ParticlesJS',
			'version' => '2.0',
			'nl_version' => "2.0.0-pr7",
			'author' => '<a href="https://samerton.me" target="_blank" rel="nofollow noopener">Samerton</a>, <a href="https://LaboratorioMC.com.ve" target="_blank" rel="nofollow noopener">CubericoStudios</a>, <a href="https://vincentgarreau.com/particles.js/" target="_blank" rel="noopener nofollow">Particles.js</a>',
		);

		$name = $particlesm['name'];
		$author = $particlesm['author'];
		$module_version = $particlesm['version'];
		$nameless_version = $particlesm['nl_version'];

		$particlesm['path'] = (defined('CONFIG_PATH') ? CONFIG_PATH : '') . '/modules/' . $particlesm['name'] . '/';
		
        $this->_particlesmodule = $particlesm;        

		parent::__construct($this, $name, $author, $module_version, $nameless_version);

        $pages->add('ParticlesJS', '/P/ParticlesJS', 'pages/panel/panel.php');
        
	}

	public function onInstall(){
		
		// Queries
		$queries = new Queries();
		
		try {
			// Update main admin group permissions
			$group = $queries->getWhere('groups', array('id', '=', 2));
			$group = $group[0];
			
			$group_permissions = json_decode($group->permissions, TRUE);
			$group_permissions['ParticlesJS.edit'] = 1;
			
			$group_permissions = json_encode($group_permissions);
			$queries->update('groups', 2, array('permissions' => $group_permissions));
		} catch(Exception $e){
			// Error
		}
	}
	public function onUninstall(){
		// Not necessary
	}
	public function onEnable(){
		$ruta = ROOT_PATH . '/modules/'.$this->_particlesmodule['name'].'/pages/panel/panel.tpl';
		$rutapanel = ROOT_PATH . '/custom/panel_templates/Default/ParticlesJS/panel.tpl';

		if (file_exists($ruta) && file_exists($rutapanel)){
		} else {
			mkdir(ROOT_PATH . '/custom/panel_templates/Default/ParticlesJS/', 0777, true);
			if (copy($ruta, $rutapanel)) {
			 }
			 else {
				Session::flash('admin_modules_error', 'Error F002');
			 }
        }

        $cache = new Cache;
        
		$cache->setCache('templatecache');
        $TemplateDefault = $cache->retrieve('default');
		
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
	}
	public function onDisable(){
		// Not necessary
    }    
	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template){
		$cache->setCache('templatecache');
        $TemplateDefault = $cache->retrieve('default');
        
		if(defined('BACK_END')) {
			if($user->hasPermission('admincp.modules')){
				$cache->setCache('panel_sidebar');
				$order = 43453423; 

				if(!$cache->isCached('particlesjss_icon')){
					$icon = '<i class="nav-icon fab fa-connectdevelop"></i>';
					$cache->store('particlesjss_icon', $icon);
				} else {
					$icon = $cache->retrieve('particlesjss_icon');
				}

				$navs[2]->add('particlesjs_divider', mb_strtoupper('ParticlesJS', 'UTF-8'), 'divider', 'top', null, $order, '');
				$navs[2]->add('particlesjs', 'ParticlesJS', URL::build('/P/ParticlesJS'), 'top', null, ($order + 0.1), $icon);
			}
        }
    }
    public function Jerinol(){
		if(!defined('BACK_END')) {
				
			$cache = new Cache;
			$cache->setCache('templatecache');
			$TemplateDefault = $cache->retrieve('default');

			
			$file = ROOT_PATH . '/modules/ParticlesJS/particles/particles.json';

			$Archivo = file_get_contents($file);
			$JSON_DECODE = json_decode($Archivo, true);

			$super_script2 = "particlesJS.load('particles-js', '".$this->_particlesmodule['path']."particles/particles.json');";
			$super_script = $this->_particlesmodule['path'] . 'particles/particles.min.js';
			if ($TemplateDefault === 'Cesium') {
				$super_estilos = '/*Cesium*/ #particles-js canvas {position: fixed;z-index: '.$JSON_DECODE['particles']['Altura'].';pointer-events: none;}.header {z-index: 1;}.announcement {z-index: 1; position: relative}.footer {z-index: 1;}';
			} elseif ($TemplateDefault === 'DefaultRevamp') {
				$super_estilos = '#particles-js canvas {position: fixed;z-index: '.$JSON_DECODE['particles']['Altura'].';pointer-events: none;}.ui.masthead {z-index: 4;}.announcement {z-index: 1;}.footer {z-index: 4;}';
			} else {
				$super_estilos = '#particles-js canvas {z-index: '.$JSON_DECODE['particles']['Altura'].';position: fixed;pointer-events: none;}.home-header {z-index: 1; position: relative}';
			}
			$PARTICLES_RESOUCER = array(
				'1' => $super_script,
				'2' => $super_script2,
				'3' => $super_estilos,
				'4' => '<div id="particles-js"></div>',
			);

			return($PARTICLES_RESOUCER);
		}
    }
}
$module = new ParticlesJS_Module($navigation, $cache, $smarty, $language, $user, $pages, $template);
$PIMPORT = $module->Jerinol();
$ParticlesJS_Style = '<style>' . $PIMPORT['3'] . '</style>';

$ParticlesJS_scripts = array(
	'<script type="text/javascript" src="'. $PIMPORT['1'] .'"></script>',
	'<script type="text/javascript">'.$PIMPORT['2']. '</script>'
);
$smarty->assign(array(
	'PARTICLESJS' => $ParticlesJS_scripts,
    'PARTICLESJsD' => $PIMPORT['4'],
    'ParticlesCSS' => $ParticlesJS_Style
));


