<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------
 
/**
 * Fix-ee Accessory
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Accessory
 * @author		Trevor Davis
 * @link		http://trevordavis.net
 */
 
class Fixee_acc {
	
	public $name			= 'Fix-ee';
	public $id				= 'fixee';
	public $version			= '1.0';
	public $description		= 'Defaults the custom field formatting type to "None", and switches "Automatically turn URLs and email addresses into links?" to "No".';
	public $sections		= array();
	
	/**
	 * Set Sections
	 */
	public function set_sections()
	{
		$EE =& get_instance();
		$additionalJS = '';
		
		//Set formatting type for NEW custom fields
		if($EE->input->get('C') === 'admin_content' && $EE->input->get('M') === 'field_edit') {
			$field_id = $EE->input->get('field_id');
			
			if($field_id == '') {
				$additionalJS = "$('#text_field_fmt,#textarea_field_fmt').val('none');";
			}
		}
		
		//NEVER turn URLs and email addresses into links
		if($EE->input->get('C') === 'admin_content' && $EE->input->get('M') === 'channel_edit') {
			$additionalJS = "$('#channel_auto_link_urls_n').attr('checked','checked');";
		}
		
		//If there is additional JS, add it
		if($additionalJS !== '') {
			$EE->cp->add_to_head('<script type="text/javascript">$(document).ready(function() { ' . $additionalJS . '});</script>');
		}
		
		//Remove the tab
		$this->sections[] = '<script type="text/javascript">$("#accessoryTabs a.fixee").parent().remove();</script>';
		
	}
	
	// ----------------------------------------------------------------
	
}
 
/* End of file acc.simple_preview.php */
/* Location: /system/expressionengine/third_party/fixee/acc.fixee.php */