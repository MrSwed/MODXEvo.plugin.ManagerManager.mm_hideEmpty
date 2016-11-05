<?php
/**
 * mm_hideEmpty
 * @version 0.1 (2016.02.12)
 * 
 * @desc A widget for ManagerManager plugin that allows to hide all empty sections and tabs.
 * 
 * @uses ManagerManager plugin 0.6.2.
 * 
 * @event OnDocFormPrerender
 * @event OnDocFormRender
 * 
 * @author Sergey Davydov <webmaster@sdcollection.com>
 * 
 * @link https://github.com/MrSwed/MODXEvo.plugin.ManagerManager.mm_hideEmpty
 * 
 * @copyright 2016
 */

function mm_hideEmpty($roles = '', $templates = ''){
	if (!useThisRule($roles, $templates)){return;}
	
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