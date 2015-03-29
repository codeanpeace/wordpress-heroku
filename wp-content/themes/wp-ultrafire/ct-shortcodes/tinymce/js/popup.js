
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var cts = {
    	loadVals: function()
    	{
    		var shortcode = $('#_ct_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.ct-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('ct_', ''),		// gets rid of the ct_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_ct_ushortcode').remove();
    		$('#ct-sc-form-table').prepend('<div id="_ct_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_ct_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.ct-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('ct_', '')		// gets rid of the ct_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_ct_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_ct_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_ct_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_ct_ushortcode').remove();
    		$('#ct-sc-form-table').prepend('<div id="_ct_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				ctPopup = $('#ct-popup');

            tbWindow.css({
                height: ctPopup.outerHeight() + 50,
                width: ctPopup.outerWidth(),
                marginLeft: -(ctPopup.outerWidth()/2),
                position: 'absolute'
            });

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,                
				height: (tbWindow.outerHeight()-47),
				overflow: 'auto', // IMPORTANT
				width: ctPopup.outerWidth()
			});
			
			$('#ct-popup').addClass('no_preview');
    	},
    	load: function()
    	{
    		var	cts = this,
    			popup = $('#ct-popup'),
    			form = $('#ct-sc-form', popup),
    			shortcode = $('#_ct_shortcode', form).text(),
    			popupType = $('#_ct_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		cts.resizeTB();
    		$(window).resize(function() { cts.resizeTB() });
    		

    		// initialise
    		cts.loadVals();
    		cts.children();
    		cts.cLoadVals();
    		
    		// update on children value change
    		$('.ct-cinput', form).live('change', function() {
    			cts.cLoadVals();
    		});
    		
    		// update on value change
    		$('.ct-input', form).change(function() {
    			cts.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.ct-insert', form).click(function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_ct_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#ct-popup').livequery( function() { cts.load(); } );
});