<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
      <div class="account-wall">
        <div class="text-center"><i class="fa fa-balance-scale"></i></div>
        <?php echo $this->Form->create("User", array('class' => 'form-signin', 'inputDefaults' => array('label' => false, 'div' => false, 'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block'))))); ?>
          <?php echo $this->Form->input('User.mail', array('class' => 'form-control', 'placeholder' => 'Mail Adresi', 'autofocus' => 'autofocus')); ?>
          <?php echo $this->Form->input('User.password', array('class' => 'form-control', 'placeholder' => 'Şifre')); ?>
          <input type="submit" class="btn btn-lg btn-primary btn-block" value="Giriş" />
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</div>
