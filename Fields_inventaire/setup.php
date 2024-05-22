<?php

/**
 * -------------------------------------------------------------------------
 * Fields plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of Fields.
 *
 * Fields is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Fields is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Fields. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @license   GPLv2 https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/pluginsGLPI/fields
 * -------------------------------------------------------------------------
 */

define('PLUGIN_FIELDS_VERSION', '1.0.0');

// Minimal GLPI version, inclusive
define("PLUGIN_FIELDS_MIN_GLPI", "10.0.0");
// Maximum GLPI version, exclusive
define("PLUGIN_FIELDS_MAX_GLPI", "10.0.99");

function plugin_init_fields() {
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS['csrf_compliant']['fields'] = true;

    // Manage autoload of plugin custom classes
    include_once(PLUGINFIELDS_DIR . "/inc/autoload.php");

    $pluginfields_autoloader = new PluginFieldsAutoloader([PLUGINFIELDS_CLASS_PATH]);
    $pluginfields_autoloader->register();

    if (Session::getLoginUserID() && Plugin::isPluginActive('fields')) {
        // Add hooks
        $PLUGIN_HOOKS['pre_item_update']['fields']['Computer'] = 'PluginFieldsTicketnuminventaire::preItemUpdate';
        $PLUGIN_HOOKS['item_update']['fields']['Computer'] = 'PluginFieldsTicketnuminventaire::postItemUpdate';
        $PLUGIN_HOOKS['item_add']['fields']['Computer'] = 'PluginFieldsTicketnuminventaire::postItemAdd';
    }
}

function plugin_version_fields() {
    return [
        'name'           => __("Fields", "fields"),
        'version'        => PLUGIN_FIELDS_VERSION,
        'author'         => 'Your Name',
        'homepage'       => 'https://github.com/pluginsGLPI/fields',
        'license'        => 'GPLv2+',
        'requirements'   => [
            'glpi' => [
                'min' => PLUGIN_FIELDS_MIN_GLPI,
                'max' => PLUGIN_FIELDS_MAX_GLPI
            ]
        ]
    ];
}

function plugin_fields_check_prerequisites() {
    // Check prerequisites before installing the plugin
    return true;
}

function plugin_fields_check_config() {
    // Check configuration after installing the plugin
    return true;
}
?>
