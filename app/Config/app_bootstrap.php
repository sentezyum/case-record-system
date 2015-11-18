<?php

# Allowing file extensions
Configure::write('Rule.FileExtensions', array('gif', 'jpeg', 'png', 'jpg', 'pdf', 'tiff'));

# Allowing file size type MB
Configure::write('Rule.MaxFileSize', 8);

# LOAD UPLOADER
CakePlugin::load('Uploader');


if (!defined('UPLOAD_DIR'))
{
  define('UPLOAD_DIR', WWW_ROOT . DS . 'upload');
}

# Load config
config('app_config');
?>
