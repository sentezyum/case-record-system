<script type="text/javascript">
  var path = "<?php echo $this->request->url; ?>";
  var webroot = "<?php echo $this->webroot; ?>";
  var userIsAdmin = <?php echo Hash::get(isset($user) ? $user : array(), "User.is_admin") === true ? "true" : "false"; ?>;
  var debug = <?php echo Configure::read('debug'); ?>;
</script>
