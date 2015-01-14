<?php  
/**
 * Layout Class
 *
 * @package	libraries
 * @category	extended library
 * @author	Batou
 * @link	
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
	/**
	 * Variable constructor
	 *
	 * $obj		a reference to access the native resources of code igniter
	 * $layout	the current loaded layout, by default loads the file layout_main
	 */

	var $obj;
    var $layout;
    
	/**
	 * Initializes the class params
	 *
	 * @access	public
	 * @param	array (this is for the purpose to add more params in further development)
	 			var layout:	a string with the relative route to the layout view to be loaded
	 */
    function Layout( $params )
    {
        //note that we're passing the get_instance function by reference, this can fail if you're using php 4
		//to solve this just simple avoid calling get_instance() from within your class constructor
		$this->obj =&get_instance();
        $this->layout = $params['layout'];
    }
	
	/**
	 * Set the current layout to be loaded
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
    function setLayout( $layout )
    {
      $this->layout = $layout;
    }
    
	/**
	 * Loads the view within the current selected layout
	 *
	 * @access	public
	 * @param	var view:   the view to be loaded
	 			var data:   an array with the data associated to the view
				var return: a boolean true = output view content, false = load the desired view
	 * @return	string
	 */
    function view( $view, $data = null, $return = false )
    {
		//lets retrieve the content of the lodaded view, this var will be used inside the layout view to load the specific view inside the main layout view
        $data['content_for_layout'] = $this->obj->load->view( $view, $data, true );
        
		//return true, then lets print out all the view content
        if( $return )
        {
            $output = $this->obj->load->view( $this->layout, $data, true );
            return $output;
        }
		
		//return false, lets load the desired view using native functions of codeigniter
        else
        {
            $this->obj->load->view( $this->layout, $data, false );
        }
    }
}
?>