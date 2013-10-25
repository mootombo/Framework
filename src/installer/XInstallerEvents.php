<?php
/**
 * @project          MOOTOMBO!WebOS
 * @subProject       MFW - A PHP, Javascript and CSS Framework
 *
 * @package          Framework
 * @subPackage       Library
 * @version          1.0
 *
 * @author           devXive - research and development <support@devxive.com> (http://www.devxive.com)
 * @copyright        Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @assetsLicense    devXive Proprietary Use License (http://www.devxive.com/license)
 *
 * @since            1.0
 */

class XInstallerEvents extends JPlugin
{
	const STATUS_ERROR     = 'error';
	const STATUS_INSTALLED = 'installed';
	const STATUS_UPDATED   = 'updated';
	const STATUS_PREPARED  = 'prepared';

	protected static $coreDescription;

	protected static $messages = array();

	/**
	 * @var JInstaller
	 */
	protected $toplevel_installer;


	public function setTopInstaller(&$installer)
	{
		$this->toplevel_installer = $installer;
	}


	public function __construct(&$subject, $config = array())
	{

		parent::__construct($subject, $config);

		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		$install_html_file = dirname(__FILE__) . '/../install.html';
		$install_css_file  = dirname(__FILE__) . '/../install.css';
		$tmp_path          = JPATH_ROOT . '/tmp';
		if (JFolder::exists($tmp_path)) {
			// Copy install.css to tmp dir for inclusion
			JFile::copy($install_css_file, $tmp_path . '/install.css');
			JFile::copy($install_html_file, $tmp_path . '/install.html');
		}

	}


	public static function addMessage($package, $status, $message = '')
	{
		self::$messages[] = call_user_func_array(array('XInstallerEvents', $status), array($package, $message));
	}


	/**
	 * @return string
	 */
	protected static function loadCss()
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		$buffer            = '';
		// Drop out Style
		if (file_exists( JPATH_ROOT . '/tmp/install.html')) {
			$buffer .= JFile::read(JPATH_ROOT . '/tmp/install.html');
		}
		return $buffer;
	}


	/**
	 * @param $package
	 * @param $msg
	 *
	 * @return string
	 */
	public static function error($package, $msg)
	{
		ob_start();
		?>
			<li class="xinstall-failure">
				<span class="xinstall-row">
					<span class="xinstall-icon">
						<i class="icon-remove"></i>
					</span>
					<?php echo $package['name'];?> installation failed
				</span>
				<span class="xinstall-msg">
					<?php echo $msg; ?>
				</span>
			</li>
		<?php
		$out = ob_get_clean();
		return $out;
	}


	/**
	 * @param $package
	 *
	 * @return string
	 */
	public static function installed($package)
	{
		ob_start();
		?>
			<li class="xinstall-success">
				<span class="xinstall-row">
					<span class="xinstall-icon">
						<i class="icon-ok"></i>
					</span>
					<?php echo $package['name'];?> installation was successful
				</span>
			</li>
		<?php
		$out = ob_get_clean();
		return $out;
	}


	/**
	 * @param $package
	 *
	 * @return string
	 */
	public static function updated($package)
	{
		ob_start();
		?>
			<li class="xinstall-update">
				<span class="xinstall-row">
					<span class="xinstall-icon">
						<i class="icon-refresh"></i>
					</span>
					<?php echo $package['name'];?> update was successful
				</span>
			</li>
		<?php
		$out = ob_get_clean();
		return $out;
	}


	/**
	 * @param $package
	 * @param $msg
	 *
	 * @return string
	 */
	public static function prepared($package, $msg)
	{
		ob_start();
		?>
			<li class="xinstall-prepared">
				<span class="xinstall-row">
					<span class="xinstall-icon">
						<i class="icon-wrench"></i>
					</span>
					<?php echo $package['name'];?> setup:
				</span>
				<span class="xinstall-msg">
					<?php echo $msg; ?>
				</span>
			</li>
		<?php
		$out = ob_get_clean();
		return $out;
	}


	public static function addCoreDescription($desc)
	{
		self::$coreDescription = $desc;
	}


	public function onExtensionAfterInstall($installer, $eid)
	{
		$lang = JFactory::getLanguage();
		$lang->load('install_override', dirname(__FILE__), $lang->getTag(), true);
		$this->toplevel_installer->set('extension_message', $this->getMessages());
	}


	public function onExtensionAfterUpdate($installer, $eid)
	{
		$lang = JFactory::getLanguage();
		$lang->load('install_override', dirname(__FILE__), $lang->getTag(), true);
		$this->toplevel_installer->set('extension_message', $this->getMessages());
	}


	protected function getMessages()
	{
		$buffer = '';
		$buffer .= self::loadCss();
		$buffer .= '<div id="xinstall-logo"><ul id="xinstall-status" class="well">';
		$buffer .= implode('', self::$messages);
		$buffer .= '</ul></div>';
		$buffer .= '</ul></div><div class="row-fluid well xinstall-description">';
		$buffer .= '<div>';
		$buffer .= self::$coreDescription;
		$buffer .= '</div>';
		$buffer .= '<div class="small pull-right">';
		$buffer .= 'devXive Application Installer, &copy; ' . date('Y', time()) . ' by <a href="http://devxive.com" target="_blank">devXive - research and development</a>';
		$buffer .= '</div>';
		$buffer .= '</div>';
		return $buffer;
	}
}