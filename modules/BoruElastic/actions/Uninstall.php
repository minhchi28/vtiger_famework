<?php

class BoruElastic_Uninstall_Action extends Vtiger_Action_Controller {
    function checkPermission(Vtiger_Request $request) {
        return;
    }
    public function process(Vtiger_Request $request) {
        global $adb, $site_URL;

        // vtiger_tab
        $sql = "DELETE FROM `vtiger_tab` WHERE `name` = 'BoruElastic';";
        $result = $adb->query($sql);

        // vtiger_eventhandler_module
        $sql = "DELETE FROM `vtiger_eventhandler_module` WHERE `module_name` = 'BoruElastic';";
        $result = $adb->query($sql);

        // vtiger_eventhandlers
        $sql = "DELETE FROM `vtiger_eventhandlers` WHERE `handler_class` = 'BoruElasticHandler';";
        $result = $adb->query($sql);

        // Schedule
        $sql = "DELETE FROM `vtiger_cron_task` WHERE `module` = 'BoruElastic';";
        $result = $adb->query($sql);

        // vtiger_links
        $adb->query("DELETE FROM `vtiger_links` WHERE `linktype`= 'LISTVIEWSIDEBARWIDGET' AND `linklabel`= 'Boru ElasticSearch'");
	    $adb->query("DELETE FROM `vtiger_links` WHERE `linktype`= 'HEADERSCRIPT' AND `linklabel`= 'BoruElasticHeaderScript'");

        // drop tables
        $sql = "DROP TABLE `vtiger_boruelastic_moduleconfig`;";
        $result = $adb->query($sql);
        $sql = "DROP TABLE `vtiger_boruelastic_serverconfig`;";
        $result = $adb->query($sql);
        $sql = "DROP TABLE `vtiger_boruelastic_rel`;";
        $result = $adb->query($sql);

        // remove directory
        $res_template = $this->delete_directory('layouts/v7/modules/BoruElastic');
        $res_module = $this->delete_directory('modules/BoruElastic');
        if(!$res_module) {
            echo '
                <div style="margin-bottom: 4px;" class="helpmessagebox">
                    <b style="color: red;">ERROR</b> Can not delete the folder <b>modules/BoruElastic</b>. Please check permission and run script again.
                </div>
            ';
        } else {
            echo "<script>
                alert('Unintall BoruElastic module successful');
                window.location = '$site_URL';
            </script>";
        }
    }

    //===========================================================================
    function delete_directory($dirname) {
        if (is_dir($dirname)) $dir_handle = opendir($dirname);
        if (!$dir_handle) return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file)) {
                    unlink($dirname."/".$file);
                } else {
                    $this->delete_directory($dirname.'/'.$file);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
}
?>