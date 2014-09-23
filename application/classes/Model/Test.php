<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Jam Model: Test
 *
 * @package applicaiton
 * @author -
 * @copyright  (c) 2011-2013 Despark Ltd.
 */
class Model_Test extends Jam_Model {

	public static function initialize(Jam_Meta $meta)
	{
		$meta
			->associations(array(
			))

			->fields(array(
				'id' => Jam::field('primary'),
				'name' => Jam::field('string'),
			))

			->validator('name', array('present' => TRUE));
	}
}