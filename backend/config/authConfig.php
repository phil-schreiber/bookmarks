<?php

return array(
			"base_url" => "http://localhost/hybridauth-git/hybridauth/",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => true
				),
				"Yahoo" => array(
					"enabled" => false,
					"keys" => array("key" => "", "secret" => ""),
				),
				"AOL" => array(
					"enabled" => false
				),
				"Google" => array(
					"enabled" => true,
					"keys" => array("id" => "268790427273-4rfr42b8peqhdm7dglkq9iqd41nee9mo.apps.googleusercontent.com", "secret" => "8ppo8KztwGQIjSgzusj2j3vW"),
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "370728589939713", "secret" => "62f4636903921a9baedd85689e3dd769"),
					"trustForwarded" => false
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "", "secret" => ""),
					"includeEmail" => false
				),
				// windows live
				"Live" => array(
					"enabled" => false,
					"keys" => array("id" => "", "secret" => "")
				),
				"LinkedIn" => array(
					"enabled" => false,
					"keys" => array("key" => "", "secret" => "")
				),
				"Foursquare" => array(
					"enabled" => false,
					"keys" => array("id" => "", "secret" => "")
				),
			),
			// If you want to enable logging, set 'debug_mode' to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => true,
			// Path to file writable by the web server. Required if 'debug_mode' is not false
			"debug_file" => "log.txt"
);
