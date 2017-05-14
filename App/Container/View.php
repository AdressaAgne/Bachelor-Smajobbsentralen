<?php
namespace App\Container;

use Render, BaseController, Account, Direct;

class View {

	/**
	 * make a view, and render the code with Render class
	 *
	 * @method make
	 *
	 * @author [Agne Ødegaard]
	 *
	 * @param  [string] $url  [file]
	 * @param  [array] $vars [variables to send to file]
	 *
	 * @return string of rendered code
	 */
	public static function make($url, $vars = null){
		$url = preg_replace("/\\./uimx", "/", $url);

		return self::includeFile("public/view/{$url}.php", $vars);
	}

	/**
	 * return a view that requires authentication
	 *
	 * @method auth
	 *
	 * @author [Agne Ødegaard]
	 *
	 * @param  [string] $url    [file to render]
	 * @param  string $direct [url to go to if user is not Authenticated]
	 * @param  [array] $vars   [variables to send to file]
	 *
	 * @return [type]         [description]
	 */
	public static function auth($url, $direct = '/login', $vars = null){
		if(Account::isLoggedIn()){
			return self::make($url, $vars);
		}
		return Direct::re($direct);
	}

	/**
	 * Return a php file in the view folder
	 * @param  string  $filename
	 * @param  array   [$vars         = null]
	 * @return string/boolean
	 */
	public static function includeFile($filename, $vars = null){

		if (is_file($filename)) {
			$code = Render::code(file_get_contents($filename));
			
			//die(print_r(htmlspecialchars($code), true));
			
			ob_start();
				if(!is_null($vars)) extract($vars);
				if(!empty(BaseController::$site_wide_vars)) extract(BaseController::$site_wide_vars);
				eval("?>" . $code);
			return ob_get_clean();
		}

		return 'could not find: '.$filename;
	}

}
