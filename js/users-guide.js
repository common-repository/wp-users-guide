// ヘルプ取得用の関数
var UserGuide = {
	help: function(code) {
		// Ajax
		var defer = jQuery.Deferred();
		jQuery.ajax({
			url: ajax,
			data: {
				action: 'isp_users_guide',
				ug_action: 'get-help',
				code: code
			},
			dataType: 'json',
			type: 'POST',
			success: defer.resolve,
			error: defer.reject
		});
		return defer.promise();
	},
	dialog_adjust: function() {
		// ダイアログの位置調整
		var wh = jQuery(window).height();
		var h = jQuery("#help-dialog").height();
		var st = jQuery(window).scrollTop();
		if(h > wh) {
			h = (wh > 320) ? wh - 20 : 300;
			jQuery("#help-dialog").css("height", h + "px");
		}
		var diff = wh - h;
		var t = (diff > 0) ? diff / 2 : 10;
		t += st;
		jQuery("#help-dialog").css("top", t + "px");
	},
	img_zoom: function() {
		// サイズのトリミング処理
		var mw = 150;
		var mh = 150;
		jQuery("#help-dialog .sample").each(function() {
			var view = jQuery("img", this);
			var img = new Image();
			img.onload = function() {
				var w = img.width;
				var h = img.height;
				if(w > mw || h > mh) {
					if((w - mw) > (h - mh)) {
						w = Math.round(w * mh / h);
						var l = (mw - w) / 2;
						view.attr({
							width: w,
							height: mh
						})
						.css("left", l + "px");
					} else {
						h = Math.round(h * mw / w);
						var t = (mh - h) / 2;
						view.attr({
							width: mw,
							height: h
						})
						.css("top", t + "px");
					}
				}
			}
			img.src = jQuery("img", this).attr("src");
		});
		
		// 画像ズーム処理
		jQuery("#help-dialog img").zoom1().click(function() {
			var $z1 = jQuery(this);
			var $z2 = $z1.zoom2();
			
			// ズーム画像 サイズ調整
			var w = $z2.width();
			var h = $z2.height()
			var sw = jQuery(window).width();
			var sh = jQuery(window).height();
			if((sw - w) < 0 || (sh - h) < 0) {
				if((sw - w) >= (sh - h)) {
					h = Math.round(h * (sw - 20) / w);
					w = sw - 20;
				} else {
					w = Math.round(w * (sh - 20) / h);
					h = sh - 20;
				}
				$z2.css({width: w+"px", height: h+"px"});
			}
			
			// ズーム画像 位置調整
			// （基本）元画像の中央に配置
			var l = $z1.position().left + ($z1.width() - w) / 2;
			var t = $z1.position().top + ($z1.height() - h) / 2;
			// 画面からはみ出す場合は調整
			// 左
			var offsetLeft = $z1.offset().left + ($z1.width() - w) / 2;
			if(offsetLeft < 0) l -= offsetLeft - 10;
			// 右
			var offsetRight = sw - ($z1.offset().left - $z1.position().left + l + w);
			if(offsetRight < 0) l += offsetRight - 10;
			// 上
			var offsetTop = $z1.offset().top + ($z1.height() - h) / 2;
			if(offsetTop < 0) t -= offsetTop - 10;
			// 下
			var offsetBottom = sh - ($z1.offset().top - $z1.position().top + t + h);
			if(offsetBottom < 0) t += offsetBottom - 10;
			
			$z2.css({left: l+"px", top: t+"px"});
			
			$z2.fadeIn().click(function() {
				jQuery(this).hide();
				return false;
			});
			return false;
		});
	}
};
var help_list; // 表示ページのヘルプリスト

jQuery(document).ready(function(){
	jQuery("#dialog").dialog({
		width: 500,
		autoOpen: false,
		draggable: false,
		resizable: false,
		modal: true
	});
});

// Windowのスクロール時
jQuery(window).scroll(function() {
	if(jQuery("#help-dialog").isVisible()) {
		UserGuide.dialog_adjust();
	}
});

// ヘルプ表示・非表示チェック
function help_display_change() {
	var hlp = (jQuery("#ug-chk-help").prop("checked")) ? "on" : "off";
	jQuery.getJSON(
		ajax, {
			action: 'isp_users_guide',
			ug_action: 'show-help',
			id: uid,
			help: hlp
		}
	)
	.done(function(data) {
		if(data.error !== undefined && data.error.length > 0) {
			message('<div class="alert alert-danger">' + data.error + '</div>', '更新エラー');
			jQuery("#dialog").parent().css("z-index", "10004");
		}
		if(data.id === undefined) {
			message('<div class="alert alert-danger">' + data + '</div>', '更新エラー');
			jQuery("#dialog").parent().css("z-index", "10004");
		}
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		message('<div class="alert alert-danger">' + jqXHR.responseText + '</div>', textStatus);
		jQuery("#dialog").parent().css("z-index", "10004");
	})
	.always(function() {
	});
}

