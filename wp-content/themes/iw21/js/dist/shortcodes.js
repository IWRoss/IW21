jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.iw21_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('iw21_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();

                    content =  '[signoff]';

                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            ed.addButton('iw21_button', {title : 'Insert signoff shortcode', cmd : 'iw21_insert_shortcode', image: url + '/../imgs/iw21-shortcode.png' });
        },
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('iw21_button', tinymce.plugins.iw21_plugin);
});
