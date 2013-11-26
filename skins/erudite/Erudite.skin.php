<?php
/**
 * Erudite skin
 *
 * @file
 * @ingroup Skins
 */

class SkinErudite extends SkinTemplate {

	var $skinname = 'erudite', $stylename = 'erudite',
		$template = 'EruditeTemplate', $useHeadElement = true;

	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		/* Assures mobile devices that the site doesn't assume traditional
		 * desktop dimensions, so they won't downscale and will instead respect
		 * things like CSS's @media rules */
		$out->addHeadItem( 'viewport',
			'<meta name="viewport" content="width=device-width, initial-scale=1">'
		);
	}

	/**
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( 'skins.erudite' );
	}
}

class EruditeTemplate extends BaseTemplate {
	/**
	 * Like msgWiki() but it ensures edit section links are never shown.
	 *
	 * Needed for Mediawiki 1.19 & 1.20 due to bug 36975:
	 * https://bugzilla.wikimedia.org/show_bug.cgi?id=36975
	 *
	 * @param $message Name of wikitext message to return
	 */
	function msgWikiNoEdit( $message ) {
		global $wgOut;
		global $wgParser;

		$popts = new ParserOptions();
		$popts->setEditSection( false );
		$text = wfMessage( $message )->text();
		return $wgParser->parse( $text, $wgOut->getTitle(), $popts )->getText();
	}

	/**
	 * Template filter callback for this skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	public function execute() {
		global $wgEruditeBannerImg;

		$this->html( 'headelement' );

		if ( !isset( $this->data['sitename'] ) ) {
			global $wgSitename;
			$this->set( 'sitename', $wgSitename );
		}

		?>
		<?php if( $this->data['showjumplinks'] ) { ?>
		<div class="mw-jump">
			<a href="#content"><?php $this->msg( 'erudite-skiptocontent' ) ?></a><?php $this->msg( 'comma-separator' ) ?>
			<a href="#search"><?php $this->msg( 'erudite-skiptosearch' ) ?></a>
		</div>
		<?php } ?>
		<div id="wrapper" class="hfeed">
		<!-- header -->
		<?php
			if ( isset( $wgEruditeBannerImg ) ) {
				echo "<div id='header-wrap' style='background-image: url($wgEruditeBannerImg)'>";
	} else {
				echo '<div id="header-wrap">';
			}
		?>
<!-- Contact Form CSS files -->
<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />

<!-- IE6 "fix" for the close png image -->
<!--[if lt IE 7]>
<link type='text/css' href='css/basic_ie.css' rel='stylesheet' media='screen' />
<![endif]-->
		<div id="header" role="banner">
<style>
@media only screen and (max-width: 640px) {
#logo {
width:32%;
padding-left:7px;
}
#searchform {
display:none;
}
}
@media only screen and (max-width: 1440px) {
}
#searchform {
float:right;
}
#s{
height:43px;
margin:1px;
font-size:21px;
border-radius:28px;
padding-bottom:4px;
padding-left:24px;
}
#searchsubmit{
height:47px;
margin-left:-60px;
border-radius:47px;
border:0;
cursor:pointer;
}
</style>
                                <form action="<?php $this->text( 'wgScript' ); ?>" id="searchform">
                                        <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
                                        <div>
                                                <?php echo $this->makeSearchInput( array( 'type' => 'text', 'id' => 's', 'placeholder' => 'search now' ) ); ?>
                                                <?php echo $this->makeSearchButton( 'go', array(
                                                        'value' => $this->translator->translate( 'searchbutton' ),
                                                        'class' => "searchButton",
                                                        'id'    => "searchsubmit",
                                                ) ); ?>
                                        </div>
                                </form>
<a href="http://www.brightprocess.com"><?php echo Html::element( 'img', array( 'id' => 'logo', 'src' => $this->data['logopath'], 'alt' => 'Bright Process Logo' ) ); ?></a>
 <h1 id="siteTitle"><a href="<?php echo htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] ) ?>" title="<?php $this->text( 'sitename' ); ?>" rel="home"><?php $this->text( 'sitename' ); ?></a></h1>
			<div id="tagline"><?php $this->msg( 'tagline' ) ?></div>
		</div>

		<div id="access" role="navigation">
			<div id="menu">
			<ul id="menu-urs" class="menu">

			<?php
				foreach( $this->data['sidebar']['navigation'] as $key => $val ) {
					printf( '<li style="padding-top:8px;" id="menu-item-%s" class="menu-item">', Sanitizer::escapeId( $val['id'] ) );
					printf( '<a href="%s">%s</a>', htmlspecialchars( $val['href'] ), htmlspecialchars( $val['text'] ) );
					echo "</li>\n";
				}
			?>
<style>
.loginButton {
	-moz-box-shadow: 0px 10px 14px -7px #3e7327;
	-webkit-box-shadow: 0px 10px 14px -7px #3e7327;
	box-shadow: 0px 10px 14px -7px #3e7327;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #77b55a), color-stop(1, #72b352));
	background:-moz-linear-gradient(top, #77b55a 5%, #72b352100%);
	background:-webkit-linear-gradient(top, #77b55a 5%, #72b352 100%);
	background:-o-linear-gradient(top, #77b55a 5%, #72b352 100%);
	background:-ms-linear-gradient(top, #77b55a 5%, #72b352 100%);
	background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77b55a', endColorstr='#72b352',GradientType=0);
	background-color:#77b55a;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	border:1px solid #4b8f29;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:17px;
	font-weight:bold;
	padding:6px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #5b8a3c;
}
.loginButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #72b352), color-stop(1, #77b55a));
	background:-moz-linear-gradient(top, #72b352 5%, #77b55a 100%);
	background:-webkit-linear-gradient(top, #72b352 5%, #77b55a 100%);
	background:-o-linear-gradient(top, #72b352 5%, #77b55a 100%);
	background:-ms-linear-gradient(top, #72b352 5%, #77b55a 100%);
	background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#72b352', endColorstr='#77b55a',GradientType=0);
	background-color:#72b352;
}
.loginButton:active {
	position:relative;
	top:1px;
}
.registerButton {
	-moz-box-shadow: 0px 10px 14px -7px #1d437d;
	-webkit-box-shadow: 0px 10px 14px -7px #1d437d;
	box-shadow: 0px 10px 14px -7px #1d437d;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #5989b3), color-stop(1, #2f3f8f));
	background:-moz-linear-gradient(top, #5989b3 5%, #2f3f8f100%);
	background:-webkit-linear-gradient(top, #5989b3 5%, #2f3f8f 100%);
	background:-o-linear-gradient(top, #5989b3 5%, #2f3f8f 100%);
	background:-ms-linear-gradient(top, #5989b3 5%, #2f3f8f 100%);
	background:linear-gradient(to bottom, #5989b3 5%, #2f3f8f 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5989b3', endColorstr='#2f3f8f',GradientType=0);
	background-color:#5989b3;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	border:1px solid #2847bf;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:17px;
	font-weight:bold;
	padding:6px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #092f91;
}
.registerButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2f3f8f), color-stop(1, #5989b3));
	background:-moz-linear-gradient(top, #2f3f8f 5%, #5989b3 100%);
	background:-webkit-linear-gradient(top, #2f3f8f 5%, #5989b3 100%);
	background:-o-linear-gradient(top, #2f3f8f 5%, #5989b3 100%);
	background:-ms-linear-gradient(top, #2f3f8f 5%, #5989b3 100%);
	background:linear-gradient(to bottom, #2f3f8f 5%, #5989b3 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2f3f8f', endColorstr='#5989b3',GradientType=0);
	background-color:#2f3f8f;
}
.registerButton:active {
	position:relative;
	top:1px;
}
.logoutButton {
	-moz-box-shadow: 0px 10px 14px -7px #7d1e51;
	-webkit-box-shadow: 0px 10px 14px -7px #7d1e51;
	box-shadow: 0px 10px 14px -7px #7d1e51;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #b35959), color-stop(1, #ff2424));
	background:-moz-linear-gradient(top, #b35959 5%, #ff2424100%);
	background:-webkit-linear-gradient(top, #b35959 5%, #ff2424 100%);
	background:-o-linear-gradient(top, #b35959 5%, #ff2424 100%);
	background:-ms-linear-gradient(top, #b35959 5%, #ff2424 100%);
	background:linear-gradient(to bottom, #b35959 5%, #ff2424 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#b35959', endColorstr='#ff2424',GradientType=0);
	background-color:#b35959;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	border:1px solid #bd2828;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:17px;
	font-weight:bold;
	padding:6px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #8f0a25;
}
.logoutButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff2424), color-stop(1, #b35959));
	background:-moz-linear-gradient(top, #ff2424 5%, #b35959 100%);
	background:-webkit-linear-gradient(top, #ff2424 5%, #b35959 100%);
	background:-o-linear-gradient(top, #ff2424 5%, #b35959 100%);
	background:-ms-linear-gradient(top, #ff2424 5%, #b35959 100%);
	background:linear-gradient(to bottom, #ff2424 5%, #b35959 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff2424', endColorstr='#b35959',GradientType=0);
	background-color:#ff2424;
}
.logoutButton:active {
	position:relative;
	top:1px;
}
</style>
<?php
if(!$this->data['loggedin']) {
?>
	<li id="menu-item-n-login" class="menu-item"><a class="loginButton" href="http://162.243.83.127/mediawiki/index.php?title=Special:UserLogin">Login</a></li>
        <li id="menu-item-n-login-register" class="menu-item"><a class="registerButton" href="http://162.243.83.127/mediawiki/index.php?title=Special:RequestAccount">Register</a></li>
<?php
} else {
?>
<li id="menu-item-n-login" class="menu-item"><a class="logoutButton" href="http://162.243.83.127/mediawiki/index.php?title=Special:UserLogout">Logout</a></li>
        <li id="menu-item-n-login-register" class="menu-item"><a class="registerButton" href="http://162.243.83.127/mediawiki/index.php?title=Special:RequestAccount">Create a User</a></li>

<?php
}
?>
</ul>
</div>
		</div>
		</div>
		<!-- /header -->

		<div id="mw-js-message"></div>
		<?php
			foreach( array( 'newtalk', 'sitenotice', 'undelete' ) as $msg ) {
				if( $this->data[$msg] ) {
					echo "<div id='$msg' class='message'><p>";
					$this->html( $msg );
					echo '</p></div>';
				}
			}
		?>

		<!-- content -->
		<div id="container">
		<div id="content" class="mw-body" role="main">
			<div id="content-container">
				<h1 class="entry-title"><?php $this->html( 'title' ); ?></h1>
				<?php if ( $this->data['subtitle'] ) { ?>
					<div class="subtitle"><?php $this->html( 'subtitle' ) ?></div>
				<?php } ?>

				<div id="bodyContent" class="entry-content">
				<?php $this->html( 'bodytext' ) ?>
<?php $this->html( 'dataAfterContent' ); ?>
                <div id="secondary" class="footer" style="float:right;">
                                <h3><?php $this->msg( 'toolbox' ) ?></h3>
                                <?php
                                        foreach ( $this->getToolbox() as $key => $tbitem ) {
                                                echo $this->makeListItem( $key, $tbitem );
                                        }
                                        wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
                                ?>
                                <?php echo $this->msgWikiNoEdit( 'erudite-extracontent-column2' ); ?>
                </div>  
			<div id="footer">
				<?php
					foreach ( $this->getFooterLinks() as $category => $links ) {
						if ( $category === 'info' ) {
							foreach ( $links as $key ) {
								echo '<p>';
								$this->html( $key );
								echo '</p>';
							}
						} else {
							echo '<ul class="footer-list">';
							foreach ( $links as $key ) {
								echo '<li>';
								$this->html( $key );
								echo '</li>';
							}
							echo '</ul>';
						}
					}
				?>
			</div>

			<?php $this->html( 'catlinks' ); ?>
			<?php if( $this->data['language_urls'] ) { ?>
					<h3><?php $this->msg( 'otherlanguages' ) ?></h3>
					<?php
						foreach( $this->data['language_urls'] as $key => $langlink ) {
							echo $this->makeListItem( $key, $langlink );
						}
					?>
			<?php } ?>
				<?php echo $this->msgWikiNoEdit( 'erudite-extracontent-column1' ); ?>

		</div>
		<div class="visualClear"></div>

		</div>
		</div>
		<!-- /footer -->

                </div>
                <!-- /content -->

		</div>
		<?php $this->printTrail(); ?>
		</body>
		</html>
		<?php
	}
}
