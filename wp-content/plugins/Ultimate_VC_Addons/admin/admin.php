<?php
if(!class_exists('Ultimate_Admin_Area')){
	class Ultimate_Admin_Area{
		function __construct(){
			if(get_option('ultimate_updater') === 'enabled'){
				if ($_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['HTTP_HOST'] !== 'localhost:8888' && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1' && $_SERVER['REMOTE_ADDR'] !== '::1'){
					/* check_for_update */
					add_action( 'plugins_loaded', array($this, 'check_for_update') );
					//add_action( 'in_plugin_update_message-Ultimate_VC_Addons/Ultimate_VC_Addons.php', array($this,'addUltimateUpgradeLink'));

					add_action( 'admin_notices', array( $this, 'display_notice' ) );
				}
			}
			/* add admin menu */
			add_action( 'admin_menu', array($this,'register_brainstorm_menu'));
			add_action( 'wp_ajax_update_ultimate_options', array($this,'update_settings'));
			add_action( 'wp_ajax_update_ultimate_keys', array($this,'update_verification'));
			add_action( 'wp_ajax_grant_access', array($this,'grant_developer_access'));
			add_action( 'wp_ajax_update_access', array($this,'update_developer_access'));
			add_action( 'wp_ajax_update_dev_notes', array($this,'update_dev_notes'));
			add_action( 'init', array($this,'process_developer_login'));
			add_action( 'admin_init', array( $this, 'check_developer_access') );
			add_filter( 'custom_menu_order', array($this,'bsf_submenu_order' ));
		}
		function bsf_submenu_order( $menu_ord ) 
		{
			global $submenu;
		
			// Enable the next line to see all menu orders
			//echo '<pre>'.print_r($submenu,true).'</pre>';
		
			if(isset($submenu['bsf-dashboard'])){
				$arr = array();
				$arr[] = $submenu['bsf-dashboard'][0];
				$arr[] = $submenu['bsf-dashboard'][1];
				$arr[] = $submenu['bsf-dashboard'][3];
				$arr[] = $submenu['bsf-dashboard'][4];
				$arr[] = $submenu['bsf-dashboard'][2];
				$submenu['bsf-dashboard'] = $arr;
			}
		
			return $menu_ord;
		}
		function register_brainstorm_menu(){
			add_menu_page( 
					'Brainstorm Force', 
					'Brainstorm', 
					'administrator',
					'bsf-dashboard', 
					array($this,'load_dashboard'), 
					plugins_url( '../assets/img/icon-16.png',__FILE__ ), 79 );
			add_submenu_page(
					"bsf-dashboard",
					__("Ultimate Addons Modules","smile"),
					__("Modules","smile"),
					"administrator",
					"ultimate-modules",
					array($this,'load_modules'));
			add_submenu_page(
					"bsf-dashboard",
					__("Ultimate Addons Support","smile"),
					__("Support","smile"),
					"administrator",
					"ultimate-support",
					array($this,'load_support'));
			/*
			if(get_option('ultimate_updater') === 'enabled'){
				add_submenu_page(
						"bsf-dashboard",
						__("Update Plugin","smile"),
						__("Auto Update","smile"),
						"administrator",
						"ultimate-updater",
						array($this,'load_updater'));
			} else {
				delete_option('ultimate_keys');
			}
			*/
		}
		function load_modules(){
			require_once('modules.php');
		}
		
		function load_dashboard(){
			require_once('dashboard.php');
		}
		function load_support(){
			require_once('support.php');
		}
		function load_updater(){
			if(isset($_GET['action']) && $_GET['action']==='upgrade') {
				$this->upgradeFromMarketplace();
			}else{
				require_once('updater/updater.php');
			}
		}
		function check_for_update(){
			require_once('updater/update-notifier.php');
			new Ultimate_Auto_Update(ULTIMATE_VERSION, 'http://ultimate.sharkslab.com/updates/?'.time(), 'Ultimate_VC_Addons/Ultimate_VC_Addons.php');
		}
		function update_settings(){
			if(isset($_POST['ultimate_row'])){
				$ultimate_row = $_POST['ultimate_row'];
			} else {
				$ultimate_row = 'disable';
			}
			$result1 = update_option('ultimate_row',$ultimate_row);
			if(isset($_POST['ultimate_animation'])){
				$ultimate_animation = $_POST['ultimate_animation'];
			} else {
				$ultimate_animation = 'disable';
			}
			$result2 = update_option('ultimate_animation',$ultimate_animation);
			if($result1 || $result2){
				echo 'success';
			} else {
				echo 'failed';
			}
			die();
		}
		function update_verification(){
			$envato_username = $_POST['envato_username'];
			$envato_api_key = $_POST['envato_api_key'];
			$purchase_code = $_POST['ultimate_purchase_code'];
			// API Key - e09g6o7hx0zug6auhkzrnd0hkq7d6n4x
			$url = 'http://marketplace.envato.com/api/edge/brainstormforce/e09g6o7hx0zug6auhkzrnd0hkq7d6n4x/verify-purchase:'.$purchase_code.'.json';
			$json = wp_remote_get($url);
			$result = json_decode($json['body'], true);
			if(isset($result['verify-purchase']['buyer']) && $result['verify-purchase']['buyer'] == $envato_username){
				$ultimate_keys = array(
					"envato_username" => $envato_username,
					"envato_api_key" => $envato_api_key,
					"ultimate_purchase_code" => $purchase_code,
				);
				$result = update_option('ultimate_keys',$ultimate_keys);
				if($result){
					echo 'success';
				} else {
					echo 'failed';
				}
			} else {
				echo 'credentials';
			}
			die();
		}
		public static function getUltimateUpgradeLink() {
			$ultimate_keys = get_option('ultimate_keys');
            $username = $ultimate_keys['envato_username'];
            $api_key =  $ultimate_keys['envato_api_key'];
            $purchase_code =  $ultimate_keys['ultimate_purchase_code'];
			//echo '<style type="text/css" media="all">tr#ultimate-addons-for-visual-composer+tr.plugin-update-tr a.thickbox + em { display: none; }</style>';
			if(empty($username) || empty($api_key) || empty($purchase_code)) {
				return '<a href="'.wp_nonce_url( admin_url('admin.php?page=bsf-dashboard')).'">'.__('Activate your license for one click update.', 'ultimate').'</a>';
			} else {
				$activation_check = check_license_activation($purchase_code);
				if($activation_check !== ''){
					$activation_check = unserialize($activation_check);
				}
				$status = $activation_check['status'];
				$code = $activation_check['code'];
				if($status == "Activated" && $code == 200){
					return '<a href="'.wp_nonce_url( admin_url('admin.php?page=bsf-dashboard&action=upgrade')).'">'.__('Update Ultimate Addons for Visual Composer.', 'ultimate').'</a>';
				} else {
					return '<a href="'.wp_nonce_url( admin_url('admin.php?page=bsf-dashboard')).'">'.__('Activate your license for one click update.', 'ultimate').'</a>';
				}
			}
		}
		/*
		* @ Deprecated from version 3.3.1
		*/
		function addUltimateUpgradeLink() {
			$ultimate_keys = get_option('ultimate_keys');
            $username = $ultimate_keys['envato_username'];
            $api_key =  $ultimate_keys['envato_api_key'];
            $purchase_code =  $ultimate_keys['ultimate_purchase_code'];
			//echo '<style type="text/css" media="all">tr#ultimate-addons-for-visual-composer+tr.plugin-update-tr a.thickbox + em { display: none; }</style>';
			if(empty($username) || empty($api_key) || empty($purchase_code)) {
				echo ' <a href="http://codecanyon.net/item/ultimate-addons-for-visual-composer/6892199?ref=brainstormforce">'.__('Download new version from CodeCanyon.', 'ultimate').'</a>';
			} else {
				$activation_check = check_license_activation($purchase_code);
				if($activation_check !== ''){
					$activation_check = unserialize($activation_check);
				}
				$status = $activation_check['status'];
				$code = $activation_check['code'];
				if($status == "Activated" && $code == 200){
					echo '<a href="'.wp_nonce_url( admin_url('admin.php?page=bsf-dashboard&action=upgrade')).'">'.__('Update Ultimate Addons for Visual Composer.', 'ultimate').'</a>';
				} else {
					echo '<a href="'.wp_nonce_url( admin_url('admin.php?page=bsf-dashboard')).'">'.__('Activate your license for one click update.', 'ultimate').'</a>';
				}
			}
		}
		/**
		 * Upgrade plugin from the Envato marketplace.
		 */
		public function upgradeFromMarketplace() {
			if ( ! current_user_can('update_plugins') )
				wp_die(__('You do not have sufficient permissions to update plugins for this site.'));
			$title = __('Update Ultimate Addons for Visual Composer Plugin', 'ultimate');
			$parent_file = 'options-general.php';
			$submenu_file = 'options-general.php';
			require_once ABSPATH . 'wp-admin/admin-header.php';
			require_once ('updater/auto-update.php');
			$upgrader = new UltAutomaticUpdater( new Plugin_Upgrader_Skin( compact('title', 'nonce', 'url', 'plugin') ) );
			$upgrader->upgradeUltimate();
			include ABSPATH . 'wp-admin/admin-footer.php';
			exit();
		}
		/*
		* Display admin notices for plugin activation
		*/
		function display_notice(){
			global $hook_suffix;
			$ultimate_keys = get_option('ultimate_keys');
            $username = $ultimate_keys['envato_username'];
            $api_key =  $ultimate_keys['envato_api_key'];
            $purchase_code =  $ultimate_keys['ultimate_purchase_code'];
			$activation_check = check_license_activation($purchase_code);
			if($activation_check !== ''){
				$activation_check = @unserialize($activation_check);
			}
			if($username == ""){
				$status = "Deactivated";
			} else {
				$status = $activation_check['status'];
			}
			$code = $activation_check['code'];
			if($status == "Deactivated"){
				if ( $hook_suffix == 'plugins.php' ){
				?>
	<div class="updated" style="padding: 0; margin: 0; border: none; background: none;">
		<style type="text/css">
	.ult_activate{min-width:825px;background: #FFF;border:1px solid #0096A3;padding:5px;margin:15px 0;border-radius:3px;-webkit-border-radius:3px;position:relative;overflow:hidden}
	.ult_activate .ult_a{position:absolute;top:5px;right:10px;font-size:48px;}
	.ult_activate .ult_button{font-weight:bold;border:1px solid #029DD6;border-top:1px solid #06B9FD;font-size:15px;text-align:center;padding:9px 0 8px 0;color:#FFF;background:#029DD6;-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px}
	.ult_activate .ult_button:hover{text-decoration:none !important;border:1px solid #029DD6;border-bottom:1px solid #00A8EF;font-size:15px;text-align:center;padding:9px 0 8px 0;color:#F0F8FB;background:#0079B1;-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px}
	.ult_activate .ult_button_border{border:1px solid #0096A3;-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px;background:#029DD6;}
	.ult_activate .ult_button_container{cursor:pointer;display:inline-block; padding:5px;-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px;width:215px}
	.ult_activate .ult_description{position:absolute;top:8px;left:230px;margin-left:25px;color:#0096A3;font-size:15px;z-index:1000}
	.ult_activate .ult_description strong{color:#0096A3;font-weight:normal}
		</style>
			<div class="ult_activate">
				<div class="ult_a"><img style="width:1em;" src="<?php echo plugins_url("img/logo-icon.png",__FILE__); ?>" alt=""></div>
				<div class="ult_button_container" onclick="document.location='<?php echo admin_url('admin.php?page=bsf-dashboard'); ?>'">
					<div class="ult_button_border">
						<div class="ult_button"><span class="dashicons-before dashicons-admin-network" style="padding-right: 6px;"></span><?php esc_html_e('Activate your license', 'smile');?></div>
					</div>
				</div>
				<div class="ult_description"><h3 style="margin:0;padding: 2px 0px;"><strong><?php _e('Almost done!','smile'); ?></strong></h3><p style="margin: 0;"><?php _e('Please activate your copy of the Ultimate Addons for Visual Composer to receive automatic updates & get premium support','smile'); ?></p></div>
			</div>
	</div>
				<?php
				} else if($hook_suffix == 'post-new.php' || $hook_suffix == 'edit.php' || $hook_suffix == 'post.php'){
				?>
				
				<div class="updated fade">
					<p><?php _e('Howdy! Please <a href="'.admin_url('admin.php?page=bsf-dashboard').'">activate your copy </a> of the Ultimate Addons for Visual Composer to receive automatic updates & get premium support.','smile');?>
					<span style="float: right; padding: 0px 4px; cursor: pointer;" class="uavc-activation-notice">X</span>
					</p>
				</div>
				<script type="text/javascript">
				jQuery(".uavc-activation-notice").click(function(){
					jQuery(this).parents(".updated").fadeOut(800);
				});
				</script>
				
				<?php	
				}
			}
		}
		
		function process_developer_login(){
			$interval = get_option('access_time');
			$now = time();
			if($interval <= $now){
				update_option('developer_access',false);
			}
			require_once( ABSPATH . 'wp-includes/pluggable.php' );  
			$basename = basename($_SERVER['SCRIPT_NAME']);
			if($basename=='wp-login.php'){
				if(isset($_GET['access_token'])){
					$access = get_option('developer_access'); 
					$access_token = get_option('access_token');
					$verify_token = $_GET['access_token'];
					$verified = ($access_token === $verify_token) ? true : false;
					if(isset($_GET['developer_access']) && $access && $verified)
					{
						$user_login = base64_decode($_GET['access_id']);
						$user =  get_user_by('login',$user_login);
						$user_id = $user->ID;
						wp_set_current_user($user_id, $user_login);
						wp_set_auth_cookie($user_id);
						$redirect_to = user_admin_url();
						setcookie("DeveloperAccess", "active", time()+86400);  /* expire in 24 hour */
						wp_safe_redirect( $redirect_to );
						exit();
					}
				}
			}
		}

		function grant_developer_access(){
			global $current_user;
			$user = base64_encode($current_user->user_login);
			$email = $current_user->user_email;
			// $token = bin2hex(openssl_random_pseudo_bytes(32));
			$token = ult_generate_rand_id();
			$url = wp_nonce_url( get_site_url().'/wp-login.php?developer_access=true&access_id='.$user.'&access_token='.$token);
			
			$ultimate_keys = get_option('ultimate_keys');
            $username = $ultimate_keys['envato_username'];
			$purchase_code =  $ultimate_keys['ultimate_purchase_code'];
			
			$subject = $message = $vc_version = '';
			if(defined("WPB_VC_VERSION"))
				$vc_version = WPB_VC_VERSION;
			else
				$vc_version = 'Not Defined';
			$subject = $current_user->user_login.' has granted developer access to you.';
			$headers[] = 'From: '.$current_user->user_login.' <'.$email.'>';
			$headers[] = 'Cc: sujay@brainstormforce.com';
			$headers[] = 'Cc: pratikc@brainstormforce.com';
			$headers[] = 'Cc: amits@brainstormforce.com';
			$message = '<p>You have been granted access to '. get_site_url() .'</p> ' . "\r\n";
			$message .= '<p>Click on the following URL to access the site admin - </p>' . "\r\n";
			$message .= '<p><a href="'.$url.'">'.$url.'</a></p>';
			$message .= '<table width="80%" cellpadding="6" border="0" style="text-align: left; border-bottom: 1px solid #ddd;">
						  <caption style="text-align:left; padding-bottom:10px; padding-left:5px;">
							Website Info:
						  </caption>
						  <tr  style="background:#eee;">
							<th width="30%" scope="row">WordPress Version</th>
							<td width="70%">'.get_bloginfo( "version" ).'</td>
						  </tr>
						  <tr>
							<th scope="row">Envato Username</th>
							<td>'.$username.'</td>
						  </tr>
						  <tr  style="background:#eee;">
							<th scope="row">Purchase Code</th>
							<td>'.$purchase_code.'</td>
						  </tr>
						  <tr>
							<th scope="row">Active Theme</th>
							<td>'.wp_get_theme().'</td>
						  </tr>
						   <tr>
							<th scope="row">VC Version</th>
							<td>'.$vc_version.'</td>
						  </tr>
						</table>';
			$message .= '<p><strong> Our plugins on site - </strong></p>
				<table  width="80%" cellpadding="6" border="0" style="text-align: left; border-bottom: 1px solid #ddd;">
                    <thead style="background: #eee;">
                    	<tr>
                        	<th>Plugin</th>
                            <th>Version</th>
                            <th>Status</th>
                        </tr>
					</thead>
                    <tbody>';
				$plugins = get_plugins();
				foreach ( $plugins as $plugin => $data ) {
					$plugin_name = $data['Name'];
					$plugin_author = $data['Author'];
					$plugin_version = $data['Version'];
					$plugin_file = $plugin;
					$plugin_status = is_plugin_active( $plugin ) ? 'Active' : 'Inactive';
					if($plugin_author == "Brainstorm Force"){
						$message .= '<tr>
							<th>'.$plugin_name.'</th>
							<th>'.$plugin_version.'</th>
							<th>'.$plugin_status.'</th>
						</tr>';
					}
				}
				$message .= '	</tbody>
				</table>';
			$message .= '<p><strong> Other Active plugins on site - </strong></p>
				<table  width="80%" cellpadding="6" border="0" style="text-align: left; border-bottom: 1px solid #ddd;">
                    <thead style="background: #eee;">
                    	<tr>
                        	<th>Plugin</th>
                            <th>Version</th>
                            <th>Status</th>
                        </tr>
					</thead>
                    <tbody>';
				$plugins = get_plugins();
				foreach ( $plugins as $plugin => $data ) {
					$plugin_name = $data['Name'];
					$plugin_author = $data['Author'];
					$plugin_version = $data['Version'];
					$plugin_file = $plugin;
					$plugin_status = is_plugin_active( $plugin ) ? 'Active' : 'Inactive';
					if($plugin_author !== "Brainstorm Force" && $plugin_status == "Active"){
						$message .= '<tr>
							<th>'.$plugin_name.'</th>
							<th>'.$plugin_version.'</th>
							<th>'.$plugin_status.'</th>
						</tr>';
					}
				}
				$message .= '	</tbody>
				</table>';
			add_filter( 'wp_mail_content_type', array($this,'set_html_content_type') );
			if(wp_mail('nitiny@brainstormforce.com', $subject, $message, $headers)){
				echo 'Access Granted!';
				update_option('developer_access',true);
				$interval = time()+(3 * 24 * 60 * 60);
				update_option('access_time',$interval);
				update_option( 'access_token', $token );
			} else {
				echo 'Something went wrong. Please try again.';
				update_option('developer_access',false);
				$interval = time();
				update_option('access_time',$interval);
			}
			
			remove_filter( 'wp_mail_content_type', array($this,'set_html_content_type') );
			
			die();
		}
		function update_developer_access(){
			global $current_user;
			$user = base64_encode($current_user->user_login);
			$email = $current_user->user_email;
			//$token = bin2hex(openssl_random_pseudo_bytes(32));
			$token = ult_generate_rand_id();
			$url = wp_nonce_url( get_site_url().'/wp-login.php?developer_access=true&access_id='.$user.'&access_token='.$token);
			$subject = $message = '';
			if(isset($_POST['access'])){
				$access = $_POST['access'];
				$value = ($access == "extend") ? true : false;
				if($access == "extend"){
					$interval = time()+(3 * 24 * 60 * 60);
					if(update_option('access_time',$interval)){
						echo "Access Extended!";
						update_option( 'access_token', $token );
						$subject = $current_user->user_login.' has extended developer access for you.';
						$headers[] = 'From: '.$current_user->user_login.' <'.$email.'>';
						$headers[] = 'Cc: sujay@brainstormforce.com';
						$headers[] = 'Cc: pratikc@brainstormforce.com';
						$headers[] = 'Cc: amits@brainstormforce.com';
						$message = '<p>You have been granted access to '. get_site_url() .'</p> ' . "\r\n";
						$message .= '<p>Click on the following URL to access the site admin - </p>' . "\r\n";
						$message .= '<p><a href="'.$url.'">'.$url.'</a></p>';
						add_filter( 'wp_mail_content_type', array($this,'set_html_content_type') );
						wp_mail('nitiny@brainstormforce.com', $subject, $message, $headers);
						remove_filter( 'wp_mail_content_type', array($this,'set_html_content_type') );
					} else {
						echo "Something went wrong. Please try again!";
					}
				} else {
					$interval = time()-(10000);
					update_option('access_time',$interval);
					if(update_option('developer_access',$value)){
						echo "Access Revoked!";
						$subject = $current_user->user_login.' has revoked developer access.';
						$headers[] = 'From: '.$current_user->user_login.' <'.$email.'>';
						$headers[] = 'Cc: sujay@brainstormforce.com';
						$headers[] = 'Cc: pratikc@brainstormforce.com';
						$headers[] = 'Cc: amits@brainstormforce.com';
						$message = '<p>Developer access has been recoked for site - '. get_site_url() .'</p> ' . "\r\n";
						add_filter( 'wp_mail_content_type', array($this,'set_html_content_type') );
						wp_mail('nitiny@brainstormforce.com', $subject, $message, $headers);
						remove_filter( 'wp_mail_content_type', array($this,'set_html_content_type') );
					} else {
						echo "Something went wrong. Please try again!";
					}
				}
			}
			
			die();
		}
		function set_html_content_type() {
			return 'text/html';
		}
		function check_developer_access(){
			$interval = get_option('access_time');
			$now = time();
			if($interval <= $now){
				update_option('developer_access',false);
			}
		}
		
		function update_dev_notes(){
			$dev = isset($_POST['developer']) ? $_POST['developer'] : '';
			$notes = isset($_POST['note']) ? $_POST['note'] : '';
			$time = time();
			$records = get_option('developer_log');
			if($dev !== '' && $notes !== ''){
				$records[] = array(
						'dev' => $dev,
						'note' => $notes,
						'time' => $time
					);
				if(update_option('developer_log',$records)){
					echo "Note added!";
				} else {
					echo "Something went wrong!";
				}
			}
			die();
		}
		
	}
	new Ultimate_Admin_Area;
}
function check_license_activation($purchase_code){
	$path = base64_decode("aHR0cDovL3VsdGltYXRlLnNoYXJrc2xhYi5jb20vd3AtYWRtaW4vYWRtaW4tYWpheC5waHA=");
	$key = trim($purchase_code);
	if($key == ""){
		return 'not-activated';
	} else {
		$request = @wp_remote_post(
					$path, 
					array(
						'body' => array(
							'action' => 'activate_license',
							'process' => 'check_license',
							'purchase_code' => $purchase_code,
							'site_url' => get_site_url(),
							)
						)
					);
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
			return ($request['body']);
		}
	}
}
// Generate 32 characters 
function ult_generate_rand_id(){
	$validCharacters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$myKeeper = '';
	$length = 32;
	for ($n = 1; $n < $length; $n++) {
	    $whichCharacter = rand(0, strlen($validCharacters)-1);
	    $myKeeper .= $validCharacters{$whichCharacter};
	}
	return $myKeeper;
}