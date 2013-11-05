<?php
/**
 * @project          MOOTOMBO!WebOS
 * @subProject       MFW - A PHP, Javascript and CSS Framework
 *
 * @package          Framework
 * @subPackage	Library
 * @version		1.0
 *
 * @author           devXive - research and development <support@devxive.com> (http://www.devxive.com)
 * @copyright        Copyright (C) 1997 - 2013 devXive - research and development. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @assetsLicense    devXive Proprietary Use License (http://www.devxive.com/license)
 */

// no direct access
defined('_MFWRA') or die;

/**
 * MOOTOMBO!Framework Html class
 *
 * @package  Framework
 * @since    1.0
 */
abstract class MFWHtmlHead
{
	/*
	 * Method to get the metaset for facebooks open graph
	 *
	 * @param     string    $title     Title of the current ( viewed ) page
	 * @param     string    $image     Full web path of an image from the current ( viewed ) page. If nothing is set, it try to load a standard image from template/img path (325x325px)
	 * @param     string    $app_id    Facebook Application ID
	 *
	 * @return    html
	 *
	 * @since     1.0
	 */
	function setMetaFacebook( $title = false, $image = false, $app_id = false ) {
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$config = JFactory::getConfig();
		$params = $app->getParams();
		$headdata = $doc->getHeadData();

		$param_title = $title ? $title : $headdata['title'];

		$meta = '';
		$meta .= '<meta property="og:site_name" content="' . $config->get('sitename') . '" />' . "\n\t";

		$meta .= '<meta property="og:title" content="' . $param_title . '" />' . "\n\t";

		// Check if an image is set
		if ( $app_id ) {
			$meta .= '<meta property="og:image" content="' . $doc->base . 'templates/' . $this->template . '/img/app-icon-fb.png" />' . "\n\t";
		}

		$meta .= '<meta property="og:description" content="' . $headdata['description'] . '" />' . "\n\t";
		$meta .= '<meta property="og:type" content="' . $params->get('layout_type') . '" />' . "\n\t";
		$meta .= '<meta property="og:url" content="' . $doc->base . '" />' . "\n\t";
		$meta .= '<meta property="og:locale" content="' . $this->language . '" />' . "\n\t";

		// Check if App ID is set
		if ( $app_id ) {
			$meta .= '<meta property="fb:app_id" content="' . $app_id . '" />' . "\n";
		}

		return $meta;
	}


	/*
	 * Method to get the metaset for apple touch icon
	 *
	 * @param     string    $title     Title of the current ( viewed ) page
	 * @param     string    $image     Full web path of an image from the current ( viewed ) page. If nothing is set, it try to load a standard image from template/img path (144x144px)
	 * @param     string    $app_id    Facebook Application ID
	 *
	 * @return    html
	 *
	 * @since     1.0
	 */
	function setMetaApple( $title = false, $image = false, $app_id = false ) {
		$doc = JFactory::getDocument();

		$meta = '';
		$meta .= '<link rel="apple-touch-icon" href="' . $doc->base . 'templates/' . $this->template . '/img/app-icon-apple.png"></link>' . "\n\t";

		return $meta;
	}


	/*
	 * Method to get the metaset for microsoft metro/IE
	 *
	 * @param     string    $title     Title of the current ( viewed ) page
	 * @param     string    $image     Full web path of an image from the current ( viewed ) page. If nothing is set, it try to load a standard image from template/img path (144x144px)
	 * @param     string    $app_id    Facebook Application ID
	 *
	 * @return    html
	 *
	 * @since     1.0
	 */
	function setMetaMicrosoft( $title = false, $image = false, $app_id = false ) {
		$doc = JFactory::getDocument();
		$config = JFactory::getConfig();
		$headdata = $doc->getHeadData();

		$param_title = $title ? $title : $headdata['title'];

		$meta = '';
		$meta .= '<meta name="Search.PageTitle" content="' . $param_title . '" />' . "\n\t";
		$meta .= '<meta name="Search.PageDescription" content="' . $config->get('MetaDesc') . '" />' . "\n\t";
		$meta .= '<meta name="msapplication-TileImage" content="' . $doc->base . 'templates/' . $this->template . '/img/app-icon-ms.png" />' . "\n\t";
		$meta .= '<meta name="msapplication-TileColor" content="#1A1A1A" />' . "\n\t";

		return $meta;
	}


