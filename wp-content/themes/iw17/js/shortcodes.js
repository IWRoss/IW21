jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.iw17_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('iw17_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();

                    content =  '[signoff]';

                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('iw17_button', {title : 'Insert signoff shortcode', cmd : 'iw17_insert_shortcode', image: url + '/../imgs/iw17-shortcode.png' });
        },
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('iw17_button', tinymce.plugins.iw17_plugin);
});
