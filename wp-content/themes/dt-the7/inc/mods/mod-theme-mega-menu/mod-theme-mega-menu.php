<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once trailingslashit( dirname( __FILE__ ) ) . '/edit-menu-walker.class.php';
require_once trailingslashit( dirname( __FILE__ ) ) . '/mega-menu.class.php';

$mega_menu = new Dt_Mega_menu();
