<?php namespace GetNinja\Gravatar\Facades;

use Illuminate\Support\Facades;

class Gravatar extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'gravatar'; }

}