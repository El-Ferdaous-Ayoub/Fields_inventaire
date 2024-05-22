<?php

class PluginFieldsTicketnuminventaire extends PluginFieldsField {

    static function preItemUpdate(CommonDBTM $item) {
        // Logic before updating an item, if necessary
    }

    static function postItemUpdate(CommonDBTM $item) {
        if ($item instanceof Computer) {
            self::copyInventoryNumber($item);
        }
    }

    static function postItemAdd(CommonDBTM $item) {
        if ($item instanceof Computer) {
            self::copyInventoryNumber($item);
        }
    }

    static function copyInventoryNumber(Computer $computer) {
        global $DB;

        $num_inventaire = $computer->fields['otherserial'];
        $update_query = "UPDATE glpi_computers
                         SET num_inventaire = '" . $DB->escape($num_inventaire) . "'
                         WHERE id = " . $computer->fields['id'];
        $DB->query($update_query) or die ($DB->error());
    }
}
?>
