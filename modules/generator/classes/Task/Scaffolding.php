<?php
	/**
	 * Help to generate CRUD based on bootstrap framefork
	 *
	 * @package    Konro1/Kohana-generator
	 * @category   Helpers
	 * @author     Yuriy Myrosh
	 */
	class Task_Scaffolding extends Minion_Task
	{
		protected $_options = array(
			'name' => FALSE,
			'fields' => FALSE,
		);

		public $fields = array();
		private $fields_regexp = '/([a-z0-9_]+):([a-z0-9_]+)(\[([0-9]+)\])?/i';


		/**
		 * Execute scafolding
		 *
		 * @param name    | string
		 * @param fields  | string
		 * @return null
		 */
		protected function _execute(array $params)
		{
			if ( ! $params['name'])
				die("name is required \n");

			if ( ! $params['fields'])
				die("fields is required \n");

			$this->fields = $this->parse_fields($params['fields']);

			$controller = Inflector::plural(Text::ucfirst($params['name']));
			$model = $params['name'];

			$controller = View::factory('controller', array(
				'controller' => $controller,
				'actions' => array(
					array(
						'name' => 'index',
						'code' => 'test',
					)
				)
			))->render();

		}

		private function parse_fields($fields_str)
		{
			$fields = array();

			$fields_parts = explode(' ', $fields_str);

			foreach ($fields_parts as $part)
			{
				preg_match($this->fields_regexp, $part, $matches);

				if ( ! isset($matches[1]))
				{
					throw new Exception('Unable to determine the field definition for "'.$part.'". Ensure they are name:type');
				}

				$fields[] = array(
					'name'       => strtolower($matches[1]),
					'type'       => isset($matches[2]) ? $matches[2] : 'string',
					'constraint' => isset($matches[4]) ? $matches[4] : null
				);
			}
			return $fields;
		}
	}
?>