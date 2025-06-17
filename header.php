<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php global $redux_demo; ?>
    <?php wp_head();?>
</head>
<body>
     <header class="header-style bg-primary-header">
        <?php get_template_part('template-parts/header/header', 'top'); ?>
        <?php get_template_part('template-parts/header/header', 'mid'); ?>
        <?php get_template_part('template-parts/header/header', 'menu'); ?>
    </header>
    <!-- header style end -->