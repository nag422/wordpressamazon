<?php

/**
 * Header template
 * 
 * @package Aquila
 */
?>
<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
  <title>Durvani | Webdevelopment</title>
  <meta charset="<?php bloginfo('charset') ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
</head>

<body class="dyno-template home-01">
  <?php

  if (function_exists('wp_body_open')) {
    wp_body_open();
  }

  ?>
  <?php get_template_part('template-parts/navbar/nav'); ?>