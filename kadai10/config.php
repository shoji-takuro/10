<?php

require_once ( __DIR__ . '/lib/Facebook/autoload.php');

$fb = new Facebook\Facebook([
  'app_id' => '139095966736398', // Replace {app-id} with your app id
  'app_secret' => '6cc4fe2ffa32deca7ed405380be7a786',
  'default_graph_version' => 'v2.10',
  ]);

?>