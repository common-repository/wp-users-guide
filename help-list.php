<?php
/*
 ヘルプリスト
 【文字列】で囲んだものは<span class="menu">【文字列】</span>に置換して返す
 【 】 : メニューの表記名で使用
 	<h3> : h3タグはヘルプ内容のインデックスで利用（受取り側でアイコン追加）
*/
if ( ! defined( 'ABSPATH' ) ) exit;

function get_help_list( $code ) {
$img_dir = plugins_url( 'images/', __FILE__ );
$htm = '';
switch( $code ) {

case 'db-post-edit' :
// 記事の作成（ダッシュボード）
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>記事とは</span></h3>
		<p>いわゆるブログです。</p>
		<p>記事は時系列で管理され、閲覧した人がコメントを残したりする事が出来ます。<small class="text-danger">*1</small></p>
		<p class="text-danger"><small>*1 コメントを許可している環境に限ります。</small></p>
	</li>
	<li>
		<h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span>記事の新規作成</span></h3>
		<div class="sample"><img src="{$img_dir}post-edit001.png" title="新規作成"></div>
		<p>新しい記事を作成するには、以下の２通りがあります</p>
		<table><tbody><tr valign="top">
			<td style="width: 50%; padding-right: 5px">
				<ol>
					<li>ツールバーTOPより【＋新規】をクリック</li>
				</ol>
			</td>
			<td style="width: 50%; padding-left: 5px">
				<ol>
					<li>サイドメニューより【投稿】にマウスオーバー（もしくはクリック）</li>
					<li>【新規追加】をクリック</li>
				</ol>
			</td>
		</tr></tbody></table>
	</li>
	<li>
		<h3><span>既存記事の編集</span></h3>
		<div class="sample"><img src="{$img_dir}post-edit002.png" title="既存記事の編集"></div>
		<div class="sample"><img src="{$img_dir}post-edit003.png" title="投稿一覧"></div>
		<p class="float-cut-left">既存の記事を再編集する場合には以下の操作で行えます。</p>
		<ol>
			<li>サイドメニューの【投稿】にマウスオーバー（もしくはクリック）</li>
			<li>【投稿一覧】をクリック</li>
			<li>投稿一覧が表示されたら（上右画像）編集する記事の【タイトル】をクリックするか、タイトル下の【編集】をクリックします。</li>
		</ol>
		<p class="text-warning">* 投稿一覧画面の詳しい説明は投稿一覧に表示されるヘルプを確認します</p>
	</li>
	<li>
		<h3><span>記事の作成・編集</span></h3>
		<div class="sample"><img src="{$img_dir}post-edit004.png" title="記事編集"></div>
		<p>左画像を参考に【タイトル】、【本文】を入力後、【下書きとして保存】もしくは【公開】をクリックして保存します。</p>
		<p>既存記事の場合は【更新】をクリックして保存します。</p>
		<p class="text-warning">* 記事の編集についての詳しい説明は記事編集画面に表示されるヘルプを確認します</p>
	</li>
</ul>
EOD;
	break;

case 'db-page-edit' :
// 固定ページの作成（ダッシュボード）
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>固定ページとは</span></h3>
		<p>固定ページは記事と似ていますが、少し違います。</p>
		<p>記事は時系列で管理される「報告書」や「日記」のようなものですが、固定ページはホームページの中で独立したコンテンツとして表示され、「サイトの目的」や「連絡先」などのような、常に固定表示したいコンテンツを作成するのに適しています。</p>
	</li>
	<li>
		<h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><span>ページの新規作成</span></h3>
		<div class="sample"><img src="{$img_dir}page-edit001.png" title="ページの新規作成"></div>
		<p>ページを新規作成する場合はサイドメニューから操作します。</p>
		<table><tbody><tr><td>
			<ol>
				<li>【固定ページ】にマウスオーバー（もしくはクリック）</li>
				<li>【新規追加】をクリック</li>
			</ol>
		</td></tr></tbody></table>
	</li>
	<li>
		<h3><span>既存ページの編集</span></h3>
		<div class="sample"><img src="{$img_dir}page-edit002.png" title="既存ページの編集"></div>
		<div class="sample"><img src="{$img_dir}page-edit003.png" title="ページ一覧"></div>
		<p class="float-cut-left">既存のページを再編集する場合には以下の操作で行えます。</p>
		<ol>
			<li>サイドメニューの【固定ページ】にマウスオーバー（もしくはクリック）</li>
			<li>【固定ページ】一覧をクリック</li>
			<li>固定ページ一覧が表示されたら（上右画像）編集するページの【タイトル】をクリックするか、タイトル下の【編集】をクリックします。</li>
		</ol>
		<p class="text-warning">* 固定ページ一覧画面の詳しい説明は固定ページ一覧に表示されるヘルプを確認します</p>
	</li>
	<li>
		<h3><span>ページの作成・編集</span></h3>
		<div class="sample"><img src="{$img_dir}page-edit004.png" title="記事編集"></div>
		<p>左画像を参考に【タイトル】、【本文】を入力後、【下書きとして保存】もしくは【公開】をクリックして保存します。</p>
		<p>保存済みページの場合は【更新】をクリックして保存します。</p>
		<p class="text-warning">* ページの編集についての詳しい説明はページ編集画面に表示されるヘルプを確認します</p>
	</li>
</ul>
EOD;
	break;

case 'db-category-edit' :
// カテゴリーの作成（ダッシュボード）
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>カテゴリーとは</span></h3>
		<div class="sample"><img src="{$img_dir}category-edit001.png" title="カテゴリーの選択"></div>
		<p>カテゴリーはブログのテーマごとに分ける時に役立ちます。</p>
		<p>ブログではアーカイブ（履歴）をカテゴリー別にまとめて一覧を表示したりする事が多いので、記事の更新時にはテーマに沿ったカテゴリーを選択しておく事（左画像）が重要です。</p>
	</li>
	<li>
		<h3><span>カテゴリーの新規追加</span></h3>
		<p class="text-danger">* カテゴリーの作成、編集、削除には「管理者」や「編集者」といった権限が必要です。</p>
		<p>カテゴリーを追加する場合は、「カテゴリーの編集ページから追加」する方法と「記事編集ページから追加」する方法があります。</p>
		<h4>カテゴリー編集ページから追加</h4>
		<div class="sample"><img src="{$img_dir}category-edit002.png" title="カテゴリーの編集ページ"></div>
		<div class="sample"><img src="{$img_dir}category-edit003.png" title="カテゴリーの追加"></div>
		<table><tbody><tr><td>
			<ol>
				<li>【投稿】にマウスオーバー（もしくはクリック）</li>
				<li>【カテゴリー】をクリック（左画像）</li>
				<li>【カテゴリー名】を入力（右画像）</li>
				<li>【スラッグ】を入力（任意）</li>
				<li>【親カテゴリー】を選択（任意）</li>
				<li>【説明】を入力（任意）<small class="text-danger">*1</small>
			</ol>
		</td></tr></tbody></table>
		<p><small class="text-danger">*1 WordPressテーマの中には「説明」を表示する場合もあります</small></p>
		<h4>記事編集ページから追加</h4>
		<div class="sample"><img src="{$img_dir}category-edit004.png" title="記事作成からのカテゴリー追加"></div>
		<div class="sample"><img src="{$img_dir}category-edit005.png" title="カテゴリーの追加"></div>
		<table><tbody><tr><td>
			<ol>
				<li>カテゴリー欄の下にある【+ 新規カテゴリーを追加】をクリック（左画像）</li>
				<li>【カテゴリー名】を入力（右画像）</li>
				<li>【親カテゴリー】を選択（任意）</li>
				<li>【新規カテゴリーを追加】をクリックして追加します</small>
			</ol>
		</td></tr></tbody></table>
	</li>
	<li>
		<h3><span>カテゴリーの編集</span></h3>
		<p class="text-danger">* カテゴリーの作成、編集、削除には「管理者」や「編集者」といった権限が必要です。</p>
		<div class="sample"><img src="{$img_dir}category-edit002.png" title="カテゴリーの編集ページ"></div>
		<p>【投稿】にマウスオーバー（もしくはクリック）</p>
		<p>【カテゴリー】をクリック</p>
		<div class="sample float-cut-left"><img src="{$img_dir}category-edit006.png" title="カテゴリーの編集ページ"></div>
		<p>カテゴリーの一覧画面から編集するカテゴリーの【カテゴリー名】か【編集】をクリック</p>
		<p>編集画面が表示されるので「カテゴリー編集ページから追加」の項目を参考に入力します</p>
	</li>
	<li>
		<h3><span>カテゴリーの削除</span></h3>
		<p class="text-danger">* カテゴリーの作成、編集、削除には「管理者」や「編集者」といった権限が必要です。</p>
		<h4>個別に削除</h4>
		<div class="sample"><img src="{$img_dir}category-edit007.png" title="カテゴリー 個別に削除"></div>
		<p>該当するカテゴリーの削除をクリックします（左画像）</p>
		<h4 class="float-cut-left">一括で削除</h4>
		<div class="sample"><img src="{$img_dir}category-edit008.png" title="カテゴリー 一括で削除"></div>
		<p>削除するカテゴリー名の先頭にあるチェックボックスをクリックします</p>
		<p>リストヘッダにあるチェックボックスをクリックすると表示されているカテゴリーが全選択されます</p>
		<p>【一括操作】から【削除】を選択します</p>
		<p>【適用】で削除を実行</p>
	</li>
</ul>
EOD;
	break;

case 'post-flow' :
// 投稿の大まかな流れ
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<p>WordPressはブログを書くのに最適なツールの一つです。<br>
		FC2ブログやAmebaブログのような手軽さと比べると出来る機能が多過ぎて戸惑いがあるかもしれませんが、記事を投稿するだけなら簡単に出来てしまいます。</p>
		<p>以下はログインから新規投稿、公開までの一連の流れを時系列で記しています。</p>
		<hr>
		<ol>
			<li>ログイン画面で「ユーザー名」「パスワード」を入力して【ログイン】します</li>
			<li>「管理画面へようこそ」画面が出ている場合は【記事を投稿する】をクリック、それ以外はツールバーTOPにある【＋新規】をクリックします</li>
			<li><strong>「タイトル」を入力します</strong></li>
			<li><strong>「記事」を入力します</strong></li>
			<li>「カテゴリー」欄から記事に最も近い<strong>カテゴリーを選択</strong>します</li>
			<li>公開前にチェックをしたい場合は【プレビュー】で確認します</li>
			<li>【公開】をクリックして完了です</li>
		</ol>
		<hr>
		<p>
			最低限の投稿は以上です。<br>
			一度投稿した記事は【投稿】→【投稿一覧】から選択できます（「管理画面へようこそ」画面が表示されている場合は【記事一覧】をクリックします）
		</p>
	</li>
</ul>
EOD;
	break;

case 'visual-editor' :
// ビジュアルエディタ
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<div class="sample"><img src="{$img_dir}visual-editor001.png" title="ビジュアルエディタの選択"></div>
		<p>
			ビジュアルエディタはHTMLを知らなくても文字色を変更したり、文字サイズの変更等が簡単にできるエディタ機能です。通常はこの設定となっています。
		</p>
		<p>一般的な文書作成ソフトと違い、クセが多いのも事実ですので慣れが必要となります。HTMLを使える方は<a href="javascript: void(0)" onclick="show_help('3');">テキストエディタ</a>を利用すると、より細かく調整ができます。</p>
		<p>もっとも文章がメインであればビジュアルエディタで充分機能を果たせます。</p>
	</li>
	<li>
		<div class="sample"><img src="{$img_dir}visual-editor002.png" title="プラグインの導入"></div>
		<p>またビジュアルエディタの機能を強化するプラグイン（TinyMCE Advanced等）も充実していますので、管理者に相談してみても良いかもしれません。</p>
	</li>
	<li>
		<h3><span>改行について</span></h3>
		<p>改行は「Enter」キーで行いますが、以下の点に注意します。</p>
		<dl class="dl-horizontal">
			<dt>【Enter】</dt><dd>段落を意味します。必ず下の行との間に一行分の空白ができます。</dd>
			<dt>【Shift】 + 【Enter】</dt><dd>通常の改行です。行との間に空白はできません。</dd>
		</dl>
	</li>
	<li>
		<h3><span>基本的な使い方</span></h3>
		<p>
			ビジュアルエディタのアイコンにはそれぞれ機能（スタイル）があります（後述）。<br>
			それらを文字に適用するには様々な方法があります。
		</p>
		<div class="sample"><img src="{$img_dir}visual-editor003.png" title="アイコンの使用"></div>
		<p>アイコンをクリックして入力開始するとそのスタイルが適用されます。</p>
		<div class="float-cut"><label class="sr-only">スタイルの適用</label></div>
		<div class="sample"><img src="{$img_dir}visual-editor004.png" title="アイコンの使用"></div>
		<p>後から装飾する場合は、適用したい文字を範囲選択してアイコンをクリックします。</p>
		<div class="float-cut"><label class="sr-only">スタイルの解除</label></div>
		<div class="sample"><img src="{$img_dir}visual-editor005.png" title="スタイルの解除"></div>
		<p>逆に適用したスタイルを削除したい場合は、該当行をクリックして適用されているアイコンをクリックすると解除できます。</p>
	</li>
	<li>
		<h3><span>アイコン機能</span></h3>
		<p>ここではプラグインを採用していない通常のビジュアルエディタにあるアイコンの説明のみです</p>
		<table class="table table-bordered table-condensed"><tbody>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor006.png" title="bold"></td>
				<td>
					範囲選択された文字を太文字にします。<br>
					例） <strong>太文字</strong>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor007.png" title="italic"></td>
				<td>
					範囲選択された文字をイタリック体（斜め文字）にします。<br>
					例） <span style="font-style: italic; font-family:'Times New Roman'">イタリック体は適用されないフォントがあります</span>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor008.png" title="打ち消し線"></td>
				<td>
					範囲選択された文字に打ち消し線を入れます。<br>
					例） <del>打ち消し線で</del>訂正を表現できます。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor009.png" title="番号なしリスト"></td>
				<td>
					先頭に●が付いたリストを作成できます<br>
					例） <ul style="list-style-type: disc; padding-left: 40px"><li>WordPress</li><li>Joomla</li></ul>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor010.png" title="番号付きリスト"></td>
				<td>
					番号を振ったリストが作成できます。<br>
					例） <ol><li>WordPress</li><li>movable type</li></ol>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor011.png" title="引用符"></td>
				<td>
					選択された行、もしくは範囲選択された行を引用符で囲みます。囲まれた箇所は引用・転載である事を表します。<br>
					例） <blockquote>ここは引用文です</blockquote>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor012.png" title="横線"></td>
				<td>
					横線を入れます。<br>
					<hr>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor013.png" title="左寄せ"></td>
				<td>
					選択された行、もしくは範囲選択された行の文章を左寄せにします。<br>
					<p style="text-align: left">例） この文章は左寄せです</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor014.png" title="中央寄せ"></td>
				<td>
					選択された行、もしくは範囲選択された行の文章を中央寄せにします。<br>
					<p style="text-align: center">例） この文章は中央寄せです</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor015.png" title="右寄せ"></td>
				<td>
					選択された行、もしくは範囲選択された行の文章を右寄せにします。<br>
					<p style="text-align: right">例） この文章は右寄せです</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor016.png" title="リンクの挿入"></td>
				<td>
					範囲選択された文字にリンクを貼ります。<br>
					例） <a href="#">ホーム</a><br>
					<small class="text-warning">* リンクの詳しい説明は<a href="javascript: void(0)" onclick="show_help('4');">「リンクの挿入」</a>の項目を確認してください</small>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor017.png" title="リンクの削除"></td>
				<td>
					クリックされたリンク文字のリンクを削除します。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor018.png" title="続きを読む"></td>
				<td>
					「続きを読む（read more）タグ」を挿入します。<br>
					このタグ以降の文章は個別記事に移動する事によって全て表示される仕組みになります。このタグには自動で個別記事へのリンクが自動で貼られます。記事一覧の抜粋で使用されたりしますが、テーマによっては対応していないものもあります。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor019.png" title="ツールバー切り替え"></td>
				<td>
					これはエディタのツールバーの一部を表示・非表示にします。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor020.png" title="下線"></td>
				<td>
					選択された行、もしくは範囲選択された文章に下線を引きます。<br>
					例） <span style="text-decoration: underline;">選択された範囲</span>に下線を引きます
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor021.png" title="両端揃え"></td>
				<td>
					選択された行の文章を両端揃えにします。<br>
					<p style="text-align: justify; width: 150px">例）両端揃えをする際、全角や半角が混じっていると難しいみたいです。</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor022.png" title="文字色"></td>
				<td>
					範囲選択された文章を好みの色にできます。<br>
					例） <span style="color: #ff6600;">色を選択</span>できます。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor023.png" title="テキストペースト機能の切り替え"></td>
				<td>
					このアイコンのクリックすると、文章編集ソフト等の装飾されたテキストの装飾を排除して<strong>プレーンテキストとして記事内に貼り付け</strong>する事ができます。文章だけをペーストしたい時に利用します。<br>
					もう一度クリックすると解除されます。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor024.png" title="書式設定をクリア"></td>
				<td>
					範囲選択された文字、もしくは選択された行の文字に対して文字色や下線、太字等の装飾を解除します。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor025.png" title="特殊文字"></td>
				<td>
					カーソルの位置に特殊文字を挿入できます。<br>
					例） ∀?≪
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor026.png" title="インデントの削除"></td>
				<td>
					選択された段落のインデント（空白）を解除します。
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor027.png" title="インデントの追加"></td>
				<td>
					選択された段落の前にインデント（空白）を入れます。
					<p style="padding-left: 30px">例） インデントが入ります。</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor028.png" title="取り消し"></td>
				<td>直前の操作を取り消します。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor028.png" title="やり直し"></td>
				<td>取り消しをした操作をやり直します。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}visual-editor028.png" title="ヘルプ"></td>
				<td>キーボードショートカット操作のヘルプです</td>
			</tr>
		</tbody></table>
	</li>
</ul>
EOD;
	break;

case 'text-editor' :
// テキストエディタ
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<div class="sample"><img src="{$img_dir}text-editor001.png" title="テキストエディタの選択"></div>
		<p>テキストエディタはHTMLに若干の知識がある方向けのエディタです。</p>
		<p>ホームページはHTMLタグというもので構成されています。ビジュアルエディタではそのタグを自動で付加してくれますが、テキストエディタでは自分で追加していきます。</p>
		<p>ビジュアルエディタで思うように配置できない場合に、テキストエディタで作成すると上手くいく場合があります。</p>
		<p>しかし普通の記事を書く場合はビジュアルエディタで充分でしょう。<br>また、テキストエディタにも【b】や【code】等の標準的なタグを挿入できるアイコンが用意されています。</p>
	</li>
	<li>
		<h3><span>改行について</span></h3>
		<p>テキストエディタはビジュアルエディタとは違い、改行（Enterキー）をそのままの状態で出力します。</p>
		<p class="text-danger">ただし、<strong>行間が２つ以上空いてもページ上では一行しか空きません</strong>。意図的に行間の空白を空けたい場合はタグやスタイルシートを使用して調整する必要があります。</p>
		<p><small>* スタイルシートやタグの解説はここでは行いません。興味のある方は色々な解説サイトで勉強してください。</small></p>
	</li>
	<li>
		<h3><span>基本的な使い方</span></h3>
		<p>適切なタグと文章を入力します。<br></p>
		<p>また、テキストエディタにも基本的なタグが挿入できるアイコンが用意されています。それらを利用すればタグを記入する手間が省けます。<span class="text-danger">タグ挿入後、必ず【タグを閉じる】をクリックしてタグを閉じないとレイアウトが悲惨な事になりますのでご注意ください。</span></p>
	</li>
</ul>
EOD;
	break;

case 'link' :
// リンクの挿入
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>リンクの活用</span></h3>
		<p>ページの移動や参照サイトの掲示にはリンクが欠かせません。</p>
		<p>WordPressのテーマは（通常）固定ページや記事ページ（カテゴリーアーカイブ）へのリンクが自動で貼られています。</p>
		<p>記事内でリンクを利用するにはビジュアルエディタの場合、<img src="{$img_dir}visual-editor016.png" title="リンクの挿入">アイコンをクリックします。テキストエディタの場合は【link】ボタンをクリックします。</p>
	</li>
	<li>
		<h3><span>リンクの挿入手順</span></h3>
		<img src="{$img_dir}link001.png" title="リンクの挿入" class="img-float-left">
		<p>
			【URL】<br>
			リンク先URLを入力します。<br>後述の『既存のコンテンツにリンク』から自ページ内のコンテンツにリンクを貼る事も可能です。
		</p>
		<p>
			【リンク文字列】<br>
			ここで入力された文字にリンクが貼られます。エディタから文字を範囲選択してリンクを貼る場合は、範囲選択された文字が入ってます。<br>
			<strong>空白の場合</strong>は、リンクのURLが自動でリンク文字列になります。
		</p>
		<p>
			【リンクを新しいタブで開く】<br>
			ページ内でリンクをクリックした際、新しいタブでリンク先を開きます。リンク元のページはそのままなので、わざわざ戻るボタンでページを戻る必要がありません。<br>
			<small>以前はこの機能は非推奨でしたが、最新のHTML5では正式に利用可能となっています</small>
		</p>
		<p>
			【既存のコンテンツにリンク】<br>
			自分のサイトのコンテンツにリンクする場合はこちらが便利です。全ての固定ページ、投稿ページをクリックによってリンクを貼ることができます。ページが多数ある場合は『検索』から入力して記事を絞り込む事もできます。
		</p>
		<p class="float-cut">
			URL入力後、【リンク追加】（再編集の場合は『更新』）をクリックしてカーソル位置（もしくは範囲選択された文字）にリンクを追加します。テキストエディタの場合だと『&lt;a href=""』といったタグが挿入されます。
		</p>
		<h3><span>リンクの編集手順</span></h3>
		<img src="{$img_dir}link002.png" title="リンクの挿入" class="img-float-left">
		<p>再編集する場合は<img src="{$img_dir}link003.png" title="リンクの編集">をクリックします。</p>
		<p>削除する場合は<img src="{$img_dir}link004.png" title="リンクの削除">をクリックします。</p>
		<p>URLをクリックするとリンク先を新たなタブで確認できます。</p>
	</li>
</ul>
EOD;
	break;

case 'image' :
// 画像の挿入
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<p>
			アップロードする（した）画像やファイルをコンテンツ内に挿入する場合は<img src="{$img_dir}image001.png" title="メディアを追加">ボタンをクリックします。
		</p>
		<img src="{$img_dir}image002.png" title="メディアを挿入" class="img-float-left">
		<p>
			【メディアを挿入】が選択されている事を確認します。<br>
			また何らかの理由でURLから直接画像を指定する場合は【URLから挿入】を選択します。<br>
			通常はメディアを挿入から選択します。
		</p>
		<p>『ギャラリー』については<a href="javascript: void(0)" onclick="show_help('6');">こちらのヘルプ</a>を参照します。</p>
		<p>『アイキャッチ画像』については<a href="javascript: void(0)" onclick="show_help('7');">こちらのヘルプ</a>を参照します。</p>
	</li>
	<li>
		<h3><span>ファイルをアップロード</span></h3>
		<div class="sample"><img src="{$img_dir}image003.png" title="ファイルをアップロード"></div>
		<p>新規にファイルをアップロードする場合は【ファイルをアップロード】タブが選択されている事を確認します。</p>
		<p>『アップロードするファイルをドロップ』と書いてある枠に直接ファイルをドラッグ＆ドロップして画像をアップロードできます。</p>
		<p>また、【ファイルを選択】ボタンをクリックして画像を選択してアップロードする事も可能です。</p>
		<p>ファイルは一度に複数のアップロードが可能です。ShiftキーやCtrlキーでアップロードするファイルを複数選択します。</p>
	</li>
	<li>
		<div class="sample"><img src="{$img_dir}image004.png" title="ファイルのアップロード"></div>
		<p>画像をドロップ、もしくは選択→開くをすればアップロードを開始します。</p>
		<p>アップロードが開始されるとタブが自動で【メディアライブラリ】に写ります（左画像参照）。</p>
		<p>メディアライブラリは今までアップロードされたファイルの一覧です。別投稿での再使用やギャラリーの作成、<a href="javascript: void(0)" onclick="show_help('8');">画像の編集（トリミング、サイズ変更等）</a>に利用します。</p>
	</li>
	<li>
		<div class="sample"><img src="{$img_dir}image005.png" title="画像の選択"></div>
		<p>アップロードが完了するとメディアライブラリから画像を選択します。</p>
		<p>画像をクリックする事によって選択・未選択になるので、投稿記事に挿入する画像を選択します（アップロード直後の画像は選択状態になっています）。</p>
	</li>
	<li>
		<img src="{$img_dir}image006.png" title="添付ファイルの編集" class="img-float-left">
		<p>選択したファイルの挿入時の詳細を設定します。</p>
		<p>
			【画像を編集】<br>
			画像のトリミングや反転等、画像の編集を行えます。詳しくは<a href="javascript: void(0)" onclick="show_help('8');">こちらのヘルプ</a>を参照します。
		</p>
		<p>
			【完全に削除する】<br>
			ファイルを削除します。もし他の投稿記事等で使用されている場合はリンク切れとなりますので注意してください。
		</p>
		<p>
			【タイトル】<br>
			任意です。お使いのテーマによってはタイトルを利用しているので入れておく方が無難です。
		</p>
		<p>
			【キャプション】<br>
			任意です。お使いのテーマによってはあった方が良いかもしれません。
		</p>
		<p>
			【代替テキスト】<br>
			任意です。ブラウザやテーマによってはツールチップ表示されます。
		</p>
		<p>
			【説明】<br>
			任意です。お使いのテーマによってはあった方が良いかもしれません。
		</p>
		<p>
			【配置】<br>
			画像の配置を指定します。お使いのテーマが対応している必要があります。
		</p>
		<p>
			【リンク先】<br>
			画像をクリックした時のリンク先を指定します。<br>
			<table><tbody>
				<tr><th>メディアファイル</th><td style="padding-left: 15px">オリジナル画像のURLへ直リンクします</td></tr>
				<tr><th>添付ファイルのページ</th><td style="padding-left: 15px">オリジナル画像の投稿ページへリンクを貼ります</td></tr>
				<tr><th>カスタムURL</th><td style="padding-left: 15px">手動で好きなURLを入力してリンクを貼ります</td></tr>
				<tr><th>なし</th><td style="padding-left: 15px">リンクを貼りません</td></tr>
			</tbody></table>
		</p>
		<p>
			【サイズ】<br>
			投稿に挿入する画像サイズを選択します。オリジナルの画像サイズによって選択できるサイズも変わります。
		</p>
	</li>
	<li>
		設定が良い場合は【投稿に挿入】ボタンをクリックして挿入します。
	</li>
	<li>
		<h3><span>画像配置の高度な設定</span></h3>
		<img src="{$img_dir}image007.png" title="画像の編集" class="img-float-left">
		<p>挿入した画像に更に高度な設定をする事が出来ます。</p>
		<p>挿入した画像をクリックして<img src="{$img_dir}image008.png" title="画像の編集">ボタンをクリックします。</p>
		<p>* <img src="{$img_dir}image009.png" title="画像の配置">は画像の配置を指定できます。</p>
		<p>* <img src="{$img_dir}image010.png" title="挿入画像の削除">は挿入した画像を削除します。</p>
	</li>
	<li>
		<img src="{$img_dir}image011.png" title="画像の編集" class="img-float-left">
		<p>【上級者向け設定】をクリックします。</p>
		<p>
			【画像タイトル属性】<br>
			画像挿入時の『タイトル』と同じです。
		</p>
		<p>
			【画像CSSクラス】<br>
			画像にクラスを付加します。画像に特別なスタイル（装飾）を適用したい場合に使用します。複数設定する場合は半角スペースで区切ります。
		</p>
		<p>
			【リンクを新しいタブで開く】<br>
			ファイルをクリックした際、新しいタブでリンク先を開きます。
		</p>
		<p>
			【リンクrel】<br>
			リンク先との関係を示す文字を入力しますが、自由に入力できます。お使いのテーマで特別な指定がない限りはあまり利用する機会はないでしょう。
		</p>
		<p>
			【リンクCSSクラス】<br>
			画像に貼り付けたリンク自体にクラスを付加します。
		</p>
	</li>
</ul>
EOD;
	break;

case 'gallery' :
// ギャラリーの挿入
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<p>ギャラリーはページ内に画像を並べて表示する機能です。</p>
		<p>
			ギャラリーを作成してコンテンツ内に挿入する場合は<img src="{$img_dir}image001.png" title="メディアを追加">ボタンをクリックします。
		</p>
	</li>
	<li>
		<h3><span>ギャラリーの作成</span></h3>
		<div class="sample"><img src="{$img_dir}gallery001.png" title="ギャラリーの作成"></div>
		<ol>
			<li>【ギャラリーを作成】を選択</li>
			<li>【メディアライブラリ】タブを選択</li>
			<li>ギャラリーに追加したい画像を選択（左画像参照）</li>
			<li>【ギャラリーを作成】ボタンをクリック</li>
		</ol>
	</li>
	<li>
		<h3><span>ギャラリーの編集</span></h3>
		<img src="{$img_dir}gallery003.png" title="ギャラリーの編集" class="img-float-left">
		<p>
			【ギャラリーをキャンセル】<br>
			『ギャラリーを作成』画面に戻ります。
		</p>
		<p>
			【ギャラリーを編集】<br>
			画像の表示順や表示方法を編集する画面です。
		</p>
		<p>
			【ギャラリーに追加】<br>
			新たに画像を追加します。
		</p>
		<p>ギャラリーが作成されると『ギャラリーを編集』画面に映ります。</p>
	</li>
	<li>
		<div class="sample"><img src="{$img_dir}gallery002.png" title="ギャラリーの編集"></div>
		<ul>
			<li>画像をドラッグ＆ドロップで表示順を変更できます（左画像参照）。</li>
			<li><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>でギャラリーから画像を削除します。</li>
			<li>【順序を逆にする】で表示順を逆にします。</li>
			<li>
				「この画像のキャプション」は画像編集の【キャプション】と同等です。<br>
				<small class="text-danger">* 画像の所有者（アップロードした人）が違う画像の編集はできません。</small>
			</li>
		</ul>
	</li>
	<li>
		<h3><span>ギャラリーの設定</span></h3>
		<div class="sample"><img src="{$img_dir}gallery004.png" title="ギャラリーの編集"></div>
		<p>
			【リンク先】<br>
			画像をクリックした際のリンク先を指定します。それぞれの意味は画像編集を確認します。
		</p>
		<p>
			【カラム】<br>
			一行で並べる画像の数を指定します。テーマの大きさによって最適な数を選びます。
		</p>
		<p>
			【ランダム】<br>
			ページが表示された際に画像の並びをランダムで表示します。
		</p>
		<p>
			【サイズ】<br>
			画像のサイズを指定します。通常はサムネイル（最小サイズ）で構いません。
		</p>
	</li>
	<li>
		<h3><span>ギャラリーの挿入・再編集</span></h3>
		<p>設定の完了後、【ギャラリーを挿入（更新）】で挿入します。</p>
		<ul>
			<li>ギャラリーの再編集は、挿入したギャラリーをクリックして<img src="{$img_dir}image008.png" title="ギャラリーの編集">を選択します（下画像参照）。</li>
			<li>ギャラリーの削除は、挿入したギャラリーをクリックして<img src="{$img_dir}image010.png" title="ギャラリーの削除">を選択します（下画像参照）。</li>
		</ul>
		<img src="{$img_dir}gallery005.png" title="ギャラリーの挿入">
	</li>
</ul>
EOD;
	break;

case 'eye-catch' :
// アイキャッチ画像
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<p>投稿サムネイル画像の事で、サムネイルとは視認性を高めるために画像を縮小した見本の画像です。</p>
		<p>テーマによっては記事一覧の表示で利用したりします。逆にテーマによっては対応していないものもあるので確認しておく必要があります。</p>
	</li>
	<li>
		<h3><span>アイキャッチ画像の設定</span></h3>
		<p>アイキャッチ画像を設定するには以下の２種類があります。</p>
		<ol>
			<li><img src="{$img_dir}image001.png" title="メディアを追加">ボタンをクリック</li>
			<li>編集ページ右サイドにある【アイキャッチ画像】パネルの<img src="{$img_dir}eye-catch001.png" title="アイキャッチ画像を設定">をクリック</li>
		</ol>
	</li>
	<li>
		画像を追加する要領で画像を選択（もしくはアップロード）後に<img src="{$img_dir}eye-catch002.png" title="アイキャッチ画像を設定">をクリックしてアイキャッチ画像を設定します。
	</li>
	<li>
		<h3><span>アイキャッチ画像の削除</span></h3>
		<img src="{$img_dir}eye-catch003.png" title="アイキャッチ画像を削除" class="img-float-left">
		<p>【アイキャッチ画像を削除】をクリックします（左画像参照）。</p>
	</li>
</ul>
EOD;
	break;

case 'image-editor' :
// 画像の編集
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<img src="{$img_dir}image-edit001.png" title="画像を編集" class="img-float-left">
		<p>自分がアップロードした画像は「反転」や「回転」「トリミング」等の画像編集が行えます。</p>
		<p>選択した画像の詳細にある【画像を編集】をクリックします。</p>
	</li>
	<li>
		<h3><span>画像編集のアイコンについて</span></h3>
		<table class="table table-bordered table-condensed"><tbody>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit002.png" title="トリミング"></td>
				<td>
					<img src="{$img_dir}image-edit003.png" title="画像の範囲選択" class="pull-left" style="margin-right: 10px">
					<p>画像の一部をマウスクリックのままドラッグして範囲選択（左画像参照）した箇所をトリミング（切り出し加工）します。</p>
					<p>選択された範囲を解除するには画像の選択外（シャドー）の部分をクリックします。</p>
					<p>選択範囲の位置や大きさの変更は白い四角にマウスを当てて矢印アイコンの変更を確認してドラッグします。</p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit004.png" title="画像の回転"></td>
				<td>左回りに画像を９０度回転させます。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit005.png" title="画像の回転"></td>
				<td>右回りに画像を９０度回転させます。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit006.png" title="画像の反転"></td>
				<td>縦に画像を反転させます。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit007.png" title="画像の反転"></td>
				<td>横に画像を反転させます。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit008.png" title="元に戻す"></td>
				<td>間違った場合に操作を一つ戻します。</td>
			</tr>
			<tr>
				<td style="text-align: center"><img src="{$img_dir}image-edit008.png" title="やり直す"></td>
				<td>元に戻した操作をやり直します。</td>
			</tr>
		</tbody></table>
	</li>
	<li>
		<h3><span>その他の操作について</h3>
		<p>【画像縮尺の変更】、【画像のトリミング】、【サムネイル設定】についてはそれぞれ<img src="{$img_dir}image-edit010.png" title="操作のヘルプ">をクリックして確認できます</p>
	</li>
	<li>
		<p>画像編集が完了すれば【保存】をクリックして変更を保存します。</p>
		<p>【キャンセル】、もしくは保存を行わずに【戻る】をクリックすれば操作を取り消せます。</p>
	</li>
</ul>
EOD;
	break;

case 'draft' :
// 下書きとして保存
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>下書きとして保存</span></h3>
		<p>文字通り、下書きとして保存します。<br>書きかけの記事を保存しておく時に使います。</p>
		<p>また、突然のトラブルに対応する為に、ある程度の段階で保存をしておく事も大事です。<small class="text-warning">*</small></p>
		<p class="text-warning"><small>* WordPressにはオートセーブ機能が標準装備です（意図的に外していれば別ですが）。</small></p>
	</li>
</ul>
EOD;
	break;

case 'publish' :
// 公開
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>公開</span></h3>
		<p>投稿記事を公開します。ホームページ上で誰でも閲覧が可能になります。</p>
	</li>
</ul>
EOD;
	break;

case 'future' :
// 予約投稿
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>予約投稿</span></h3>
		<img src="{$img_dir}save001.png" title="予約投稿" class="img-float-left">
		<p>指定した日時に投稿記事を公開します。</p>
		<p>時間指定は【すぐに公開する】の横にある【編集】をクリックします（左画像参照）。</p>
		<p class="float-cut-left">日時を指定後【OK】ボタンをクリックすると<img src="{$img_dir}save002.png" title="公開"> →<img src="{$img_dir}save003.png" title="予約投稿">に変更されるのでクリックして予約します。</p>
		<p>予約投稿を止めたい場合は、同じ操作で【キャンセル】をクリックします。</p>
	</li>
</ul>
EOD;
	break;

case 'pending' :
// レビュー待ち
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>レビュー待ち</span></h3>
		<img src="{$img_dir}save004.png" title="レビュー待ち" class="img-float-left">
		<p>レビュー待ちとは「編集者」や「管理者」に最終チェックをしてもらう段階の事です。<br>公開前に投稿記事の内容に問題がないか確認してもらい、最終的に管理者（編集者）に公開してもらいます。</p>
		<p>WordPressのユーザーレベルが【寄稿者】の場合、<img src="{$img_dir}save005.png" title="レビュー待ちとして送信">しか出来ません。また、【寄稿者】に公開後の編集は権限がありません。</p>
	</li>
EOD;
	break;

case 'password' :
// パスワード保護
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>パスワード保護</span></h3>
		<img src="{$img_dir}save006.png" title="パスワード保護" class="img-float-left">
		<p>一部の閲覧者のみに限定公開したい投稿記事にはパスワードを掛ける事が出来ます。</p>
		<p>【公開状態】の横にある【編集】をクリックして【パスワード保護】を選択してパスワードを入力します。</p>
		<p>ホームページ上で投稿記事を開いた時にパスワードを聞いてきます。正しいパスワードを入力すると閲覧が出来るようになります。</p>
	</li>
</ul>
EOD;
	break;

case 'private' :
// 非公開
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>非公開</span></h3>
		<img src="{$img_dir}save007.png" title="非公開" class="img-float-left">
		<p>
			非公開に設定された投稿記事はホームページ上で一般の人に公開されませんが、WordPressにログインしているユーザーには公開されます。
		</p>
	</li>
</ul>
EOD;
	break;

case 'post-tag' :
// タグについて
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<h3><span>タグとは</span></h3>
		<p>「日記」、「スポーツ」、「趣味」、「テレビ」等、投稿記事を連想させる単語です。</p>
		<p>基準はなく好きなタグを投稿記事に紐付ける事ができますが、内容と関係のないタグを付けるのは閲覧者を混乱させるだけなのでしない方が良いでしょう。</p>
		<p>テーマによってはページ内にタグを表示したり、アーカイブとして一覧表示させたりしますので、可能な限り入力しておく方が無難です。</p>
	</li>
	<li>
		<h3><span>タグの有用性について</span></h3>
		<p>
			google等の検索サービスで有用に働いている（検索上位に上げてくれる）と思います。<small>*</small><br>
			逆に記事内容に関係のないタグを複数貼り付けてあると信頼性の低い記事と判断されてしまう可能性もあります。<small>*</small>
		</p>
		<p class="text-danger"><strong>* 注意！</strong> あくまで個人的体感による感想で検証もしていませんので鵜呑みにしないでください。</p>
	</li>
</ul>
EOD;
	break;

case 'comment' :
// コメントについて
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<p class="text-center"><img src="{$img_dir}comment001.png" title="コメント"></p>
		<p>コメントは【投稿者】以上から承認等の管理が可能になります。</p>
		<p>WordPressの設定によりますが、通常は初めてコメントした閲覧者は非表示となっていますので、【承認する】をクリックして承認します。</p>
		<p>【返信】はそのコメントに対してツリー上の入れ子となります（テーマが対応しているのが前提です）。</p>
		<p>それ以外でコメントを独自に入れる場合は【コメントする】から行います。</p>
	</li>
</ul>
EOD;
	break;

case 'postcustom' :
// カスタムフィールドについて
$htm = <<< EOD
<ul class="ug-help-ul">
	<li>
		<p class="text-center"><img src="{$img_dir}postcustom001.png" title="カスタムフィールド"></p>
		<p>
			カスタムフィールドはオリジナルの名前（タイトル）と値を追加できる機能です。<br>
			<small class="text-warning">* お使いのテーマが対応している必要があります</small>
		</p>
		<p>一度作成したカスタムフィールドの名前は別の記事の編集画面でも利用できるので、統一したカスタムデータを追加する事ができます。</p>
	</li>
</ul>
EOD;
	break;

}

$p = array( '/[\n\r\t]/' );
$r = array( '' );
return preg_replace( $p, $r, $htm );
}
?>
