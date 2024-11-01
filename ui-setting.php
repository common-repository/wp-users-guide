<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if( !is_array( $this->options ) ) exit();
$msg = "";
$alert = "";
global $isp_ug_opt_name;

if( isset( $_POST["action"] ) && $_POST["action"] == "option_update" ) {
	// nonceの検証
	$nonce = $_REQUEST['_wpnonce'];
	if ( wp_verify_nonce( $nonce, 'isp_users_guide' ) ) {
		$dashboard = ( isset( $_POST["chkDashboard"] ) && $_POST["chkDashboard"] == "on" ) ? "on" : "off";
		$help = ( isset( $_POST["chkHelp"] ) && $_POST["chkHelp"] == "on" ) ? "on" : "off";
		$cat = ( isset( $_POST["chkCategory"] ) && $_POST["chkCategory"] == "on" ) ? "on" : "off";
		$max = count( $this->options["users"] );
		for( $i = 0; $i < $max; $i++ ) {
			$row = $this->options["users"][$i];
			if( $row["id"] == $this->uv["id"] ) {
				$this->uv["dashboard"] = $dashboard;
				$this->uv["help"] = $help;
				$this->uv["category"] = $cat;
				$this->options["users"][$i] = $this->uv;
				break;
			}
		}
	} else {
		$msg = 'セキュリティーチェック エラー';
		$alert = 'alert-danger';
	}
	
	update_option( $isp_ug_opt_name, $this->options );
	if( strlen( $msg ) == 0 ) {
		$msg = '更新しました';
		$alert = 'alert-success';
	}
}
?>
<div class="clearfix">
	<h1 class="pull-left">ユーザーガイド 設定情報</h1>
	<?php if( strlen( $msg ) > 0 ) echo '<div class="pull-left alert ' . $alert . '" style="margin: 20px 0 0 10px; padding: 10px">' . $msg . '</div>'; ?>
</div>
<form id="sform" name="sform" method="post" enctype="multipart/form-data" action="<?php echo wp_nonce_url( esc_url( $_SERVER['REQUEST_URI'] ), 'isp_users_guide' ); ?>">
<input type="hidden" id="action" name="action" value="option_update">

<div class="clearfix">

<div class="pull-left" style="margin-right: 15px">
	<div class="panel panel-primary">
		<div class="panel-heading"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> ユーザーガイド設定</div>
		<div class="panel-body">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="chkDashboard" value="on"<?php if( $this->uv["dashboard"] == "on" ) echo ' checked="checked"'; ?>> ダッシュボード ポップアップ
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="chkHelp" value="on"<?php if( $this->uv["help"] == "on" ) echo ' checked="checked"'; ?>> ヘルプ表示
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="chkCategory" value="on"<?php if( $this->uv["category"] == "on" ) echo ' checked="checked"'; ?>> カテゴリー選択確認
				</label>
			</div>
		</div>
		<div class="panel-footer">
			<button type="button" class="btn btn-info btn-block" onclick="option_update()">更新</button>
		</div>
	</div>
</div>

<?php if( current_user_can( 'install_plugins' ) ) : ?>
<div class="pull-left">
	<div class="panel panel-default">
		<div class="panel-heading">開発支援の募集</div>
		<div class="panel-body"><a href="http://www.yggdore.com/tipcart/?mode=10&add=1&reccnt=1&price1=100&url1=http://www.is-p.cc/wordpress/plug-in/user-guide/1115" target="_blank"><img src="<?php echo plugins_url( 'images/support.png', __FILE__ ); ?>" title="ユグアド"></a></div>
	</div>
</div>
<?php endif; ?>
</div><!-- /.clearfix -->

<div class="panel panel-info" style="margin-top: 15px; max-width: 700px">
	<div class="panel-heading"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> アドバイスをお寄せください</div>
	<div class="panel-body">
		<p>当プラグインのご利用、ありがとうございます。</p>
		<p>
			当プラグインに書かれているヘルプの内容は開発者一人で書いておりますので、分かり難い点や見辛い箇所が多々あると思います。
			そういった指摘と（出来れば）改善提案をしていただくと、より分かり易いユーザーガイドになっていくと思いますので、もし気付いた点があれば下のフォームに入力して送信してください。
		</p>
		<hr>
		<div class="form-horizontal">
			<div class="form-group">
				<label for="mail" class="col-sm-3 control-label">メールアドレス<br><small class="text-warning">* 任意</small></label>
				<div class="col-sm-9">
					<input type="text" id="mail" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="msg" class="col-sm-3 control-label">ご意見・アドバイス<br><small class="text-danger">* 必須</small></label>
				<div class="col-sm-9">
					<textarea id="msg" class="form-control" rows="10" onchange="message_change();"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer clearfix">
		<div id="send-message" class="pull-left"></div>
		<button type="button" id="send-btn" class="btn btn-deafult pull-right" onclick="message_send();">送信</button>
	</div>
</div>
</form>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#txt-as-interval, #txt-rev-val").change(function() {
		jQuery(this).val(jQuery(this).val().replace(/\D/g, ""));
	});
});

function chk_revision_change() {
	if(jQuery("#chk-revision").prop("checked")) {
		jQuery("#txt-rev-val").prop("disabled", false);
	} else {
		jQuery("#txt-rev-val").prop("disabled", true);
	}
}
function chk_autosave_change() {
	if(jQuery("#chk-autosave").prop("checked")) {
		jQuery("#txt-as-interval").prop("disabled", false);
	} else {
		jQuery("#txt-as-interval").prop("disabled", true);
	}
}

function option_update() {
	jQuery("#sform").submit();
}
</script>
