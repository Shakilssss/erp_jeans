<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Debug Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Yura Loginov
 * @link		https://github.com/yuraloginoff/codeigniter-debug-helper.git
 */

// ------------------------------------------------------------------------

/**
 * Readable var_dump
 *
 * Readable dump information about a variable
 *
 * @access	public
 * @param	mixed * 
 */
if ( ! function_exists('vardump'))
{
	function vardump($var)
	{
		$CI =& get_instance();
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}

if ( ! function_exists('dd'))   
{
	function dd($var)
	{
		$CI =& get_instance();
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        exit;
	}
}


/* End of file debug_helper.php */
/* Location: ./application/helpers/debug_helper.php */