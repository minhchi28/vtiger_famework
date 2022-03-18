<?php

/**
 * Author: Khang Phan
 * Date: 2022.03.16
 * Purpose: Inventory Util functions to work with pdf file
 */

require_once('include/utils/PDFGenerator.php');

class InventoryPDFUtils {

	/**
	 * Contain the path to PDF template
	 * @access protected
	 */
	protected static $contentTemplateSalesOrder = 'modules/Inventory/tpls/SalesOrderPDF.tpl';
	protected static $contentTemplateInvoice = 'modules/Inventory/tpls/InvoicePDF.tpl';

    // Create new Object is not allow
    protected function __construct() {
        // Leave it empty for now
    }
    
    /**
     * Export PDF file to download
     * @param Vtiger_Record_Model $record
     */
	
	// Updated by Phuc on 2019.10.24 to add mode and get file name after generation
    public static function exportPDF(Vtiger_Record_Model $record, $mode = 'D') {
		$moduleName = $record->getModuleName();
		$fileName = $moduleName . '_' . getModuleSequenceNumber($moduleName, $record->get('id')) . '.pdf';

		if ($mode == 'F') {
			$fileName = "storage/{$fileName}";
		}
		
        $pdfGenerator = new PDFGenerator();

		$paramsDefault = [
			'default_monospaced_font' => 'times',
			'font_family' => 'times'
		];

		$pdfGenerator->setParamsDefault($paramsDefault);

		$pdfGenerator->addContent(self::getHTMLContent($record));
		$pdfGenerator->generate($fileName, $mode);
		
		return $fileName;
	}
	// Ended by Phuc
	
	static protected function getHTMLContent(Vtiger_Record_Model $record) {
        $moduleName = $record->getModuleName();

        $viewer = new Vtiger_Viewer();
        
        // Process Record data
		$entity = $record->getEntity();
		
		$recordDetails = getAssociatedProducts($moduleName, $entity);

		// Added by Phuc on 2019.10.24 to get charges and taxes
		$recordDetails[1]['final_details']['charges_and_its_taxes'] = $record->getCharges();
		// Ended by Phuc

		$extSummary = [];
		
		// get tax type
        $finalDetails = $recordDetails[1]['final_details'];
        $taxType = $finalDetails['taxtype'];

		// get contact name
		$contactName = "";
		$contactId = $record->get('contact_id');

		if (!empty($contactId)) {
			$contactRecord = Vtiger_Record_Model::getInstanceById($contactId, 'Contacts');
			$contactSalutaion = vtranslate($contactRecord->get('salutationtype'));
			$contactFullname = getParentName($record->get('contact_id'));
			if (!empty($contactSalutaion)) $contactName = $contactSalutaion . ". " . $contactFullname;
			else $contactName = $contactFullname;
		}
		
		// Process Company Infos
		$CompanyDetails = Settings_Vtiger_CompanyDetails_Model::getInstance();
		$cityInfoArr = [];
		if (!empty($CompanyDetails->get('state'))) $cityInfoArr[]=$CompanyDetails->get('state');
		if (!empty($CompanyDetails->get('city'))) $cityInfoArr[]=$CompanyDetails->get('city');
		if (!empty($CompanyDetails->get('country'))) $cityInfoArr[]=$CompanyDetails->get('country');
		$cityString = implode(", ", $cityInfoArr);

		// END Edit by Tung Bui on 2021.09.25		

		// Process Translate Label
		self::_processTranslateLabel($viewer, $moduleName);

		// Process Assign User Info
		$assignedUserModel = Vtiger_Record_Model::getInstanceById($record->get('assigned_user_id'), 'Users');

		// Process Viewer
		$viewer->assign('RECORD_MODEL', $record);
		$viewer->assign('RECORD_DETAILS', $recordDetails);
		$viewer->assign('CONTACT_NAME', $contactName);
		// $viewer->assign('CURRENCY_SYMBOL', self::getCurrencySymbol($entity->column_fields['currency_id']));
		$viewer->assign('PRODUCTS_DETAILS', self::_getProductsDetails($recordDetails));
		$viewer->assign('SUMMARY_DETAILS', self::_getSummaryDetails($recordDetails));
		$viewer->assign('TAX_TYPE', $taxType);
		$viewer->assign('EXT_SUMMARY_DETAILS', $extSummary);
		$viewer->assign('COMPANY_MODEL', $CompanyDetails);
		$viewer->assign('COMPANY_CITY_INFO', $cityString);
		$viewer->assign('ASSIGNED_USER_MODEL', $assignedUserModel);
        $viewer->assign('MODULE_NAME', $moduleName);

        if ($moduleName == 'SalesOrder') 
		$htmlContent = $viewer->fetch(self::$contentTemplateSalesOrder);
		
		return $htmlContent;
	}

