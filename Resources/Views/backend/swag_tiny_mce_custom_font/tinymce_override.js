//
Ext.define('Shopware.form.field.TinyMCEUnfiltered', {
    override: 'Shopware.form.field.TinyMCE',

    initEditor: function() {
        var me = this;

        me.editor = Ext.apply(me.editor, {
            theme_advanced_fonts: "{$tinyMceCustomFontConfig.fontNames}",
            content_css: '{url controller="tiny_mce_custom_font" forceSecure}?_dc=' + new Date().getTime(),
        });

        me.callOverridden();
    }
});
//
