/**
 * jQuery.ddMM.mm_hideEmpty
 * @version 1.0.1 (2022-05-23)
 * 
 * @copyright 2016–2022
 */

(function($){
$.ddMM.mm_hideEmpty = {
	/**
	 * @method hideEmptySections
	 * @version 1.0.1 (2022-05-23)
	 * 
	 * @desc Hide empty sections.
	 * 
	 * @returns {void}
	 */
	hideEmptySections: function(){
		$('.sectionBody[id]:not(:has([name])):not(:has(iframe))').each(function(){
			var
				$this = $(this),
				id =
					$this
						.attr('id')
						.match(/(.+)_[^_]+$/)
						[1]
			;
			
			//Section header
			$('#' + id + '_header').hide();
			
			//Section body
			$this.hide();
		});
	},
	
	/**
	 * @method hideEmptyTabs
	 * @version 1.0.1 (2022-05-23)
	 * 
	 * @desc Hide empty tabs.
	 * 
	 * @returns {void}
	 */
	hideEmptyTabs: function(){
		$('.tab-pane .tab-page:not(:has([name])):not(:has(iframe))').each(function(){
			var $this = $(this);
			
			//Page
			$this.hide();
			
			//Navigation item
			$('.tab-pane .tab-row .tab')
				.eq(
					$this
						.get(0)
						.tabPage
						.index
				)
				.hide()
			;
		});
	}
};
})(jQuery);