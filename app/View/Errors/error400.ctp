<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>
<div class="container">
  <div class="row">
		<div class="well" style="text-align:center;">
		  <h1><i class="fa fa-exclamation-circle"></i></h1>
		  <h2><?php echo $message; ?></h2>
			<hr size="1" />
		  <p><?php echo $this->History->goBack('Geri Dön', array('class' => 'btn btn-primary'), -1); ?></p>
		</div>
		<?php if (Configure::read('debug') > 0) { ?>
			<div class="well">
				<?php echo $this->element('exception_stack_trace'); ?>
			</div>
		<?php } ?>

	</div>
</div>
