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

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

if (!class_exists("JInstallerComponent"))
{
    @include_once(JPATH_LIBRARIES . '/joomla/installer/adapters/component.php');
}
/**
 * Component installer
 *
 * @package        Joomla.Framework
 * @subpackage    Installer
 * @since        1.5
 */
class XInstallerComponent extends JInstallerComponent
{

    protected $installtype = 'install';

    protected $access;
    protected $enabled;
    protected $client;
    protected $ordering = 0;
    protected $protected;
    protected $params;
    protected $remove_admin_menu;

    const DEFAULT_ACCESS = 1;
    const DEFAULT_ENABLED = 'true';
    const DEFAULT_PROTECTED = 'false';
    const DEFAULT_CLIENT = 'site';
    const DEFAULT_ORDERING = 0;
    const DEFAULT_PARAMS = null;
    const DEFAULT_REMOVE_ADMIN_MENU = 'false';


    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function getAccess()
    {
        return $this->access;
    }

    public function setClient($client)
    {
        switch ($client)
        {
            case 'site':
                $client = 0;
                break;
            case 'administrator':
                $client = 1;
                break;
            default:
                $client = (int)$client;
                break;
        }
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setEnabled($enabled)
    {
        switch (strtolower($enabled))
        {
            case 'true':
                $enabled = 1;
                break;
            case 'false':
                $enabled = 0;
                break;
            default:
                $enabled = (int)$enabled;
                break;
        }
        $this->enabled = $enabled;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setOrdering($ordering)
    {
        $this->ordering = $ordering;
    }

    public function getOrdering()
    {
        return $this->ordering;
    }

    public function setProtected($protected)
    {
        switch (strtolower($protected))
        {
            case 'true':
                $protected = 1;
                break;
            case 'false':
                $protected = 0;
                break;
            default:
                $protected = (int)$protected;
                break;
        }
        $this->protected = $protected;
    }

    public function getProtected()
    {
        return $this->protected;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    protected function updateExtension(&$extension)
    {
        if ($extension)
        {
            $extension->access = $this->access;
            $extension->enabled = $this->enabled;
            $extension->protected = $this->protected;
            $extension->client_id = $this->client;
            $extension->ordering = $this->ordering;
            $extension->params = $this->params;
            $extension->store();
        }
    }

    public function postInstall($extensionId)
    {

        $coginfo = $this->parent->getCogInfo();

        $this->setAccess(($coginfo['access']) ? (int)$coginfo['access'] : self::DEFAULT_ACCESS);
        $this->setEnabled(($coginfo['enabled']) ? (string)$coginfo['enabled'] : self::DEFAULT_ENABLED);
        $this->setProtected(($coginfo['protected']) ? (string)$coginfo['protected'] : self::DEFAULT_PROTECTED);
        $this->setClient(($coginfo['client']) ? (string)$coginfo['client'] : self::DEFAULT_CLIENT);
        $this->setParams(($coginfo->params) ? (string)$coginfo->params : self::DEFAULT_PARAMS);
        $this->setOrdering(($coginfo['ordering']) ? (int)$coginfo['ordering'] : self::DEFAULT_ORDERING);



        $extention = $this->loadExtension($extensionId);

        // update the extension info
        $this->updateExtension($extention);

        $remove_admin_menu = ($coginfo['remove_admin_menu']) ? strtolower((string)$coginfo['remove_admin_menu']) : self::DEFAULT_REMOVE_ADMIN_MENU;
        if ($remove_admin_menu === 'true')
        {
            $this->_removeAdminMenus($extention);
        }
    }

    protected function &loadExtension($eid)
    {
        $row = JTable::getInstance('extension');
        $row->load($eid);
        return $row;
    }

    public function getInstallType()
    {
        return $this->installtype;
    }

    public function update()
    {
        $this->installtype = 'update';
        return parent::update();
    }


}
