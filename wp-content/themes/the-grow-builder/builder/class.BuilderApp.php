<?php 

class BuilderApp{
    
    function __construct()
    {
        $this->load_common_functions();
        $this->load_admin_files();
        $this->load_api_files();
        $this->load_frontend_files();
    }

    /**
     * Include common functions
     *
     * @return void
     */
    function load_common_functions(){
        include get_stylesheet_directory() . "/builder/class.CommonFunctions.php";
        include get_stylesheet_directory() . "/builder/frontend/classes/class.Manage.php";
        include get_stylesheet_directory() . "/builder/frontend/classes/class.APIManager.php";
    }

    /**
     * Include admin files
     *
     * @return void
     */
    function load_admin_files(){
        // include admin files
    }

    /**
     * Include api files
     *
     * @return void
     */
    function load_api_files(){
        include get_stylesheet_directory() . "/builder/api/class.APIRoutes.php";
    }

    /**
     * Include frontend files
     *
     * @return void
     */
    function load_frontend_files(){
        // include frontend files
    }
}

new BuilderApp();
?>