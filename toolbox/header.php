<?php

Class Header
{
	public static $title = "Sans titre";
	public static $favicon = "images/utils/favicon.png";

	static function get_title() {
		return self::$title;
	}

	static function set_title($title) {
		self::$title = $title;
	}
	
	static function get_favicon() {
		return self::$favicon;
	}

	static function set_favicon($favicon) {
		self::$favicon = $favicon;
	}
}

?>
