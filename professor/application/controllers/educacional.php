<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of educacional
 *
 * @author Karol Oliveira
 */
class educacional extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

   
}
?>
