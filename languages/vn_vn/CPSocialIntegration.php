<?php

$languageStrings = Array(
    'CPSocialIntegration' => 'Tích hợp MXH',
	'SINGLE_CPSocialIntegration' => 'Tích hợp MXH',

    'LBL_SOCIAL_MESSAGE_MODAL_HINT' => 'Chọn một tin nhắn mẫu có sẵn hoặc soạn một tin nhắn mới trong ô nhập bên dưới',
    'LBL_SOCIAL_MESSAGE_MODAL_SENDER' => 'Gửi tin nhắn từ',
    'LBL_SOCIAL_MESSAGE_MODAL_MESSAGE_TEMPLATE' => 'Tin nhắn mẫu',
    'LBL_SOCIAL_MESSAGE_MODAL_CREATE_TEMPLATE' => 'Tạo mới',
    'LBL_SOCIAL_MESSAGE_MODAL_VARIABLE' => 'Biến merge',
    'LBL_SOCIAL_MESSAGE_MODAL_INSERT_VARIABLE' => 'Chèn',
    'LBL_SOCIAL_MESSAGE_MODAL_MESSAGE_CONTENT' => 'Nội dung tin nhắn',

    // Added by Hieu Nguyen on 2020-01-15
    'LBL_SOCIAL_CONFIG_ADD_FB_FANPAGE_MODAL_TITLE' => 'Thêm Facebook Fanpage',
    'LBL_SOCIAL_CONFIG_ADD_FB_FANPAGE_MODAL_HINT' => 'Nhập vào Facebook App ID và Facebook App Secret của ứng dụng Facebook mà bạn đang quản lý',
    'LBL_SOCIAL_CONFIG_FACEBOOK_APP_ID' => 'Facebook App ID',
    'LBL_SOCIAL_CONFIG_FACEBOOK_APP_SECRET' => 'Facebook App Secret',
    'LBL_SOCIAL_CONFIG_CLICK_HERE_TO_CONTINUE' => 'Click vào đây để tiếp tục',
    'LBL_SOCIAL_CONFIG_FB_FANPAGE_SELECTOR_HINT' => 'Vui lòng chọn Facebook fanpage để kết nối với CRM',
    'LBL_SOCIAL_CONFIG_FB_FANPAGE_SELECTOR_CONNECT_BUTTON' => 'Kết nối',
    'LBL_SOCIAL_CONFIG_FB_FANPAGE_SELECTOR_NO_FANPAGE_SELECTED_ERROR_MSG' => 'Bạn phải chọn ít nhất 1 fanpage để kết nối!',
    // End Hieu Nguyen
);

