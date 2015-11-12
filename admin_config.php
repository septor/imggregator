<?php
/*
 * Imggregator - An image aggregator for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
require_once('../../class2.php');
if (!getperms('P'))
{
	header('location:'.e_BASE.'index.php');
	exit;
}

class imggregator_adminArea extends e_admin_dispatcher
{
	protected $modes = array(
		'main'	=> array(
			'controller' 	=> 'hooks_ui',
			'path' 			=> null,
			'ui' 			=> 'hooks_form_ui',
			'uipath' 		=> null
		),
	);

	protected $adminMenu = array(
		'main/list'			=> array('caption'=> 'Manage Hooks', 'perm' => 'P'),
		'main/create'		=> array('caption'=> 'Create New Hook', 'perm' => 'P'),
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
		//'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'Imggregator';
}

class hooks_ui extends e_admin_ui
{
	protected $pluginTitle		= 'Imggregator';
	protected $pluginName		= 'imggregator';
	//	protected $eventName		= 'imggregator-hooks'; // remove comment to enable event triggers in admin.
	protected $table			= 'hooks';
	protected $pid				= 'hook_id';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	//	protected $batchCopy		= true;
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable.

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder		= 'hook_id DESC';

	protected $fields = array (
		'checkboxes' =>  array (
			'title' => '',
			'type' => null,
			'data' => null,
			'width' => '5%',
			'thclass' => 'center',
			'forced' => '1',
			'class' => 'center',
			'toggle' => 'e-multiselect',
		),
		'hook_id' => array (
			'title' => LAN_ID,
			'data' => 'int',
			'width' => '5%',
			'help' => '',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'hook_name' => array (
			'title' => 'Hook Name',
			'type' => 'dropdown',
			'data' => 'str',
			'width' => 'auto',
			'inline' => true,
			'help' => '',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'hook_tokens' => array (
			'title' => 'Hook Tokens',
			'type' => 'textarea',
			'data' => 'str',
			'width' => 'auto',
			'inline' => true,
			'help' => 'More information on what each Hook requires can be found on the Wiki!',
			'readParms' => '',
			'writeParms' => '',
			'class' => 'left',
			'thclass' => 'left',
		),
		'options' => array (
			'title' => LAN_OPTIONS,
			'type' => null,
			'data' => null,
			'width' => '10%',
			'thclass' => 'center last',
			'class' => 'center last',
			'forced' => '1',
		),
	);

	protected $fieldpref = array('hook_name', 'hook_tokens');


	//	protected $preftabs        = array('General', 'Other' );
	protected $prefs = array(
		'imagesToDisplay' => array(
			'title' => 'Images To Display',
			'tab' => 0,
			'type' => 'number',
			'data' => 'str',
			'help' => 'The number of images you want displayed.'
		),
		'imageSize'	=> array(
			'title' => 'Image Size',
			'tab' => 0,
			'type' => 'text',
			'data' => 'str',
			'help' => 'The size, in WIDTHxHEIGHT, you want your images to be.'
		),
	);

	public function init()
	{
		$this->hooks = array(
			'instagram' => 'Instagram',
		);
		$this->fields['hook_name']['writeParms'] = $this->hooks;
	}

	// ------- Customize Create --------
	public function beforeCreate($new_data)
	{
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onCreateError($new_data, $old_data)
	{
		// do something
	}

	// ------- Customize Update --------
	public function beforeUpdate($new_data, $old_data, $id)
	{
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
		// do something
	}

		/*
		// optional - a custom page.
		public function customPage()
		{
			$text = 'Hello World!';
			return $text;

		}
		 */
}

class hooks_form_ui extends e_admin_form_ui
{
}

new imggregator_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
?>