// ダッシュボードの「ようこそ画面」表示・非表示チェック
function dashboard_chk_change() {
	var chk = (jQuery("#ug-chk-dashboard").prop("checked")) ? "off" : "on";
	if(chk === "off") {
		jQuery("#setting-comment").show();
	} else {
		jQuery("#setting-comment").hide();
	}
	
	jQuery.getJSON(
		ajax, {
			action: 'isp_users_guide',
			ug_action: 'dashboard',
			id: uid,
			dashboard: chk
		}
	)
	.done(function(data) {
		if(data.error !== undefined && data.error.length > 0) {
			message('<div class="alert alert-danger">' + data.error + '</div>', '更新エラー');
			jQuery("#dialog").parent().css("z-index", "10004");
		}
		if(data.id === undefined) {
			message('<div class="alert alert-danger">' + data + '</div>', '更新エラー');
			jQuery("#dialog").parent().css("z-index", "10004");
		}
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		message('<div class="alert alert-danger">' + jqXHR.responseText + '</div>', textStatus);
		jQuery("#dialog").parent().css("z-index", "10004");
	})
	.always(function() {
	});
}

// ダッシュボード閉じる
function dashboard_close() {
	jQuery("#ug-dashboard, #ug-bg").hide();
}

// ヘルプダイアログ閉じる
function help_close() {
	jQuery("#help-dialog, #ug-bg").hide();
}

// ヘルプ準備
function help_init() {
	jQuery.each(help_list, function() {
		jQuery(this.target).attr("title", this.tooltip);
		if(this.sign.length > 0 && this.ajax.length > 0) {
			var htm = '<span class="ug-help-sign glyphicon glyphicon-question-sign alert-info" title="' + this.signTooltip + '" onclick="ug_help(\'' + this.signTooltip + '\', \'' + this.ajax + '\', event);"></span>';
			jQuery(this.sign).after(htm);
		}
	});
	jQuery(document).tooltip({
		position: { my: 'right bottom', at: 'right+10 top-10' },
		tooltipClass: "top"
	});
	if(help_list.length > 0) {
		jQuery(help_list[0].target).focus();
	}
}

// 詳細なヘルプの取得と表示
function ug_help(title, code, e) {
	if(code == undefined) return false;
	
	e.stopPropagation(); // 親要素へのイベントバブリングを止める
	UserGuide.help(code)
	.done(function(data) {
		if('error' in data && data.error.length > 0) {
			message('<div class="alert alert-danger">' + data.error + '</div>', 'ヘルプ取得エラー');
			return false;
		}
		var htm = '';
		var idx = '';
		var select = '';
		var i = 1;
		var max = data.length;
		var mv = ''; // footer ヘルプのリンク
		if(data.length > 1) {
			// ヘルプ項目が複数ある場合
			jQuery.each(data, function() {
				var icon = '';
				if(this.icon.length > 0) {
					icon = '<span class="glyphicon glyphicon-' + this.icon + '" aria-hidden="true"></span> ';
				}
				idx += '<tr onclick="show_help(' + i + ');"><td>' + icon + this.title + '</td></tr>';
				select += '<option value="' + i + '">' + this.title + '</option>';
				if(i > 1) {
					mv = '<hr><div class="clearfix">'
						+ '<p class="pull-left"><span class="glyphicon glyphicon-triangle-left" aria-hidden="true"></span> <a href="javascript: void(0);" onclick="show_help(' + (i-1) + ');">' + data[(i-2)].title + '</a></p>';
					if(max > i) {
						mv += '<p class="pull-right"><a href="javascript: void(0);" onclick="show_help(' + (i+1) + ');">' + data[i].title + ' <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></a></p>';
					}
					mv += '</div>';
				} else if(max > i) {
					mv = '<hr><div class="clearfix">'
						+ '<p class="pull-right"><a href="javascript: void(0);" onclick="show_help(' + (i+1) + ');">' + data[i].title + ' <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></a></p>'
						+ '</div>';
				}
				htm += '<div id="help' + i + '" class="help-content" style="display: none">' + create_help_format(this.html) + mv + '</div>';
				i++;
			});
			jQuery("#help-index tbody").empty().html(idx).show();
			jQuery("#help-select").empty().html(select).show();
			jQuery("#help-dialog .panel-body").empty().html(htm);
			jQuery("#help-title").empty().html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ' + title);
			jQuery("#help-dialog .panel-heading button").show();
			help_index();
		} else {
			// ヘルプ項目が一つの場合
			var hp = data[0];
			jQuery("#help-title").empty().html('<span class="glyphicon glyphicon-' + hp.icon + '" aria-hidden="true"></span> ' + hp.title);
			jQuery("#help-index tbody").empty().hide();
			jQuery("#help-dialog .panel-body").empty().html(create_help_format(hp.html)).show();
			jQuery("#help-select").empty().hide();
			jQuery("#help-dialog .panel-heading button").hide();
		}
		
		jQuery("#ug-bg").show()
		.click(function() {
			help_close()
		});
		jQuery("#help-dialog").show();
		var h = jQuery("#help-dialog").outerHeight() - jQuery("#help-dialog .panel-heading").outerHeight() - jQuery("#help-dialog .panel-footer").outerHeight();
		jQuery("#help-dialog .panel-body").outerHeight(h);
		UserGuide.dialog_adjust();
		UserGuide.img_zoom();
	})
	.fail(function(jqXHR, textStatus, errorThrown) {
		message('<div class="alert alert-danger">' + jqXHR.responseText + '</div>', textStatus);
	})
	.always(function() {
	});
}

