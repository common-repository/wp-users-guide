<?php
/*
Plugin Name: WordPressユーザーマニュアル
Plugin URI: http://www.is-p.cc/wordpress/plug-in/user-guide/1115
Description: 初心者用にWordPressの使用方法をヘルプ表示するプラグイン
Version: 1.01
Author: ＩＳプランニング
Author URI: http://www.is-p.cc
License: GPL2

Copyright 2016 is planning (email : admin@is-p.cc)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) ) exit;
$isp_sm = new ISP_UsersGuide();
$isp_ug_opt_name = 'user_guide_option'; // WPへのオプション値 登録名

class ISP_UsersGuide {
	public $options;                        // 取得したオプション値
	private $uv;                             // 現ユーザーの設定値
	private $opt_def = array(
		"version" => "1.02",
		"title" => "WordPress 管理画面",
		"users" => array()
	);
	private $user_def = array(
		"id" => 0,
		"dashboard" => 'on',
		"help" => 'on',
		"category" => 'on'
	);
	
	public function __construct() {
		// プラグイン有効化
		if( function_exists( 'register_activation_hook' ) ) {
			register_activation_hook( __FILE__, array( &$this, 'activationHook' ) );
		}
		// プラグイン削除
		if( function_exists('register_uninstall_hook') ) {
			register_uninstall_hook( __FILE__, array( 'ISP_UserGuide', 'uninstallHook' ) );
		}
		
		// 初期化
		add_action( 'init', array( &$this, 'ug_init' ) );
		
		// JS,CSSファイル読込
		add_action( 'admin_head', array( &$this, 'include_js_css' ) );
		
		// 設定ページ
		add_action( 'admin_menu', array( &$this, 'ug_setting_menu' ) );
		
		// ユーザーマニュアルに必要なUIを配置
		add_action( 'admin_footer', array( &$this, 'ug_footer_ui' ) );
		
		// Ajax
		add_action( 'wp_ajax_isp_users_guide', array( &$this, 'ug_ajax' ) );
	}
	
	// プラグイン有効化
	public function activationHook() {
		$this->call_options();
	}
	
	// プラグイン削除
	public function uninstallHook() {
		global $isp_ug_opt_name;
		delete_option( $isp_ug_opt_name );
	}
	
	//
	// オプション値の読込
	//
	public function call_options() {
		global $isp_ug_opt_name;
		$this->options = get_option( $isp_ug_opt_name );
		if( !$this->options ) {
			// 設定情報が無い場合は新規作成
			$val = $this->opt_def;
			$users = get_users( array( 'who' => 'authors' ) );
			foreach( $users as $user ) {
				$def = $this->user_def;
				$def["id"] = $user->ID;
				$val["users"][] = $def;
			}
			add_option( $isp_ug_opt_name, $val );
		} else if( $this->options["version"] !== $this->opt_def["version"] ) {
			// バージョン違いの場合、既存のデータを流用しつつオプションデータを更新
			$up = $this->opt_def;
			foreach( $up as $key => $val ) {
				if( $key != 'users' && $key != 'version' && array_key_exists( $key, $this->options ) ) {
					$up[$key] = $this->options[$key];
				}
			}
			
			foreach( $this->options["users"] as $row ) {
				$user = $this->user_def;
				foreach( $user as $key => $val ) {
					if( array_key_exists( $key, $row ) ) {
						$user[$key] = $row[$key];
					}
				}
				$up["users"][] = $user;
			}
			update_option( $isp_ug_opt_name, $up );
		}
	}
	
	//
	// 初期化
	// オプション値の読込（バージョンチェック）
	// ユーザーデータの読込
	//
	public function ug_init() {
		require_once( dirname(__FILE__) . "/functions.php" );
		global $isp_ug_opt_name;
		$this->call_options();
		$uid = get_current_user_id();
		$this->uv = $this->user_def;
		
		if( $uid == 0 ) return false;
		
		if( isset( $this->options["users"] ) ) {
			foreach( $this->options["users"] as $row ) {
				if( $row["id"] == $uid ) {
					$this->uv = $row;
					break;
				}
			}
		}
		
		// ユーザー情報が無い場合は追加
		if( $this->uv["id"] == 0 ) {
			$this->uv["id"] = $uid;
			$this->options["users"][] = $this->uv;
			update_option( $isp_ug_opt_name, $this->options );
		}
	}
	
	//
	// 設定メニュー画面
	//
	public function ug_setting_menu() {
		add_options_page( 'ユーザーマニュアル', 'ユーザーマニュアル', 'edit_posts', 'user-guide-setting', array( &$this, 'ug_setting_page' ) );
	}
	public function ug_setting_page() {
		include_once( dirname( __FILE__ ) . "/ui-setting.php" );
	}
	
	//
	// JS,CSSの読込
	//
	public function include_js_css() {
		// jquery ui css -> bootstrap.css -> style.css (読込順)
		global $wp_scripts;
		$ui = $wp_scripts->query( 'jquery-ui-core' );
		
		wp_enqueue_style(
			'jquery-ui-smoothness',
			plugins_url( 'css/jquery-ui.min.css', __FILE__ ),
			false,
			null
		);
		
		wp_register_style( 'bootstrap', plugins_url( 'bootstrap/css/bootstrap.min.css', __FILE__ ) );
		wp_register_style( 'users-guide-plugin-style', plugins_url( 'style.css', __FILE__ ), array( 'jquery-ui-smoothness', 'bootstrap' ) );
		wp_enqueue_style( 'users-guide-plugin-style' );
		
		// jquery ui js
		wp_enqueue_script(
			'users-guide-script',
			plugins_url( 'js/users-guide.js', __FILE__ ),
			array( 'jquery', 'jquery-ui-dialog', 'jquery-ui-tooltip' ),
			false,
			true
		);
		
		// zoomi
		wp_enqueue_script(
			'zoomi',
			plugins_url( 'js/zoomi.js', __FILE__ ),
			array( 'jquery' ),
			false,
			true
		);
	}
	
	//
	// ユーザーマニュアルの実行に必要なHTMLオブジェクトの配置
	//
	public function ug_footer_ui() {
		include_once( dirname( __FILE__ ) . "/ui-guide.php" );
	}
	
	//
	// Ajaxの実行
	//
	function ug_ajax() {
		include_once( dirname(__FILE__)."/ajax.php" );
		die();
	}
}
?>
