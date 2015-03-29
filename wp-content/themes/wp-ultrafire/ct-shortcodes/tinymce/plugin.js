(function ()
{
	// create ctShortcodes plugin
	tinymce.create("tinymce.plugins.ctShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("ctPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "ct_button" )
			{	
				var a = this;
				
				var btn = e.createSplitButton('ct_button', {
                    title: "Insert Shortcode",
					image: ctShortcodes.plugin_folder +"/ct-shortcodes/tinymce/images/icon.png",
					icons: false
                });

                btn.onRenderMenu.add(function (c, b)
				{	
					a.addWithoutPopup( b, "Add Row", "[row]insert the shortcodes for the columns here[/row]" );				
					a.addWithPopup( b, "Columns", "columns" );

					a.addWithPopup( b, "InfoBlock", "infoblock_func" );
					a.addWithPopup( b, "Video", "video_func" );
					a.addWithPopup( b, "Soundcloud", "soundcloud_func" );
					a.addWithPopup( b, "Font Awesome Icons", "f_icons" );

					a.addWithPopup( b, "Headings", "headings" );
					a.addWithPopup( b, "Margins", "margins" );
					a.addWithPopup( b, "Buttons", "func_button" );					
					a.addWithPopup( b, "Highlights", "highlights" );
					a.addWithPopup( b, "Dropcaps", "dropcaps" );
					a.addWithPopup( b, "Lists", "lists_func" );
					a.addWithoutPopup( b, "Clear", "[clear]" );					

					a.addWithPopup( b, "Collapses", "collapses" );
					a.addWithPopup( b, "Toggle", "toggle_func" );
					a.addWithPopup( b, "Tabs", "tabs" );

					a.addWithoutPopup ( b, "Divider", "[ct_divider]" );
					a.addWithPopup( b, "Labels", "labels" );			
					a.addWithPopup( b, "Badges", "badges" );
					a.addWithPopup( b, "Alerts", "alerts" );
					a.addWithPopup( b, "Progress Bars", "p_bars" );

				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("ctPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addWithoutPopup: function ( ed, title, sc ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},		
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		}
	});
	
	// add ctShortcodes plugin
	tinymce.PluginManager.add("ctShortcodes", tinymce.plugins.ctShortcodes);
})();