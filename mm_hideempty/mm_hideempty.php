<?php
/**
 * mm_hideEmpty
 * @version 0.2 (2016-11-05)
 * 
 * @see README.md
 * 
 * @link http://code.divandesign.biz/modx/mm_hideempty
 * @link https://github.com/MrSwed/MODXEvo.plugin.ManagerManager.mm_hideEmpty
 * 
 * @copyright 2016
 */

function mm_hideEmpty($params = []){
	//For backward compatibility
	if (
		!is_array($params) &&
		!is_object($params)
	){
		//Convert ordered list of params to named
		$params = ddTools::orderedParamsToNamed([
			'paramsList' => func_get_args(),
			'compliance' => [
				'roles',
				'templates'
			]
		]);
	}
	
	//Defaults
	$params = (object) array_merge([
		'roles' => '',
		'templates' => ''
	], (array) $params);
	
	if (!useThisRule($params->roles, $params->templates)){return;}
	
	global $modx;
	$e = &$modx->Event;
	
	// if the current page is being edited by someone in the list of roles, and uses a template in the list of templates
	if ($e->name == 'OnDocFormPrerender'){
		//The main js file including
		$output = includeJsCss($modx->getConfig('site_url').'assets/plugins/managermanager/widgets/mm_hideempty/jQuery.ddMM.mm_hideEmpty.js', 'html', 'jQuery.ddMM.mm_hideEmpty', '1.0');
		
		$e->output($output);
	}else if ($e->name == 'OnDocFormRender'){
		$output = '//---------- mm_hideEmpty :: Begin -----'.PHP_EOL;
		
		$output .= '$j.ddMM.mm_hideEmpty.hideEmptySections();'.PHP_EOL;
		$output .= '$j.ddMM.mm_hideEmpty.hideEmptyTabs();'.PHP_EOL;
		
		$output .= '//---------- mm_hideEmpty :: End -----'.PHP_EOL;
		
		$e->output($output);
	}
}
?>