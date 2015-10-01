<!DOCTYPE html>
<html ng-app="CaseRecordSystem">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php echo $this->element('settings'); ?>
	<?php echo $this->element('components'); ?>

	<?php echo $this->Html->css('style'); ?>
</head>
<body class="default" ng-controller="CaseRecordSystemController">
	<?php echo $this->element('menu'); ?>
	<div class="container">
	  <div class="row">
	    <div>
	      <?php echo $this->Flash->render() ?>
	    </div>
	  </div>
	</div>
	<div class="container">
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
