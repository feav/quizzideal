<?php

// Error Reporting
@error_reporting(0);

/// MySQL Settings ///

/*
define('DB_NAME', 'cashback');	// MySQL database name
define('DB_USER', 'root');			// MySQL database user
define('DB_PASSWORD', 'mahakamsophie1989');		// MySQL database password
define('DB_HOST', 'localhost');				// MySQL database host name (in most cases, it's localhost)
*/

define('DB_NAME', 'quizz1091292_1vlwbc'); // MySQL database name
define('DB_USER', 'quizz1091292'); // MySQL database user
define('DB_PASSWORD', 'Timothee12300'); // MySQL database password
define('DB_HOST', '91.216.107.248'); // MySQL database host name (in most cases, it's localhost)


define("CashbackEngine", true);
define('PUBLIC_HTML_PATH', $_SERVER['DOCUMENT_ROOT']);
define('IMAGES_PATH', $_SERVER['DOCUMENT_ROOT'] . "/img/");
define('DOCS_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('CBengine_ROOT', dirname(__FILE__) . '/');
define('CBengine_PAGE', true);

require_once "db.inc.php";
require_once "function_sql.php";
require_once "functions.inc.php";

if (!defined('is_Setup')) {
	require_once "siteconfig.inc.php";
	require_once "timezone.inc.php";

	// setup time zone
	if (in_array(SITE_TIMEZONE, $timezone)) {
		date_default_timezone_set(SITE_TIMEZONE);
	}

	/*$lang = $_COOKIE['site_lang'];

		if (MULTILINGUAL !=0 && !empty($lang) && file_exists(DOCS_ROOT."/language/".$lang.".inc.php"))
		{
			define('USER_LANGUAGE', $lang);
			require_once(DOCS_ROOT."/language/".$lang.".inc.php");
		}
		else
		{
			define('USER_LANGUAGE', SITE_LANGUAGE);
			require_once(DOCS_ROOT."/language/".SITE_LANGUAGE.".inc.php");
		} */
}

/*// maintenance mode //
if (SITE_MODE == 'maintenance' && !$admin_panel)
{
require_once(DOCS_ROOT."/maintenance.php");
die();
}
 */

// delete redirection url after 10 minutes
if (isset($_SESSION['goto']) && $_SESSION['goto'] != "" && isset($_SESSION['goto_created']) && (time() - $_SESSION['goto_created'] > 600)) {
	unset($_SESSION['goto'], $_SESSION['goto_created'], $_SESSION['goRetailerID'], $_SESSION['goCouponID']);
}

?>