	/*
	 * Method to get the metaset for twitter
	 *
	 * @param     string    $title     Title of the current ( viewed ) page
	 * @param     string    $image     Full web path of an image from the current ( viewed ) page. If nothing is set, it try to load a standard image from template/img path (144x144px)
	 * @param     string    $card    Facebook Application ID
	 * @param     string    $site    Twitter account name without @
	 *
	 * @return    html
	 *
	 * @since     1.0
	 */
	function setMetaTwitter( $title = false, $image = false, $card = 'summary', $site = false ) {
		$doc = JFactory::getDocument();
		$config = JFactory::getConfig();
		$headdata = $doc->getHeadData();

		$param_title = $title ? $title : $headdata['title'];

		$meta = '';
		$meta .= '<meta name="twitter:title" content="' . $param_title . '" />' . "\n\t";
		$meta .= '<meta name="twitter:image" content="' . $doc->base . 'templates/' . $this->template . '/img/app-icon-twitter.png" />' . "\n\t";
		$meta .= '<meta name="twitter:card" content="' . $card . '" />' . "\n\t";

		if ( $site ) {
			$meta .= '<meta name="twitter:site" content="@' . $site . '" />' . "\n\t";
		}

		return $meta;
	}


	/*
	 * Method to get the metaset for google
	 *
	 * @param     string    $title     Title of the current ( viewed ) page
	 * @param     string    $image     Full web path of an image from the current ( viewed ) page. If nothing is set, it try to load a standard image from template/img path (144x144px)
	 * @param     string    $card    Facebook Application ID
	 * @param     string    $site    Twitter account name without @
	 *
	 * @return    html
	 *
	 * @since     1.0
	 */
	function setMetaGoogle( $title = false, $image = false, $card = 'summary', $site = false ) {
		$doc = JFactory::getDocument();
		$config = JFactory::getConfig();
		$headdata = $doc->getHeadData();

		$param_title = $title ? $title : $headdata['title'];

		$meta = '';
		$meta .= '<meta name="twitter:title" content="' . $param_title . '" />' . "\n\t";
		$meta .= '<meta name="twitter:image" content="' . $doc->base . 'templates/' . $this->template . '/img/app-icon-google.png" />' . "\n\t";
		$meta .= '<meta name="twitter:card" content="' . $card . '" />' . "\n\t";

		if ( $site ) {
			$meta .= '<meta name="twitter:site" content="@' . $site . '" />' . "\n\t";
		}

		return $meta;
	}


	/*
	 * Method to get an extended metaset
	 *
	 * @param     string    $audience       For which group is this content / webpage? students, childrens, adults, frogs or maybe all? (Standard: all)
	 * @param     string    $pageTopic      A single word that describes the tobic of the page. If nothing is set, it will not be added to the meta-tags.
	 * @param     string    $abstraction    Up to 3 important tags as abstractor for the page
	 *
	 * @return    html
	 *
	 * @since     1.0
	 */
	function setMetaExtended( $audience = 'all', $pageTopic = false, $abstraction = 'devxive,mootombo,walz' ) {
		$meta = '';

		$meta .= '<meta name="audience" content="' . $audience . '" />' . "\n\t";

		if ( $pageTopic ) {
			$meta .= '<meta name="page-topic" content="' . $pageTopic . '">' . "\n\t";
		}

		$meta .= '<!-- ' . $abstraction . ' -->' . "\n\t";

		return $meta;
	}
}