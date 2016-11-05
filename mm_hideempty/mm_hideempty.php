<?php
/**
 * mm_hideEmpty
 * @version 0.1 (2016.02.12)
 * 
 * @desc A widget for ManagerManager plugin that allows to hide all empty sections and tabs.
 * 
 * @uses ManagerManager plugin 0.6.2.
 * 
 * @author Sergey Davydov <webmaster@sdcollection.com>
 * 
 * @link https://github.com/MrSwed/MODXEvo.plugin.ManagerManager.mm_hideEmpty
 * 
 * @copyright 2016
 */

function mm_hideEmpty($roles = '', $templates = ''){
	global $modx;
	$e = &$modx->Event;
	
	// if the current page is being edited by someone in the list of roles, and uses a template in the list of templates
	if (
		$e->name == 'OnDocFormRender' &&
		useThisRule($roles, $templates)
	){
		$output = '//---------- mm_hideEmpty :: Begin -----'.PHP_EOL;
		
		$output .= '
//Empty sections
$j(".sectionBody[id]:not(:has([name])):not(:has(iframe))").each(function(){
	var $this = $j(this),
		id = $this.attr("id").match(/(.+)_[^_]+$/)[1];
	
	//Section header
	$j("#" + id + "_header").hide();
	//Section body
	$this.hide();
});
//Empty tabs
$j(".tab-pane .tab-page:not(:has([name])):not(:has(iframe))").each(function(){
	var $this = $j(this);
	
	//Page
	$this.hide();
	//Navigation item
	$j(".tab-pane .tab-row .tab").eq($this.get(0).tabPage.index).hide();
});
';
		
		$output .= '//---------- mm_hideEmpty :: End -----'.PHP_EOL;
		
		$e->output($output);
	}
}
?>