<?php
class BoruElastic_Widget_View extends Vtiger_Popup_View
{
    function __construct() {
        parent::__construct();
    }
    function process(Vtiger_Request $request) {

        // check boru license
        require "modules/GoogleMap/Boru.php";
        $boruLicenseValidation = new BoruLicense("GoogleMap", "index.php?module=GoogleMap&view=Settings");
        $boruUserLimit = $boruLicenseValidation->message;
        $this->renderWidgetUI($request);
    }
    function renderWidgetUI(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();

        $viewer = $this->getViewer($request);

        $recordid = $request->get('record');
        $related_module = $request->get('source_module');

		//should use a tpl here.. not html.

        echo '
		<table width="100%">
			<tr>
				<td>
					<a class="webMnu" href="' . $MapIt_link . '" target="_blank">
						<img align="absmiddle" hspace="5" border="0" src="' . $MapIt_pin_graphic . '">
					</a>
					<a class="webMnu" href="' . $MapIt_link . '" target="_blank">
					Map';
        if ($app_strings[$default_map_addr_type] != '') echo $app_strings[$default_map_addr_type];
        else echo $default_map_addr_type;
        echo '
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a class="webMnu" href="' . $RadiusMap_link . '" target="_blank" onclick="getGeoCodes(\'' . $default_map_addr . '\', \'' . $recordid . '\', \'\')">
						<img align="absmiddle" hspace="5" border="0" src="' . $RadiusMap_pin_graphic . '">
					</a>

					<a class="webMnu" href="' . $RadiusMap_link . '" target="_blank" onclick="getGeoCodes(\'' . $default_map_addr . '\', \'' . $recordid . '\', \'\')">
						' . getTranslatedString('LBL_RADIUS_MAP', 'GoogleMap') . '
					</a>
				</td>
			</tr>
		</table>';
    }
}
?>
