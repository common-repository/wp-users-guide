<?php
if ( ! defined( 'ABSPATH' ) ) exit;

// nonceの検証
$nonce = $_REQUEST['_wpnonce'];
if ( ! wp_verify_nonce( $nonce, 'isp_users_guide' ) ) {
	die( 'セキュリティーチェック エラー' );
}

global $isp_ug_opt_name;
$data = ( object )array( 'error' => '' );

if( isset( $_GET["ug_action"] ) ) :
//
// GETリクエスト
//
switch( $_GET["ug_action"] ) {
	case 'show-help' :
		// 項目ごとのヘルプ表示on/off
		$id = ( isset( $_GET["id"] ) ) ? numeric_white( $_GET["id"] ) : 0;
		$vw = ( isset( $_GET["help"] ) && $_GET["help"] == 'on' ) ? 'on' : 'off';
		if( $id > 0 ) {
			$options = get_option( $isp_ug_opt_name );
			if( $options ) {
				$up = false;
				$max = count( $options["users"] );
				for( $i = 0; $i < $max; $i++ ) {
					$row = $options["users"][$i];
					if( $row["id"] == $id ) {
						$options["users"][$i]["help"] = $vw;
						$up = true;
						break;
					}
				}
				
				if( $up ) {
					update_option( $isp_ug_opt_name, $options );
					$data = ( object )array( 'id' => $id );
				} else {
					$data->error = 'ユーザー情報が取得できませんでした。 ヘルプ表示の設定に失敗しました。';
				}
				
			} else {
				$data->error = '設定値が取得できませんでした。 ヘルプ表示の設定に失敗しました。';
			}
		} else {
			$data->error = 'ユーザーIDが取得できませんでした。 ヘルプ表示の設定に失敗しました。';
		}
		break;
	
	case 'dashboard' :
		$id = ( isset( $_GET["id"] ) ) ? numeric_white( $_GET["id"] ) : 0;
		$vw = ( isset( $_GET["dashboard"] ) && $_GET["dashboard"] == 'on' ) ? 'on' : 'off';
		if( $id > 0 ) {
			$options = get_option( $isp_ug_opt_name );
			if( $options ) {
				$up = false;
				$max = count( $options["users"] );
				for( $i = 0; $i < $max; $i++ ) {
					$row = $options["users"][$i];
					if( $row["id"] == $id ) {
						$options["users"][$i]["dashboard"] = $vw;
						$up = true;
						break;
					}
				}
				
				if( $up ) {
					update_option( $isp_ug_opt_name, $options );
					$data = ( object )array( 'id' => $id );
				} else {
					$data->error = 'ユーザー情報が取得できませんでした。 管理画面のポップ表示の設定に失敗しました。';
				}
				
			} else {
				$data->error = '設定値が取得できませんでした。 管理画面のポップ表示の設定に失敗しました。';
			}
		} else {
			$data->error = 'ユーザーIDが取得できませんでした。 管理画面のポップ表示の設定に失敗しました。';
		}
		break;

	default :
		$data->error = '処理項目が見つかりません';
		break;
}

