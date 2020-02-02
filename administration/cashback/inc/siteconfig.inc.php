<?php
/*******************************************************************\
 * CashbackEngine v3.0
 * http://www.CashbackEngine.net
 *
  * Copyright (c) 2010-2017 CashbackEngine Software. All rights reserved.
 * ------------ CashbackEngine IS NOT FREE SOFTWARE --------------
\*******************************************************************/

	$settings   =   getSettings($pdo);
	
//Custom variables
$settings['results_per_page']   = 33;
// updateSettings
	define('SITE_TITLE', isset($settings['website_title']) ? $settings['website_title'] : '');
	define('SITE_MAIL', isset($settings['website_email']) ? $settings['website_email'] : '');
	define('EMAIL_FROM_NAME', isset($settings['email_from_name']) ? $settings['email_from_name']: '');
	define('NOREPLY_MAIL', isset($settings['noreply_email']) ? $settings['noreply_email'] : '');
	define('SITE_ALERTS_MAIL', isset($settings['alerts_email']) ? $settings['alerts_email'] : '');
	define('SITE_URL', isset($settings['website_url']) ? $settings['website_url'] : '');
	define('SITE_MODE', isset($settings['website_mode']) ? $settings['website_mode'] : '');
	define('SITE_HOME_TITLE', isset($settings['website_home_title']) ? $settings['website_home_title'] : '');
	define('SITE_LANGUAGE', isset($settings['website_language']) ? $settings['website_language'] : '');
	define('MULTILINGUAL', isset($settings['multilingual']) ? $settings['multilingual'] : '');
	define('SITE_TIMEZONE', isset($settings['website_timezone']) ? $settings['website_timezone'] : '');
	define('DATE_FORMAT', isset($settings['website_date_format']) ? $settings['website_date_format'] : '');
	define('SITE_CURRENCY', isset($settings['website_currency']) ? $settings['website_currency'] : '');
	define('SITE_CURRENCY_FORMAT', isset($settings['website_currency_format']) ? $settings['website_currency_format'] : 'EUR');
	define('SIGNUP_CAPTCHA', isset($settings['signup_captcha']) ? $settings['signup_captcha'] : '');
	define('ACCOUNT_ACTIVATION', isset($settings['account_activation']) ? $settings['account_activation'] : '');
	define('LOGIN_ATTEMPTS_LIMIT', isset($settings['login_attempts_limit']) ? $settings['login_attempts_limit'] : 5);
	define('LOGIN_ATTEMPTS', 5);
	define('STORES_LIST_STYLE', isset($settings['stores_list_style']) ? $settings['stores_list_style'] : '');
	define('SHARE_ICONS_STYLE', isset($settings['share_icons_style']) ? $settings['share_icons_style'] : '');
	define('STORES_DESCRIPTION_LIMIT', isset($settings['stores_description_limit']) ? $settings['stores_description_limit'] : '');
	define('COUPONS_DESCRIPTION_LIMIT', isset($settings['coupons_description_limit']) ? $settings['coupons_description_limit'] : '');
	define('ONE_REVIEW', isset($settings['one_review']) ? $settings['one_review'] : '');
	define('HOMEPAGE_REVIEWS_LIMIT', isset($settings['homepage_reviews_limit']) ? $settings['homepage_reviews_limit'] : '');
	define('TODAYS_COUPONS_LIMIT', isset($settings['todays_coupons_limit']) ? $settings['todays_coupons_limit'] : '');
	define('FEATURED_STORES_LIMIT', isset($settings['featured_stores_limit']) ? $settings['featured_stores_limit'] : '');
	define('POPULAR_STORES_LIMIT', isset($settings['popular_stores_limit']) ? $settings['popular_stores_limit'] : '');
	define('NEW_STORES_LIMIT', isset($settings['new_stores_limit']) ? $settings['new_stores_limit'] : '');
	define('RESULTS_PER_PAGE', isset($settings['results_per_page']) ? $settings['results_per_page'] : 30);
	define('COUPONS_PER_PAGE', isset($settings['coupons_per_page']) ? $settings['coupons_per_page'] : 30);
	define('SUBMIT_COUPONS', isset($settings['submit_coupons']) ? $settings['submit_coupons'] : '');
	define('MEMBERS_SUBMIT_COUPONS', isset($settings['members_submit_coupons']) ? $settings['members_submit_coupons'] : '');
	define('HIDE_COUPONS', isset($settings['hide_coupons']) ? $settings['hide_coupons'] : '');
	define('MIN_PAYOUT_PER_TRANSACTION', isset($settings['min_transaction']) ? $settings['min_transaction'] : '');
	define('MIN_PAYOUT', isset($settings['min_payout']) ? $settings['min_payout'] : '');
	define('CANCEL_WITHDRAWAL', isset($settings['cancel_withdrawal']) ? $settings['cancel_withdrawal'] : '');
	define('SIGNUP_BONUS', isset($settings['signup_credit']) ? $settings['signup_credit'] : '');
	define('REFER_FRIEND_BONUS', isset($settings['refer_credit']) ? $settings['refer_credit'] : '');
	define('CASHBACK_COMMISSION', isset($settings['cashback_commission']) ? $settings['cashback_commission'] : 0);
	/*define('REFERRAL_COMMISSION', $settings['referral_commission']);
	define('IMAGE_WIDTH', $settings['image_width']);
	define('IMAGE_HEIGHT', $settings['image_height']);
	define('SHOW_LANDING_PAGE', $settings['show_landing_page']);
	define('REVIEWS_APPROVE', $settings['reviews_approve']);
	define('MAX_REVIEW_LENGTH', $settings['max_review_length']);
	define('REVIEWS_PER_PAGE', $settings['reviews_per_page']);
	define('NEWS_PER_PAGE', $settings['news_per_page']);
	define('SHOW_CASHBACK_CALCULATOR', $settings['show_cashback_calculator']);
	define('SHOW_RETAILER_STATS', $settings['show_statistics']);
	define('SHOW_SITE_STATS', $settings['show_site_statistics']);
	define('NEW_COUPON_ALERT', $settings['email_new_coupon']);
	define('NEW_REVIEW_ALERT', $settings['email_new_review']);
	define('NEW_TICKET_ALERT', $settings['email_new_ticket']);
	define('NEW_TICKET_REPLY_ALERT', $settings['email_new_ticket_reply']);
	define('NEW_REPORT_ALERT', $settings['email_new_report']);
	define('SMTP_MAIL', $settings['smtp_mail']);
	define('SMTP_PORT', $settings['smtp_port']);
	define('SMTP_HOST', $settings['smtp_host']);
	define('SMTP_USERNAME', $settings['smtp_username']);
	define('SMTP_PASSWORD', $settings['smtp_password']);
	define('SMTP_SSL', $settings['smtp_ssl']);
	define('FACEBOOK_CONNECT', $settings['facebook_connect']);
	define('FACEBOOK_APPID', $settings['facebook_appid']);
	define('FACEBOOK_SECRET', $settings['facebook_secret']);
	define('FACEBOOK_PAGE', $settings['facebook_page']);
	define('SHOW_FB_LIKEBOX', $settings['show_fb_likebox']);
	define('TWITTER_PAGE', $settings['twitter_page']);
	define('REG_SOURCES', $settings['reg_sources']);
	define('ADDTHIS_ID', $settings['addthis_id']);
	define('GOOGLE_ANALYTICS', stripslashes($settings['google_analytics']));
	*/
	define('TIMENOW', time());
	define('HIDE_SUB_CATEGORIES', 1);
	define('ALLOW_API', 0);

	//if (REG_SOURCES != "" && strstr(REG_SOURCES, ',')) $reg_sources = explode(",",REG_SOURCES);

	// letters for alphabetical order 
	$alphabet = array ("0-9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

	// results per page dropdown
	$results_on_page = array("5", "10", "12", "24", "25", "40", "50", "100", "111111");

	// site languages
	$languages = array();
	/*$languages_sql = "SELECT * FROM cashbackengine_languages WHERE status='active' ORDER BY sort_order, language";
	$languages_result = smart_mysql_query($languages_sql);
	if (mysqli_num_rows($languages_result) > 0)
	{
		while ($languages_row = mysqli_fetch_array($languages_result))
		{
			$language_code = $languages_row['language_code'];
			$language_name = $languages_row['language'];
			$languages[$language_code] = $language_name;
		}
	}*/
$languages['FR'] = 'french';

?>