<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$scr = get_current_screen();
$view = $scr->id;
$is_admin = current_user_can( 'manage_categories' );

switch( $view ) {

case "dashboard" :
// ダッシュボード
?>
<div id="ug-dashboard" class="panel panel-primary">
	<div class="panel-heading"><?php echo $this->options["title"]; ?> へようこそ！</div>
	<div class="panel-body">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6" style="padding-bottom: 10px">
					<div class="checkbox">
						<label><input type="checkbox" id="ug-chk-help" value="on"<?php if($this->uv['help'] == 'on') echo ' checked="checked"'; ?> onchange="help_display_change();"> 項目ごとにヘルプを表示</label>
					</div>
					<a href="<?php echo admin_url('post-new.php'); ?>" class="btn btn-primary btn-block">記事を投稿する</a>
					<a href="<?php echo admin_url('edit.php'); ?>" class="btn btn-default btn-block">記事一覧</a>
				</div><!-- /.col-sm-6 -->
				<div class="col-sm-6" style="padding-bottom: 10px">
					<div class="panel panel-info">
						<div class="panel-heading">ヘルプ</div>
						<table class="table table-hover table-condensed"><tbody id="dashboard-help-index">
							<tr><td onclick="show_dashboard_help('db-post-edit');">記事の作成</td></tr>
							<?php if($is_admin) : ?>
							<tr><td onclick="show_dashboard_help('db-page-edit');">固定ページの作成</td></tr>
							<tr><td onclick="show_dashboard_help('db-category-edit');">カテゴリーの作成</td></tr>
							<?php endif; ?>
						</tbody></table>
					</div><!-- /.panel -->
				</div><!-- /.col-sm-6 -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<div class="panel-footer clearfix">
		<div class="pull-left">
			<div class="checkbox">
				<label><input type="checkbox" id="ug-chk-dashboard" value="off"<?php if($this->uv['dashboard'] == 'off') echo ' checked="checked"'; ?> onchange="dashboard_chk_change();"> 次からこの画面を表示させない</label>
			</div>
			<small id="setting-comment" class="text-warning" style="display: none">* [設定] → [ユーザーマニュアル]からも変更できます</small>
		</div>
		<div class="pull-right">
			<button type="button" class="btn btn-primary" onclick="dashboard_close();">閉じる</button>
		</div>
	</div>
</div>
<?php if( $this->uv["dashboard"] == "on" ) : ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	var h = jQuery("#ug-dashboard").height();
	jQuery("#ug-dashboard").show().css({top: "0", bottom: "0", height: h+"px"});
	jQuery("#ug-bg").show();
	
	jQuery("#help-dialog .panel-heading button").hide();
	jQuery("#help-select").hide();
	jQuery("#help-dialog .panel-footer button").removeAttr('onclick')
	.on('click', function() {
		jQuery("#help-dialog").hide();
	});
});

function show_dashboard_help(code) {
	if(code == undefined) return false;
	
	UserGuide.help(code)
	.done(function(data) {
		if('error' in data && data.error.length > 0) {
			message('<div class="alert alert-danger">' + data.error + '</div>', 'ヘルプ取得エラー');
			jQuery("#dialog").parent().css("z-index", "10004");
			return false;
		}
		if(data.title === undefined) {
			message('<div class="alert alert-danger">' + data + '</div>', 'ヘルプ取得エラー');
			jQuery("#dialog").parent().css("z-index", "10004");
		}
		jQuery("#help-index").hide();
		jQuery("#help-title").html(data.title);
		var htm = create_help_format(data.html);
		jQuery("#help-dialog .panel-body").empty().html(htm).show();
		jQuery("#help-dialog").show();
		var h = jQuery("#help-dialog").outerHeight() - jQuery("#help-dialog .panel-heading").outerHeight() - jQuery("#help-dialog .panel-footer").outerHeight();
		jQuery("#help-dialog .panel-body, #help-dialog #help-index").outerHeight(h);
		UserGuide.dialog_adjust();
		UserGuide.img_zoom();
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		message('<div class="alert alert-danger">' + jqXHR.responseText + '</div>', textStatus);
		jQuery("#dialog").parent().css("z-index", "10004");
	})
	.always(function() {
	});
}
</script>
<?php endif; ?>
<?php
break; // dashboard-end

case "post" :
// 記事編集画面
?>

<script type="text/javascript">
<?php if( $this->uv["help"] == "on" ) : ?>
var hlp = true;
<?php else : ?>
var hlp = false;
<?php endif; ?>
jQuery(document).ready(function(){

	if(hlp) post_help_init();
	
	<?php if( $this->uv["category"] == "on" ) : ?>
	// submit前にカテゴリーが選択されているか、確認を行う
	jQuery("#post").submit(function() {
		var cnt = jQuery('[name="post_category[]"]:checked').length;
		if(cnt === 0) {
			var ret = confirm("カテゴリーが一つも選択されていません。そのまま更新しますか？");
			if(ret === false) return false;
		}
	});
	<?php endif; ?>

});
</script>

<?php
break; // post-end

case "page" :
// ページ編集画面
?>

<script type="text/javascript">
<?php if( $this->uv["help"] == "on" ) : ?>
var hlp = true;
<?php else : ?>
var hlp = false;
<?php endif; ?>
jQuery(document).ready(function(){
	if(hlp) page_help_init();
});
</script>

<?php
break; // post-end
}
?>
<div id="help-dialog" class="panel panel-primary">
	<div class="panel-heading clearfix">
		<div id="help-title" class="pull-left"></div>
		<button type="button" class="btn btn-default btn-xs pull-right" onclick="help_index();"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> インデックス</button>
	</div>
	<table id="help-index" class="table table-bordered table-hover"><tbody>
	</tbody></table>
	<div class="panel-body"></div>
	<div class="panel-footer cleafix">
		<select id="help-select" class="form-control input-sm pull-left" onchange="show_help(this.value);"></select>
		<button type="button" class="btn btn-default pull-right" onclick="help_close();">閉じる</button>
	</div>
</div>
<div id="dialog"><article></article></div>
<div id="ug-bg"></div>
<div id="ug-close" onclick="tutorial_end();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> チュートリアルを終了</div>
<script type="text/javascript">
var ajax = "<?php echo wp_nonce_url( bloginfo( 'wpurl' ) . '/wp-admin/admin-ajax.php', 'isp_users_guide' ); ?>";
var uid = <?php echo $this->uv['id']; ?>;
</script>