elseif( isset( $_POST["ug_action"] ) ) :
//
// POSTリクエスト
//
switch( $_POST["ug_action"] ) {
	case 'send-message' :
		// ご意見・アドバイスのメール送信
		$data = ( object )array( 'message' => '', 'error' => '' );
		header('Content-Type: text/html; charset=UTF-8');
		header('Content_Language: ja');
		$to = 'akahoshi@is-p.cc';
		$subject = 'UserGuide Pluginユーザーからのご意見';
		$msg = ( isset( $_POST["msg"] ) ) ? trim( $_POST["msg"] ) : '';
		$from = ( isset( $_POST["mail"] ) ) ? trim( $_POST["mail"] ) : '';
		
		if( strlen( $msg ) > 0 ) {
			if( strlen( $from ) === 0 ) $from = 'admin@is-p.cc';
			mb_language( 'uni' );
			mb_internal_encoding( 'UTF-8' );
			if( mb_send_mail( $to, $subject, $msg, "From:" . $from ) ) {
				$data->message = 'メッセージが送信されました。';
			} else {
				$data->error = 'メールの送信にしっぱいしました。';
			}
		} else {
			$data->error = 'メッセージの取得に失敗しましたので送信されませんでした。';
		}
		break;
	
	case "get-help" :
		require_once( dirname( __FILE__ ) . "/help-list.php" );
		switch( $_POST["code"] ) :
			case "db-post-edit" :
				$data = ( object )array(
					'title' => '記事の作成',
					'html' => get_help_list( 'db-post-edit' )
				);
				break;

			case "db-page-edit" :
				$data = ( object )array(
					'title' => '固定ページの作成',
					'html' => get_help_list( 'db-page-edit' )
				);
				break;

			case "db-category-edit" :
				$data = ( object )array(
					'title' => 'カテゴリーの作成',
					'html' => get_help_list( 'db-category-edit' )
				);
				break;

			case "post-edit" :
				$data = array(
					( object )array(
						'title' => '投稿の大まかな流れ',
						'icon' => 'th-list',
						'html' => get_help_list( 'post-flow' )
					),
					( object )array(
						'title' => 'ビジュアルエディタ',
						'icon' => 'pencil',
						'html' => get_help_list( 'visual-editor' )
					),
					( object )array(
						'title' => 'テキストエディタ',
						'icon' => 'pencil',
						'html' => get_help_list( 'text-editor' )
					),
					( object )array(
						'title' => 'リンクの挿入',
						'icon' => 'link',
						'html' => get_help_list( 'link' )
					),
					( object )array(
						'title' => '画像の挿入',
						'icon' => 'picture',
						'html' => get_help_list( 'image' )
					),
					( object )array(
						'title' => 'ギャラリーの作成',
						'icon' => 'picture',
						'html' => get_help_list( 'gallery' )
					),
					( object )array(
						'title' => 'アイキャッチ画像の登録',
						'icon' => 'picture',
						'html' => get_help_list( 'eye-catch' )
					),
					( object )array(
						'title' => 'アップロード画像の編集',
						'icon' => 'edit',
						'html' => get_help_list( 'image-editor' )
					)
				);
				break;
			
			case "save" :
				$data = array(
					( object )array(
						'title' => '下書き',
						'icon' => 'save',
						'html' => get_help_list( 'draft' )
					),
					( object )array(
						'title' => '公開',
						'icon' => 'eye-open',
						'html' => get_help_list( 'publish' )
					),
					( object )array(
						'title' => '予約投稿',
						'icon' => 'calendar',
						'html' => get_help_list( 'future' )
					),
					( object )array(
						'title' => 'レビュー待ち',
						'icon' => 'inbox',
						'html' => get_help_list( 'pending' )
					),
					( object )array(
						'title' => 'パスワード保護',
						'icon' => 'lock',
						'html' => get_help_list( 'password' )
					),
					( object )array(
						'title' => '非公開',
						'icon' => 'eye-close',
						'html' => get_help_list( 'private' )
					)
				);
				break;
			
			case "post-category" :
				$data = array(
					( object )array(
						'title' => 'カテゴリーについて',
						'icon' => 'folder-open',
						'html' => get_help_list( 'db-category-edit' )
					)
				);
				break;
			
			case "post-tag" :
				$data = array(
					( object )array(
						'title' => 'タグについて',
						'icon' => 'tags',
						'html' => get_help_list( 'post-tag' )
					)
				);
				break;
			
			case "eye-catch" :
				$data = array(
					( object )array(
						'title' => 'アイキャッチ画像の登録',
						'icon' => 'picture',
						'html' => get_help_list( 'eye-catch' )
					)
				);
				break;
			
			case "comment" :
				$data = array(
					( object )array(
						'title' => 'コメントについて',
						'icon' => 'comment',
						'html' => get_help_list( 'comment' )
					)
				);
				break;
			
			case "postcustom" :
				$data = array(
					( object )array(
						'title' => 'カスタムフィールドについて',
						'icon' => 'comment',
						'html' => get_help_list( 'postcustom' )
					)
				);
				break;

			default :
				$data->error = 'ヘルプが取得できませんでした';
				break;

		endswitch;
		break;

	default :
		$data->error = '処理項目が見つかりません';
		break;
}

else :
	$data->error = '処理内容が取得できません';
endif;

if(is_object($data) || is_array($data)) {
	echo json_encode($data);
} else {
	echo $data;
}
?>
