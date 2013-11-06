<?php
/**
 * Log class to enable logging directly to a level
 *
 * static examples:
 *
 * Log::info('message');
 * Log::write('message', 'error');
 * Log::write('message'); // default level is 'ERROR'
 * Log::setDefaultLevel('info');
 *
 * instance examples:
 *
 * $log = new Log();
 * $log->info("message");
 *
 * $log2 = new Log('debug'); // sets default level
 * $log2->write("message");
 *
 * Note: static use of DefaultLevel is not thread safe
 */
class Log {

	public static $Level = array('NONE', 'ERROR', 'DEBUG',  'INFO', 'ALL');
	public static $DefaultLevel = 'ERROR';

	public static function write($message, $level=null)
	{
		if (! isset($level) )
		{
			$level = self::$DefaultLevel;
		}

		log_message($level, $message);
	}

	public static function setDefaultLevel($default_level)
	{
		$default_level = strtoupper($default_level);

		if ( in_array($default_level, self::$Level) )
		{
			self::$DefaultLevel = $default_level;
		}
		else
		{
			// fail silently for invalid log level
		}
	}

	public static function error($message)
	{
		log_message('ERROR', $message);
	}

	public static function info($message)
	{
		log_message('INFO', $message);
	}

	public static function debug($message)
	{
		log_message('DEBUG', $message);
	}

	function __construct($default_level = null)
	{
		$default_level = strtoupper($default_level);

		if ( in_array($default_level, self::$Level) )
		{
			self::$DefaultLevel = $default_level;
		}
		else
		{
			// fail silently for invalid log level
		}
	}

	function __call($method, $args)
	{
		$level = strtoupper($method);

		if ( in_array($level, self::$Level) )
		{
			if ( isset($args) )
			{
				$log_message($level, $args);
			}
		}
		else
		{
			// fail silently for invalid log level
		}
	}
}