$jsLanguageStrings = array(
    // Added by Hieu Nguyen on 2020-01-15
    'JS_SOCIAL_CONFIG_SAVE_SETTINGS_SUCCESS_MSG' => 'Lưu thiết lập thành công.',
	'JS_SOCIAL_CONFIG_SAVE_SETTINGS_ERROR_MSG' => 'Lưu thiết lập thất bại, vui lòng thử lại!',
    'JS_SOCIAL_CONFIG_CONNECT_FB_FANPAGE_SUCCESS_MSG' => 'Kết nối Facebook fanpage thành công.',
    'JS_SOCIAL_CONFIG_CONNECT_FB_FANPAGE_ERROR_MSG' => 'Kết nối Facebook fanpage thất bại, bạn vui lòng thử lại!',
    'JS_SOCIAL_CONFIG_CONNECT_ZALO_OA_SUCCESS_MSG' => 'Kết nối Zalo OA thành công.',
    'JS_SOCIAL_CONFIG_CONNECT_ZALO_OA_ERROR_MSG' => 'Kết nối Zalo OA thất bại, bạn vui lòng thử lại!',
	'JS_SOCIAL_CONFIG_ZALO_DISCONNECT_OA_CONFIRM_MSG' => 'Bạn có muốn ngắt kết nối đến QA này?',
	'JS_SOCIAL_CONFIG_ZALO_DISCONNECT_OA_SUCCESS_MSG' => 'Ngắt kết nối OA thành công.',
	'JS_SOCIAL_CONFIG_ZALO_DISCONNECT_OA_ERROR_MSG' => 'Ngắt kết nối OA thất bại, vui lòng thử lại!',
	'JS_SOCIAL_SYNC_ZALO_FOLLOWER_IDS_SUCCESS_MSG' => 'Lệnh này đã được lưu vào hàng đợi để xử lý tự động ở chế độ chạy nền.',
	'JS_SOCIAL_SYNC_ZALO_FOLLOWER_IDS_ERROR_MSG' => 'Đồng bộ IDs người quan tâm thất bại, vui lòng thử lại!',
	'JS_SOCIAL_CONFIG_ZALO_OA_EXPIRED_ERROR_MSG' => 'Không thể thực thi lệnh. Zalo OA đã hết hạn!',
    'JS_SOCIAL_INTEGRATION_UNKNOWN_ERROR_MSG' => 'Có lỗi xảy ra, bạn vui lòng thử lại!',
    'JS_SOCIAL_INTEGRATION_NO_FACEBOOK_PAGE_CONNECTED_ERROR_MSG' => 'Hiện tại hệ thống chưa kết nối với Facebook Page nào. Vui lòng liên hệ người quản trị hệ thống!',
    'JS_SOCIAL_INTEGRATION_NO_ZALO_OA_CONNECTED_ERROR_MSG' => 'Hiện tại hệ thống chưa kết nối với Zalo Official Account nào. Vui lòng liên hệ người quản trị hệ thống!',
    'JS_SOCIAL_INTEGRATION_NO_ZALO_SHOP_OA_CONNECTED_ERROR_MSG' => 'Hiện tại hệ thống chưa kết nối với Zalo Shop Official Account nào. Vui lòng liên hệ người quản trị hệ thống!',
    'JS_SOCIAL_INTEGRATION_FACEBOOK_PAGE_NOT_CONNECTED_ERROR_MSG' => 'Hiện tại hệ thống chưa kết nối với Facebook Page %s. Vui lòng liên hệ người quản trị hệ thống!',
    'JS_SOCIAL_INTEGRATION_ZALO_OA_NOT_CONNECTED_ERROR_MSG' => 'Hiện tại hệ thống chưa kết nối với Zalo Official Account %s. Vui lòng liên hệ người quản trị hệ thống!',
    'JS_SOCIAL_MESSAGE_EMPTY_TARGET_LIST_ERROR_MSG' => 'Marketing List cần phải có ít nhất 1 khách hàng để có gửi được tin nhắn MXH!',
    'JS_SOCIAL_MESSAGE_MODAL_TITLE' => 'Tin nhắn %s',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_CONFIRM_MSG' => 'Bạn có chắc chắn muốn gửi tin nhắn này đi?',
    'JS_SOCIAL_MESSAGE_MODAL_LOAD_METADATA_ERROR_MSG' => 'Không tải được danh sách tin nhắn mẫu và các biến, bạn vui lòng thử lại!',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_FOLLOWER_ID_NOT_SYNCED_WITH_ZALO_OA_ERROR_MSG' => 'Không thể gửi được tin nhắn vì khách hàng này chưa được đồng bộ ID hoặc chưa quan tâm với Zalo Official Account đã chọn!',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_SOCIAL_ID_NOT_FOLLOWED_TO_ZALO_OA_ERROR_MSG' => 'Không thể gửi được tin nhắn vì khách hàng này chưa quan tâm Zalo Official Account đã chọn!',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_ERROR_AND_QUEUED_MSG' => 'Không gửi được tin nhắn %s vào lúc này. Tin nhắn đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_UNKNOWN_ERROR_MSG' => 'Không gửi được tin nhắn %s vào lúc này. Bạn vui lòng kiểm tra lịch sử gửi tin nhắn, hoặc thử lại vào lúc khác!',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_SUCCESS_MSG' => 'Đã gửi tin nhắn %s thành công!',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MESSAGE_QUEUED_MSG' => 'Tin nhắn %s đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MASS_MESSAGE_ERROR_AND_QUEUED_MSG' => 'Một số tin nhắn %s không thể gửi được vào lúc này. Những tin nhắn đó đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_SOCIAL_MESSAGE_MODAL_SEND_MASS_MESSAGE_UNKNOWN_ERROR_MSG' => 'Một số tin nhắn %s không thể gửi được vào lúc này. Bạn vui lòng kiểm tra lịch sử gửi tin nhắn, hoặc thử lại vào lúc khác!',
    'JS_SOCIAL_ARTICLE_BROADCAST_MODAL_SEND_RESULT_UNKNOWN_ERROR_MSG' => 'Không gửi được bài viết %s vào lúc này. Tin nhắn đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_SOCIAL_ARTICLE_BROADCAST_MODAL_SEND_RESULT_SUCCESS_MSG' => 'Đã gửi bài viết %s thành công!',
    'JS_SOCIAL_ARTICLE_BROADCAST_MODAL_SEND_RESULT_QUEUED_MSG' => 'Bài viết %s đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_SYNC_ZALO_ARTICLES_HINT' => 'Chọn một OA để lấy bài viết từ Zalo về CRM',
    'JS_SYNC_SOCIAL_ARTICLES_ERROR_MSG' => 'Đồng bộ thất bại. Bạn vui lòng thử lại hoặc thông báo với người quản trị!',
    'JS_SYNC_SOCIAL_ARTICLES_SUCCESS_MSG' => 'Đồng bộ thành công!',
    'JS_ZALO_OA_API_OUT_OF_RATE_LIMIT_ERROR_MSG' => 'Không thể gửi tin nhắn vào lúc này vì Zalo Official Account API đã đạt giới hạn số lần gửi / phút. Yêu cầu này đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_ZALO_ARTICLE_API_OUT_OF_RATE_LIMIT_ERROR_MSG' => 'Không thể gửi bài viết vào lúc này vì Zalo Article API đã đạt giới hạn số lần gửi / phút. Yêu cầu này đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_ZALO_ARTICLE_SEND_OUT_OF_QUOTA_ERROR_MSG' => 'Không thể gửi bài viết Zalo vào lúc này vì đã đạt giới hạn số lần gửi / tháng. Bạn vui lòng gửi lại vào tháng tiếp theo!',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_TITLE' => 'Gửi yêu cầu cung cấp thông tin liên hệ Zalo',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_HINT' => 'Chọn một OA để gửi yêu cầu chia sẻ thông tin liên hệ từ người quan tâm trên Zalo.',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_FOLLOWER_ID_NOT_SYNCED_WITH_ZALO_OA_ERROR_MSG' => 'Không thể gửi được yêu cầu vì khách hàng này chưa được đồng bộ ID hoặc chưa quan tâm với Zalo Official Account đã chọn!',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_SOCIAL_ID_NOT_FOLLOWED_TO_ZALO_OA_ERROR_MSG' => 'Không thể gửi được yêu cầu vì khách hàng này chưa quan tâm Zalo Official Account đã chọn!',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_UNKNOWN_ERROR_MSG' => 'Không gửi được yêu cầu vào lúc này. Yêu cầu này đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_SUCCESS_MSG' => 'Gửi yêu cầu thành công!',
    'JS_ZALO_REQUEST_SHARE_CONTACT_INFO_QUEUED_MSG' => 'Yêu cầu này đã được lưu vào hàng đợi để gửi tự động ở chế độ chạy nền.',
    'JS_SYNC_PRODUCTS_TO_ZALO_SHOP_HINT' => 'Chọn một OA để đồng bộ Sản phẩm từ CRM sang Zalo',
    'JS_SYNC_PRODUCTS_TO_ZALO_SHOP_SELECTED_PRODUCTS_COUNT' => 'Số lượng Sản phẩm đã chọn để đồng bộ: ',
    'JS_SYNC_PRODUCTS_TO_ZALO_SHOP_CREATE_NEW_AND_UPDATE_EXISTING_PRODUCTS' => 'Tạo mới & Cập nhật SP',
    'JS_SYNC_PRODUCTS_TO_ZALO_SHOP_CREATE_NEW_PRODUCTS_ONLY' => 'Chỉ tạo mới SP',
    'JS_SYNC_PRODUCTS_TO_ZALO_SHOP_ERROR_MSG' => 'Đồng bộ thất bại các sản phẩm sau: [%s]. Bạn vui lòng thử lại hoặc thông báo với người quản trị!',
    'JS_SYNC_PRODUCTS_TO_ZALO_SHOP_SUCCESS_MSG' => 'Đồng bộ thành công!',
    // End Hieu Nguyen

    // Added by Phu Vo
    'JS_REMOVE_KEYWORD' => 'Xóa từ khóa',
    'JS_SOCIAL_CONFIG_FACEBOOK_FANPAGE_EXPIRED_ERROR_MSG' => 'Không thể thực thi lệnh. Fanpage này đã hết hạn!',
    'JS_SOCIAL_SYNC_FACEBOOK_FOLLOWER_IDS_ERROR_MSG' => 'Đồng bộ IDs người quan tâm thất bại, vui lòng thử lại!',
    'JS_SOCIAL_SYNC_FACEBOOK_FOLLOWER_IDS_SUCCESS_MSG' => 'Lệnh này đã được lưu vào hàng đợi để xử lý tự động ở chế độ chạy nền.',
    'JS_SOCIAL_CONFIG_FACEBOOK_DISCONNECT_FANPAGE_CONFIRM' => 'Bạn có muốn ngắt kết nối đến Fanpage này?',
    'JS_SOCIAL_CONFIG_FACEBOOK_DISCONNECT_FANPAGE_ERROR_MSG' => 'Ngắt kết nối fanpage thất bại, vui lòng thử lại!',
    'JS_SOCIAL_CONFIG_FACEBOOK_DISCONNECT_FANPAGE_SUCCESS_MSG' => 'Ngắt kết nối Facebook fanpage thành công.',
    // End Phu Vo
);
