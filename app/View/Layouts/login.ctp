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
<body class="login" ng-controller="CaseRecordSystemController">
	<div class="container">
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
