{block name="backend/index/application"}
    {$smarty.block.parent}

    {include file="backend/swag_tiny_mce_custom_font/tinymce_override.js"}
{/block}

{block name="backend/base/header/css"}
    {$smarty.block.parent}

    <link rel="stylesheet" href="{url controller="tiny_mce_custom_font"}?{Shopware::REVISION}" />
{/block}