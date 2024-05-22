<?php

function plugin_init_fields() {
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['fields'] = true;

    Plugin::registerClass('PluginFieldsTicketnuminventaire', ['addtabon' => 'Computer']);

    $PLUGIN_HOOKS['pre_item_update']['fields'] = ['PluginFieldsTicketnuminventaire', 'preItemUpdate'];
    $PLUGIN_HOOKS['item_update']['fields'] = ['PluginFieldsTicketnuminventaire', 'postItemUpdate'];
    $PLUGIN_HOOKS['item_add']['fields'] = ['PluginFieldsTicketnuminventaire', 'postItemAdd'];
}
?>
