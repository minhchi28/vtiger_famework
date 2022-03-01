<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
$languageStrings = array(
	'SalesOrder'    =>  'Đơn hàng',
    //DetailView Actions
	'SINGLE_SalesOrder' => 'Đơn hàng',
	'LBL_EXPORT_TO_PDF' => 'Xuất ra file PDF',
    'LBL_SEND_MAIL_PDF' => 'Gửi email kèm file PDF',

	//Basic strings
	'LBL_ADD_RECORD' => 'Thêm Đơn hàng',
	'LBL_RECORDS_LIST' => 'DS Đơn hàng',

	// Blocks
	'LBL_SO_INFORMATION' => 'Thông tin đơn hàng',
	'Recurring Invoice Information' => 'Thông tin hóa đơn định kỳ',

	//Field labels
	'SalesOrder No'=>'Mã Đơn hàng',
	'Quote Name'=>'Báo giá',
	'Customer No' => 'Mã khách hàng',
	'Requisition No'=>'Số đơn hàng',
	'Tracking Number'=>'Mã đơn vận chuyển',
	'Sales Commission' => 'Hoa hồng sales',
	'PO'=>'PO',
	'Vendor Terms'=>'Điều khoản nhà cung cấp',
	'Pending'=>'Đang chờ',
	'Enable Recurring' => 'Tự động tạo theo định kỳ',
	'Frequency' => 'Tần suất',
	'Start Period' => 'Thời gian bắt đầu',
	'End Period' => 'Thời gian kết thúc',
	'Payment Duration' => 'Thời hạn thanh toán',
	'Invoice Status' => 'Tình trạng hóa đơn (mặc định)',
	'Cancel' => 'Hủy bỏ',

	//--Add for Picklist by Kelvin Thang -- 2018-07-07
	'Daily' => 'Hằng ngày',
	'Weekly' => 'Hằng tuần',
	'Monthly' => 'Hằng tháng',
	'Quarterly' => 'Hằng quý',
	'Yearly' => 'Hằng năm',

	'Net 30 days' => 'Trong vòng 30 ngày',
	'Net 45 days' => 'Trong vòng 45 ngày',
	'Net 60 days' => 'Trong vòng 60 ngày',

	//Added for existing Picklist Entries

	'Sub Total'=>'Tổng trước thuế', // Update by Phuc on 2019.10.25
	'AutoCreated'=>'Được tạo tự động',
	'Sent'=>'Đã gửi KH',
	'Credit Invoice'=>'Đã tạo hóa đơn',
	'Paid'=>'Đã thanh toán',
	'Created'=>'Tạo nháp',
	
	//Translation for product not found
	'LBL_THIS' => 'Này',
	'LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM' => 'Mặt hàng này đã bị xóa hãy xóa hoặc thay thế bằng một mặt hàng khác',
	'LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM' => 'Mặt hàng này không tồn tại, hãy xóa nó khỏi đơn hàng',
	'LBL_THIS_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM' => '%product_type đã bị xóa, hãy xóa hoặc thay thế bằng một mặt hàng khác', // Added by Phu Vo on 2020.12.16

	// [ExportPDF] Added by Phu Vo on 2019.05.02
	'LBL_PDF_TITLE' => 'ĐƠN HÀNG',
	// End Phu Vo

	// Added by Phuc on 2019.11.04 for debits
	'LBL_CPRECEIPT_LIST' => 'Phiếu thu',
	'LBL_CPPAYMENT_LIST' => 'Phiếu chi',
	'LBL_TOTAL_RECEIVED' => 'Tổng thu',
    'LBL_TOTAL_PAID' => 'Tổng chi',
    'LBL_PROFIT' => 'Lợi nhuận',
    'LBL_BALANCE' => 'Còn lại',
	// Ended by Phuc
    'LBL_SALESORDER_CUSTOMER_TYPE' => 'Loại khách hàng',
    'old' => 'Cũ',
    'new' => 'Mới',

    // [Core] Added by Phu Vo on 2020.05.22
    'LBL_RECEIVER_INFORMATION' => 'Thông tin người nhận',
    'LBL_RECEIVER_NAME' => 'Tên người nhận',
    'LBL_RECEIVER_PHONE' => 'Số điện thoại người nhận',
	// End Phu Vo
	
	// [Core] Added by Phu Vo on 2020.12.14
	'Waiting for approve' => 'Chờ duyệt',
	'Partial payment' => 'Đã thanh toán một phần',
	'Full payment' => ' Đã thanh toán đủ',
	'Approved' => 'Đã duyệt',
	'Delivered' => ' Đã giao hàng',
    // End Phu Vo
	
    // Added by Phu Vo on 2021.08.10
    'LBL_ORDER_DATE' => 'Ngày đặt hàng',
    'LBL_HAS_INVOICE' => 'Xuất hóa đơn',
    'LBL_INVOICE_AMOUNT' => 'Số tiền xuất hóa đơn',
    'LBL_PURCHASE_HISTORY' => 'Lần thanh toán',
    'LBL_HAS_SHIPPING' => 'Có giao hàng',
    'LBL_SHIPPING_CODE' => 'Mã vận đơn',
    'LBL_DEPOSIT' => 'Đặt cọc',
    'LBL_SHIPPING_STATUS' => 'Tình trạng giao hàng',
    'LBL_SHIPPING_METHOD' => 'Phương thức vận chuyển',
    'LBL_SALESORDER_PAYMENT_METHOD' => 'Phương thức thanh toán',
    'LBL_SALESORDER_PAYMENT_STATUS' => 'Tình trạng thanh toán',
    'LBL_SALESORDER_TYPE' => 'Type',
    'LBL_IS_SIGN_CONTRACT' => 'Ký hợp đồng',
    'LBL_COMPANY_CONTRACT_SIGNED_DATE' => 'Ngày công ty ký',
    'LBL_CUSTOMER_CONTRACT_SIGNED_DATE' => 'Ngày khách hàng ký',
    'LBL_SALESORDER_CONTRACT_STATUS' => 'Tình trạng hợp đồng',
    'LBL_CONTRACT_NO' => 'Số hợp đồng',
    'LBL_SALESORDER_CONTRACT_DELIVERY_STATUS' => 'Tình trạng gửi hợp đồng',
    'LBL_CONTRACT_INFORMATION' => 'Thông tin hợp đồng',
    'LBL_COMMISSION_INFORMATION' => 'Thông tin hoa hồng',
    'LBL_RECEIVED_BACK_CONTRACT' => 'Đã nhận lại hợp đồng',
    'LBL_PAYMENT_CONDITION' => 'Điều kiện thanh toán',
    'LBL_SALESORDER_LOST_REASON' => 'Lý do thất bại',
    'LBL_LOST_REASON_DESCRIPTION' => 'Mô tả lý do',
	// End Phu Vo
);

$jsLanguageStrings = array(
	'JS_PLEASE_REMOVE_LINE_ITEM_THAT_IS_DELETED' => 'Hãy xóa mặt hàng không tồn tại',
);
