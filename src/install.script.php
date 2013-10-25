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

if (!class_exists('PlgSystemMootomboFrameworkinstallerInstallerScript')) {

	/**
	 *
	 */
	class PlgSystemMootomboFrameworkinstallerInstallerScript
	{
		/**
		 * @var array
		 */
		protected $packages = array();
		/**
		 * @var
		 */
		protected $sourcedir;
		/**
		 * @var
		 */
		protected $installerdir;
		/**
		 * @var
		 */
		protected $manifest;

		/**
		 * XInstaller
		 */
		protected $parent;

		/**
		 * @param $parent
		 */
		protected function setup($parent)
		{
			$this->parent       = $parent;
			$this->sourcedir    = $parent->getParent()->getPath('source');
			$this->manifest     = $parent->getParent()->getManifest();
			$this->installerdir = $this->sourcedir . '/' . 'installer';
		}

		/**
		 * @param $parent
		 *
		 * @return bool
		 */
		public function install($parent)
		{

			$this->cleanBogusError();

			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');


			$retval = true;
			$buffer = '';


			$buffer .= ob_get_clean();

			$run_installer = true;


			// Cycle through cogs and install each

			if ($run_installer) {
				if (count($this->manifest->cogs->children())) {
					if (!class_exists('XInstaller')) {
						require_once($this->installerdir . '/' . 'XInstaller.php');
					}

					foreach ($this->manifest->cogs->children() as $cog) {
						$folder_found = false;
						$folder = $this->sourcedir . '/' . trim($cog);

						jimport('joomla.installer.helper');
						if (is_dir($folder)) {
							// if its actually a directory then fill it up
							$package                = Array();
							$package['dir']         = $folder;
							$package['type']        = JInstallerHelper::detectType($folder);
							$package['installer']   = new XInstaller();
							$package['name']        = (string)$cog->name;
							$package['state']       = 'Success';
							$package['description'] = (string)$cog->description;
							$package['msg']         = '';
							$package['type']        = ucfirst((string)$cog['type']);

							$package['installer']->setCogInfo($cog);
							// add installer to static for possible rollback
							$this->packages[] = $package;
							if (!@$package['installer']->install($package['dir'])) {
								while ($error = JError::getError(true)) {
									$package['msg'] .= $error;
								}
								XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_ERROR, $package['msg']);
								break;
							}
							if ($package['installer']->getInstallType() == 'install') {
								XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_INSTALLED);
							} else {
								XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_UPDATED);
							}
							if (is_file($folder . '/setup.php')) {
								// check if something to do after installation
								if (($loadsetup = require_once($folder . '/setup.php')) == true) {
									XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_PREPARED, implode('<br>', $loadsetup));
								} else {
									XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_ERROR, implode('<br>', $loadsetup));
								}
							}
						} else {
							$package                = Array();
							$package['dir']         = $folder;
							$package['name']        = (string)$cog->name;
							$package['state']       = 'Failed';
							$package['description'] = (string)$cog->description;
							$package['msg']         = '';
							$package['type']        = ucfirst((string)$cog['type']);
							XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_ERROR, JText::_('JLIB_INSTALLER_ABORT_NOINSTALLPATH'));
							break;
						}
					}
				} else {
					$parent->getParent()->abort(JText::sprintf('JLIB_INSTALLER_ABORT_PACK_INSTALL_NO_FILES', JText::_('JLIB_INSTALLER_' . strtoupper($this->route))));
				}
			}
			return $retval;
		}

		/**
		 * @param $parent
		 */
		public function uninstall($parent)
		{

		}

		/**
		 * @param $parent
		 *
		 * @return bool
		 */
		public function update($parent)
		{
			return $this->install($parent);
		}

		/**
		 * @param $type
		 * @param $parent
		 *
		 * @return bool
		 */
		public function preflight($type, $parent)
		{
			$this->setup($parent);

			//Load Event Handler
			if (!class_exists('XInstallerEvents')) {
				$event_handler_file = $this->installerdir . '/XInstallerEvents.php';
				require_once($event_handler_file);
				$dispatcher = JDispatcher::getInstance();
				$plugin = new XInstallerEvents($dispatcher);
				$plugin->setTopInstaller($this->parent->getParent());
			}

			if (is_file(dirname(__FILE__) . '/requirements.php')) {
				// check to see if requierments are met
				if (($loaderrors = require_once(dirname(__FILE__) . '/requirements.php')) !== true) {
					$manifest = $parent->get('manifest');
					$package['name'] = (string)$manifest->description;
					XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_ERROR, implode('<br />', $loaderrors));
					return false;
				}
			}

			// Set the core description from manifest for rendering at the bottom of the installer
			$coreDescription = (string)$parent->get('manifest')->coreDescription;
			XInstallerEvents::addCoreDescription($coreDescription);
		}

		/**
		 * @param $type
		 * @param $parent
		 */
		public function postflight($type, $parent)
		{
			if (is_file(dirname(__FILE__) . '/setup.php')) {
				// check if something to do after installation
				$manifest = $parent->get('manifest');
				$package['name'] = (string)$manifest->description;
				if (($loadsetup = require_once(dirname(__FILE__) . '/setup.php')) == true) {
					XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_PREPARED, implode('<br>', $loadsetup));
				} else {
					XInstallerEvents::addMessage($package, XInstallerEvents::STATUS_ERROR, implode('<br>', $loadsetup));
				}
			}

			$conf = JFactory::getConfig();
			$conf->set('debug', false);
			$parent->getParent()->abort();
		}

		/**
		 * @param null $msg
		 * @param null $type
		 */
		public function abort($msg = null, $type = null)
		{
			if ($msg) {
				JError::raiseWarning(100, $msg);
			}
			foreach ($this->packages as $package) {
				$package['installer']->abort(null, $type);
			}
		}

		/**
		 *
		 */
		protected function cleanBogusError()
		{
			$errors = array();
			while (($error = JError::getError(true)) !== false) {
				if (!($error->get('code') == 1 && $error->get('level') == 2 && $error->get('message') == JText::_('JLIB_INSTALLER_ERROR_NOTFINDXMLSETUPFILE'))) {
					$errors[] = $error;
				}
			}
			foreach ($errors as $error) {
				JError::addToStack($error);
			}

			$app               = new XInstallerJAdministratorWrapper(JFactory::getApplication());
			$enqueued_messages = $app->getMessageQueue();
			$other_messages    = array();
			if (!empty($enqueued_messages) && is_array($enqueued_messages)) {
				foreach ($enqueued_messages as $enqueued_message) {
					if (!($enqueued_message['message'] == JText::_('JLIB_INSTALLER_ERROR_NOTFINDXMLSETUPFILE') && $enqueued_message['type']) == 'error') {
						$other_messages[] = $enqueued_message;
					}
				}
			}
			$app->setMessageQueue($other_messages);
		}
	}

	if (!class_exists('XInstallerJAdministratorWrapper')) {
		/**
		 *
		 */
		class XInstallerJAdministratorWrapper extends JAdministrator
		{
			/**
			 * @var JAdministrator
			 */
			protected $app;

			/**
			 * @param JAdministrator $app
			 */
			public function __construct(JAdministrator $app)
			{
				$this->app =& $app;
			}

			/**
			 * @return array
			 */
			public function getMessageQueue()
			{
				return $this->app->getMessageQueue();
			}


			/**
			 * @param $messages
			 */
			public function setMessageQueue($messages)
			{
				$this->app->_messageQueue = $messages;
			}

		}
	}
}