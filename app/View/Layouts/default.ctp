<!DOCTYPE html>
<html ng-app="CaseRecordSystem">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php echo $this->element('settings'); ?>
	<?php echo $this->element('components'); ?>

	<?php echo $this->Html->css('style'); ?>
</head>
<body class="default" ng-controller="CaseRecordSystemController">
	<?php echo $this->element('menu'); ?>
	<div class="container">
	  <div class="row">
	    <div class="col col-sm-8">
	      <?php echo $this->Flash->render() ?>
	    </div>
	  </div>
	</div>
	<div class="container">
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
