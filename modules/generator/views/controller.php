<?php echo '<?php defined(\'SYSPATH\') OR die(\'No direct script access.\');' ?>

class Controller_<?php echo $controller ?> {

	<?php foreach ($actions as $action): ?>
		public function action_<?php echo $action['name']; ?> ()
		{
<?php echo $action['code']."\n"; ?>
		}
	<?php endforeach ?>
}