// リクエストされたヘルプの表示
function show_help(idx) {
	if(idx == undefined || isNaN(idx) || jQuery("#help" + idx).length == 0) return false;
	
	jQuery("#help-index").hide();
	jQuery("#help-dialog .panel-body").show();
	jQuery("#help-select").val(idx);
	jQuery(".help-content").hide();
	jQuery("#help" + idx).show();
	jQuery("#help-dialog .panel-body").scrollTop(0);
}

// ヘルプダイアログのインデックスに戻る
function help_index() {
	jQuery("#help-dialog .panel-body").hide();
	jQuery("#help-index").show();
}

// 記事投稿 ヘルプ
function post_help_init() {
	help_list = [
		{
			target: '#title',
			tooltip: '記事のタイトルを入力します',
			sign: '',
			signTooltip: '',
			ajax: '',
		},
		{
			target: '#insert-media-button',
			tooltip: '画像やファイルをアップロードします',
			sign: '#insert-media-button',
			signTooltip: '編集ガイド',
			ajax: 'post-edit',
		},
		{
			target: '.wp-editor-area',
			tooltip: '自分でタグを入れながら記事を書くモードです',
			sign: '',
			signTooltip: '',
			ajax: '',
		},
		{
			target: '#submitdiv h2',
			tooltip: '投稿の保存、公開状況を設定します',
			sign: '#submitdiv h2 span',
			signTooltip: '保存状態について',
			ajax: 'save',
		},
		{
			target: '#categorydiv h2',
			tooltip: '投稿記事に合致するカテゴリーを選択します',
			sign: '#categorydiv h2 span',
			signTooltip: 'カテゴリーについて',
			ajax: 'post-category',
		},
		{
			target: '#tagsdiv-post_tag h2',
			tooltip: '投稿記事をイメージする単語を登録します',
			sign: '#tagsdiv-post_tag h2 span',
			signTooltip: 'タグについて',
			ajax: 'post-tag',
		},
		{
			target: '#postimagediv h2',
			tooltip: '投稿記事のサムネイル画像を設定します',
			sign: '#postimagediv h2 span',
			signTooltip: 'アイキャッチ画像について',
			ajax: 'eye-catch',
		},
		{
			target: '#commentsdiv h2',
			tooltip: '投稿に寄せられたコメントです',
			sign: '#commentsdiv h2 span',
			signTooltip: 'コメントについて',
			ajax: 'comment',
		},
		{
			target: '#postcustom h2',
			tooltip: '予め統一されたデータを投稿するのに使用します',
			sign: '#postcustom h2 span',
			signTooltip: 'メタデータについて',
			ajax: 'postcustom',
		}
	];
	help_init();
}

// ページ作成 ヘルプ
function page_help_init() {
	help_list = [
		{
			target: '#title',
			tooltip: 'ページのタイトルを入力します',
			sign: '',
			signTooltip: '',
			ajax: '',
		},
		{
			target: '#insert-media-button',
			tooltip: '画像やファイルをアップロードします',
			sign: '#insert-media-button',
			signTooltip: '編集ガイド',
			ajax: 'page-edit',
		},
		{
			target: '.wp-editor-area',
			tooltip: '自分でタグを入れながら記事を書くモードです',
			sign: '',
			signTooltip: '',
			ajax: '',
		}
	];
	help_list = [];
	help_init();
}