	/**
	 * Method to process special dynamic label
	 * @access protected
	 */
	protected static function _processTranslateLabel(&$viewer, $moduleName) {
		$mappting = [
			'%target' => vtranslate("SINGLE_{$moduleName}", $moduleName),
		];
		
		$openning = html_entity_decode(replaceKeys(vtranslate('LBL_INVENTORY_PDF_OPENNING', $moduleName), $mappting));
		$ending = html_entity_decode(replaceKeys(vtranslate('LBL_INVENTORY_PDF_ENDING', $moduleName), $mappting));

		$viewer->assign('TXT_OPENNING', $openning);
		$viewer->assign('TXT_ENDING', $ending);
	}

	/**
	 * Method to get products details
	 * @access protected
	 */
	protected static function _getProductsDetails($recordDetails) {
        $productLineItemIndex = 0;
        $finalDetails = $recordDetails[1]['final_details'];
        $result = [];
        
        // Process by Tax type
        if ($finalDetails['taxtype'] === 'individual') {
            foreach ($recordDetails as $productLineItem) {
                ++$productLineItemIndex;
    
                $discount = $productLineItem["discountTotal{$productLineItemIndex}"];
				$discountPercentage = $productLineItem["discount_percent{$productLineItemIndex}"];

				// Edit by Tung Bui - 25/09/2021 - display discount and tax amount in export template
				$total = $productLineItem["qty{$productLineItemIndex}"] * $productLineItem["listPrice{$productLineItemIndex}"];

				// calculate total after discount
				$priceBeforeDiscount = $total;
				$priceAfterDiscount = $productLineItem["totalAfterDiscount{$productLineItemIndex}"];

				// calculate taxes
				$taxPercentage = 0;
				
				$taxes = $productLineItem['taxes'];
				if (!empty($taxes)) { // Process Tax total
					foreach($taxes as $tax) {
						$taxPercentage += $tax['percentage'];
					}
				}

				$taxAmount = $priceAfterDiscount * ($taxPercentage / 100);
				$netPrice = $priceAfterDiscount + $taxAmount;

                $result[] = [
                    'product_name' => decode_html($productLineItem["productName{$productLineItemIndex}"]),
                    'product_code' => decode_html($productLineItem["hdnProductcode{$productLineItemIndex}"]),
                    'quantity' => $productLineItem["qty{$productLindiscount_final_percenteItemIndex}"],
                    'price' => formatPrice($productLineItem["listPrice{$productLineItemIndex}"]),
                    'discount_type' => $productLineItem["discount_type{$productLineItemIndex}"],
                    'discount' => formatPrice($discount),
					'discount_percentage' => $discountPercentage,
                    'price_before_discount' => formatPrice($priceBeforeDiscount),
                    'price_after_discount' => formatPrice($priceAfterDiscount),
                    'total' => formatPrice($total),
                    'tax_amount' => formatPrice($taxAmount),
                    'net_price' => formatPrice($netPrice),
                ];
				// END Edit by Tung Bui - 25/09/2021
            }
        }
        elseif ($finalDetails['taxtype'] === 'group') {
            foreach ($recordDetails as $productLineItem) {
                ++$productLineItemIndex;
    
                $discount = $productLineItem["discountTotal{$productLineItemIndex}"];
                $discountPercentage = $productLineItem["discount_percent{$productLineItemIndex}"];

				// Edit by Tung Bui - 25/09/2021 - display discount and tax amount in export template
				// calculate total after discount
				$priceBeforeDiscount = $productLineItem["qty{$productLineItemIndex}"] * $productLineItem["listPrice{$productLineItemIndex}"];
				$priceAfterDiscount = $productLineItem["totalAfterDiscount{$productLineItemIndex}"];
				$netPrice = $priceAfterDiscount; 
                
                $result[] = [
                    'product_name' => decode_html($productLineItem["productName{$productLineItemIndex}"]),
                    'product_code' => decode_html($productLineItem["hdnProductcode{$productLineItemIndex}"]),
                    'quantity' => $productLineItem["qty{$productLineItemIndex}"],
                    'price' => formatPrice($productLineItem["listPrice{$productLineItemIndex}"]),
                    'discount_type' => $productLineItem["discount_type{$productLineItemIndex}"],
                    'discount' => formatPrice($discount),
					'discount_percentage' => $discountPercentage,
                    'price_before_discount' => formatPrice($priceBeforeDiscount),
                    'price_after_discount' => formatPrice($priceAfterDiscount),
                    'total' => formatPrice($priceAfterDiscount),
					'tax_percentage' => '',
                    'tax_amount' => '',
                    'net_price' => formatPrice($priceAfterDiscount),
                ];
				// END Edit by Tung Bui - 25/09/2021
            }
        }

		return $result;
	}

