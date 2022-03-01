<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
/**
 * Modified by: Kelvin Thang 
 * Date: 2018-06-26
 */
$languageStrings = array(
    'PurchaseOrder' => 'PO',
	//DetailView Actions
	'SINGLE_PurchaseOrder' => 'PO',
	'LBL_EXPORT_TO_PDF' => 'Xuất ra PDF',
    'LBL_SEND_MAIL_PDF' => 'Gửi mail kèm file PDF',

	//Basic strings
	'LBL_ADD_RECORD' => 'Thêm PO',
	'LBL_RECORDS_LIST' => 'DS PO',
	'LBL_COPY_SHIPPING_ADDRESS' => 'Copy địa chỉ giao hàng',
	'LBL_COPY_BILLING_ADDRESS' => 'Copy địa chỉ hóa đơn',

	// Blocks
	'LBL_PO_INFORMATION' => 'Thông tin PO',

	//Field Labels
	'PurchaseOrder No' => 'Mã đơn',
	'Requisition No' => 'Số PO',
	'Tracking Number' => 'Số theo dõi',
	'Sales Commission' => 'Hoa hồng sales',
    'LBL_PAID' => 'Đã trả',
    'LBL_BALANCE' => 'Tiền còn nợ',

	//Added for existing Picklist Entries

	'Received Shipment'=>'Đã nhận',
	
	//Translation for product not found
	'LBL_THIS' => 'Này',
	'LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM' => 'đã bị xóa hãy xóa hoặc thay thế bằng một mặt hàng khác',
	'LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM' => 'Mặt hàng này đã bị xóa hãy bỏ nó ra khỏi PO',
	'LBL_THIS_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM' => '%product_type đã bị xóa, hãy xóa hoặc thay thế bằng một mặt hàng khác', // Added by Phu Vo on 2020.12.16
        'LBL_LIST_PRICE'               => 'Đơn giá',
        'List Price'                   => 'Đơn giá',
    
    'LBL_COPY_COMPANY_ADDRESS' => 'Copy địa chỉ công ty của bạn',
    'LBL_COPY_ACCOUNT_ADDRESS' => 'Copy địa chỉ khách hàng',
	'LBL_SELECT_ADDRESS_OPTION' => 'Chọn địa chỉ cần copy',
	'LBL_BILLING_ADDRESS' => 'Địa chỉ hóa đơn',
	'LBL_COMPANY_ADDRESS' => 'Địa chỉ công ty',
	'LBL_ACCOUNT_ADDRESS' => 'Địa chỉ khách hàng',
	'LBL_VENDOR_ADDRESS' => 'Địa chỉ nhà cung cấp',
	'LBL_CONTACT_ADDRESS' => 'Địa chỉ Liên hệ',

    // Add by Hai Nguyen 2018-07-07

    'Subject' => 'Số đơn hàng',
    'Vendor Name' => 'Nhà cung cấp',
    'LBL_ADD' => '(+) Tăng',
    'LBL_PLUS' => '(+) Tăng',
    'LBL_DEDUCT' => '(-) Giảm',
    'LBL_ITEM_DETAILS' => 'Chi tiết',	

	// Added by Phu Vo on 2019.05.02
	'LBL_PDF_TITLE' => 'ĐƠN HÀNG NHẬP',
	// End Phu Vo

	// Added by Phuc on 2019.11.04 for debits
	'LBL_CPRECEIPT_LIST' => 'Phiếu thu',
	'LBL_CPPAYMENT_LIST' => 'Phiếu chi',
    'LBL_TOTAL_RECEIVED' => 'Tổng thu',
    'LBL_TOTAL_PAID' => 'Tổng chi',
    'LBL_PROFIT' => 'Còn lại',
    'LBL_INVOICE_LIST' => 'Đơn hàng',
	// Ended by Phuc
);

$jsLanguageStrings = array(
	'JS_PLEASE_REMOVE_LINE_ITEM_THAT_IS_DELETED' => 'Hãy loại bỏ mặt hàng đã xóa',
    'JS_ORGANIZATION_NOT_FOUND'=> 'Chưa có khách hàng!',
    'JS_ORGANIZATION_NOT_FOUND_MESSAGE'=> 'Hãy chọn khách hàng trước khi copy địa chỉ',
	'JS_ACCOUNT_NOT_FOUND' => 'Chưa có khách hàng!',
	'JS_ACCOUNT_NOT_FOUND_MESSAGE' =>  'Hãy chọn khách hàng trước khi copy địa chỉ',
	'JS_VENDOR_NOT_FOUND' => 'Chưa có nhà cung cấp',
	'JS_VENDOR_NOT_FOUND_MESSAGE' => 'Hãy chọn nhà cung cấp trước khi copy địa chỉ',
	'JS_CONTACT_NOT_FOUND' => 'Chưa chọn Liên hệ',
	'JS_CONTACT_NOT_FOUND_MESSAGE' =>  'Hãy chọn liên hệ trước khi copy địa chỉ',
);