// ヘルプ詳細の元データを表示用にフォーマットして返す
// h3タグをヘルプ内インデックスに活用
// h3タグにアイコンを追加
// h4タグにアイコンを追加
function create_help_format(data) {
	if(data == undefined || data.length == 0) return "";
	
	data = data.replace(/(【.+?】)/g, '<span class="menu">$1</span>');
	data = data.replace(/<h3>(.+?)<\/h3>/g, '<h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>$1</h3>');
	data = data.replace(/<h4>(.+?)<\/h4>/g, '<h4><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>$1</h4>');
	return data;
}

// 設定画面 メッセージ変更
function message_change() {
	if(jQuery("#msg").val().length > 0) {
		jQuery("#send-message").hide();
		jQuery("#msg").parent().removeClass("has-error");
	} else {
		jQuery("#msg").parent().addClass("has-error");
	}
}

// 設定画面のメッセージ送信
function message_send() {
	if(jQuery("#msg").val().length == 0) {
		jQuery("#send-message").html('<span class="text-danger">入力されていない項目があります！</span>').show();
		jQuery("#msg").parent().addClass("has-error");
		return false;
	}
	
	var msg = jQuery("#msg").val();
	jQuery("#dialog").dialog("option", "title", 'メッセージ送信の確認');
	jQuery("#dialog article").html('<p>下記内容でプラグイン作者にメッセージを送ります。<br>採用させていただいたご意見はアップロード時に反映されます。</p><p class="well">' + msg.replace(/[\n\r]/g, "<br>") + '</p>');
	jQuery("#dialog").dialog("option", "buttons",
		[
			{
				text: "送信",
				click: function() {
					jQuery("#send-btn").prop("disabled", true);
					jQuery("#send-message").html('<span class="text-info">送信中です…</span>').show();
					jQuery(this).dialog("close");
					jQuery.ajax({
						url: ajax,
						data: {
							action: 'isp_users_guide',
							ug_action: 'send-message',
							mail: jQuery("#mail").val(),
							msg: msg
						},
						dataType: 'json',
						type: 'POST',
						success: function(data) {
							if(data.error !== undefined && data.error.length > 0) {
								jQuery("#send-message").html('<span class="text-danger">' + data.error + '</span>');
							} else {
								jQuery("#send-message").html('<span class="text-success">' + data.message + '</span>');
							}
						},
						error: function() {
							message("メッセージの送信に失敗しました。<br>お手数ですが、時間をおいて再度送信してみてください。", "送信エラー");
						},
						complete: function() {
							jQuery("#send-btn").prop("disabled", false);
						}
					});
				}
			},
			{
				text: "キャンセル",
				click: function() {
					jQuery(this).dialog("close");
				}
			}
		]
	);
	jQuery("#dialog").dialog("open");
}

function message(msg, title) {
	if(msg == undefined || msg.length == 0) return false;
	title = (title == undefined) ? 'お知らせ' : title;

	jQuery("#dialog article").html(msg);
	jQuery("#dialog").dialog("option", "title", title);
	jQuery("#dialog").dialog("option", "buttons",
		[
			{
				text: "ＯＫ",
				icons: {
					primary: "ui-icon-check",
				},
				click: function() {
					jQuery(this).dialog("close");
				}
			}
		]
	);
	jQuery("#dialog").dialog("open");
}

jQuery.fn.isVisible = function() {
	return jQuery.expr.filters.visible(this[0]);
};

/******************************
 Enter Event Plugin
 http://garafu.blogspot.jp/2015/09/jquery-complete.html
******************************/
(function (window, document, $, undefined) {
		/**
		* テキスト入力が確定したとき指定されたイベントハンドラを呼び出します。
		* @param    handler     {function}  イベントハンドラ。イベントハンドラは jQuery.Event を引数にとる。
		* @return   {jQuery}    jQueryオブジェクト
		*/
		$.fn.complete = function (handler) {
				var ENTER_KEY = 13;
				var keypressed = false;

				/**
				* keypressイベント発生時に呼び出されます。
				* @param    event   {jQuery.Event}  イベントオブジェクト
				*/
				var onkeypress = function (event) {
						if (event.keyCode !== ENTER_KEY) {
								return;
						}
						keypressed = true;
						return false; // submit対策
				};

				/**
				* keyupイベント発生時に呼び出されます。
				* @param    event   {jQuery.Event}  イベントオブジェクト
				*/
				var onkeyup = function (event) {
						if (event.keyCode === ENTER_KEY && keypressed) {
								// 入力確定のイベントを発生させます。
								handler.call(this, event);
						}
						keypressed = false;
				};

				// 各要素に対してイベントを付与します。
				return this.each(function (index) {
						$(this).on('keypress', onkeypress).on('keyup', onkeyup);
				});
		};
})(window, document, jQuery);
