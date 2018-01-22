<?php
/**
 * @package		Komento
 * @copyright	Copyright (C) 2012 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Komento is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access');

require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'parent.php' );

class KomentoTableMailq extends KomentoParentTable
{
	var $id			= null;
	var $mailfrom	= null;
	var $fromname	= null;
	var $recipient	= null;
	var $subject	= null;
	var $body		= null;
	var $created	= null;
	var $type		= null;
	var $status		= null;

	public function __construct( &$db )
	{
		parent::__construct( '#__komento_mailq' , 'id' , $db );
	}
}