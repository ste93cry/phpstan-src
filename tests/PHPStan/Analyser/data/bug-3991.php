<?php

namespace Bug3991;

use function PHPStan\Analyser\assertNativeType;
use function PHPStan\Analyser\assertType;

class Foo
{
	/**
	 * @param \stdClass|array|null $config
	 *
	 * @return \stdClass
	 */
	public static function email($config = null)
	{
		assertNativeType('mixed', $config);
		assertType('array|stdClass|null', $config);
		if (empty($config))
		{
			assertNativeType('mixed', $config);
			assertType('array|stdClass|null', $config);
			$config = new \stdClass();
		} elseif (! (is_array($config) || $config instanceof \stdClass)) {
			assertNativeType('mixed~array|stdClass|false|null', $config);
			assertType('*NEVER*', $config);
		}

		return new \stdClass($config);
	}
}