	/**
	 * Method to get record summary details
	 * @access protected
	 */
	protected static function _getSummaryDetails($recordDetails) {
		$finalDetails = $recordDetails[1]['final_details'];
		$netTotal = $discount = 0;
		$productLineItemIndex = 0;
		$discountAmount = $finalDetails["discount_amount_final"];
		$discountPercent = $finalDetails["discount_percentage_final"];

		foreach($recordDetails as $productLineItem) {
			++$productLineItemIndex;
			$netTotal += $productLineItem["netPrice{$productLineItemIndex}"];
		}

		// Process discount
		if($finalDetails['discount_type_final'] == 'amount') {
			$discount = $discountAmount;
			$discountFinalPercent = 0;
		} else if($finalDetails['discount_type_final'] == 'percentage') {
            $discountFinalPercent = $discountPercent;
			$discount = (($discountPercent * $finalDetails["hdnSubTotal"]) / 100);
		}

		// Applied by Phuc on 2019 to fix percentage
		// Total Taxs
		$groupTotalTaxPercent = 0;

		foreach ($finalDetails['taxes'] as $tax) {
            $groupTotalTaxPercent += $tax['percentage'];
		}
		
		// Shipping & Handling taxes
		$shTaxPercent = 0;

		if (isset($finalDetails['charges_and_its_taxes'][1])) {
			foreach ($finalDetails['charges_and_its_taxes'][1]['taxes'] as $tax){
				$shTaxPercent += $tax;
			}
		}
		// Ended by Phuc

		if ($finalDetails['taxtype'] === 'individual') {
			$result = [
				'net_total' => formatPrice($finalDetails['hdnSubTotal']),
				'discount' => formatPrice($discount),
				'tax' => formatPrice(0),
				'shipping_charges' => formatPrice($finalDetails['shipping_handling_charge']),
				'shipping_tax' => formatPrice($finalDetails['shipping_handling_charge'] * $shTaxPercent / 100),
				'adjustment' => formatPrice($finalDetails['adjustment']),
				'grand_total' => formatPrice($finalDetails['grandTotal']),
				'discount_final_percent' => formatPrice($discountFinalPercent) ?? formatPrice(0), // Updated by Phuc on 2019.10.24 to display format
				'group_total_tax_percent' => formatPrice(0),
				'sh_tax_percent' => formatPrice($shTaxPercent) ?? formatPrice(0), // Updated by Phuc on 2019.10.24 to display format
			];
		}
		else {
			$result = [
				'net_total' => formatPrice($netTotal),
				'discount' => formatPrice($discount),
				'tax' => formatPrice($finalDetails['tax_totalamount']),
				'shipping_charges' => formatPrice($finalDetails['shipping_handling_charge']),
				'shipping_tax' => formatPrice($finalDetails['shipping_handling_charge'] * $shTaxPercent / 100),
				'adjustment' => formatPrice($finalDetails['adjustment']),
				'grand_total' => formatPrice($finalDetails['grandTotal']),
				'discount_final_percent' => formatPrice($discountFinalPercent) ?? formatPrice(0), // Updated by Phuc on 2019.10.24 to display format
				'group_total_tax_percent' => formatPrice($groupTotalTaxPercent) ?? formatPrice(0), // Updated by Phuc on 2019.10.24 to display format
				'sh_tax_percent' => formatPrice($shTaxPercent) ?? formatPrice(0), // Updated by Phuc on 2019.10.24 to display format
			];
		}

		return $result;
	}

	/**
	 * Method to get Shipping Taxs
	 * @access protected
	 */
	protected static function _getShippingTaxs() {
		global $adb;

		$sql = "SELECT * FROM vtiger_shippingtaxinfo";
		$queryResult = $adb->pquery($sql);

		$result = [];
		while($row = $adb->fetchByAssoc($queryResult)) {
			$result[] = $row;
		}

		return $result;
	}

	/**
	 * Method to get Inventory Taxs
	 * @access protected
	 */
	protected static function _getInventoryTaxs() {
		global $adb;

		$sql = "SELECT * FROM vtiger_inventorytaxinfo";
		$queryResult = $adb->pquery($sql);

		$result = [];
		while($row = $adb->fetchByAssoc($queryResult)) {
			$result[] = $row;
		}

		return $result;
	}

	protected static function getCurrencySymbol($currencyId) {
		global $adb;
		
		if (!empty($currencyId)) {
			$result = $adb->getOne("SELECT currency_symbol FROM vtiger_currency_info WHERE id = ?", [$currencyId]);

			return $result;
		}
		
		return false;
	}
}