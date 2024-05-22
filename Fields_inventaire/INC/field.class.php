<?php

class PluginFieldsField extends CommonDBTM {
    static $rightname = 'plugin_fields';

    static function getTypeName($nb = 0) {
        return __('Fields', 'fields');
    }

    static function canCreate() {
        return Session::haveRightsOr('plugin_fields', [CREATE, UPDATE]);
    }

    static function canView() {
        return Session::haveRightsOr('plugin_fields', [READ, UPDATE, DELETE]);
    }

    static function canUpdate() {
        return Session::haveRightsOr('plugin_fields', [UPDATE]);
    }

    static function canDelete() {
        return Session::haveRightsOr('plugin_fields', [DELETE]);
    }

    static function install() {
        global $DB;

        if (!$DB->tableExists('glpi_plugin_fields')) {
            $query = "CREATE TABLE `glpi_plugin_fields` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `num_inventaire` varchar(255) DEFAULT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            $DB->query($query);
        }
    }

    static function uninstall() {
        global $DB;

        if ($DB->tableExists('glpi_plugin_fields')) {
            $DB->query("DROP TABLE `glpi_plugin_fields`");
        }
    }
}
?>
