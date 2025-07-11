<?php
/**
 * The Grow Game functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package The_Grow_Game
 */


function builder_theme_enqueue_styles(){
    $parent_style = 'parent-style';
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'builder_theme_enqueue_styles', 99);


/**
 * Include games files
 */
include get_stylesheet_directory() . "/builder/class.BuilderApp.php";
