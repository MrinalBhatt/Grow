<?php

if (!class_exists("APIRoutes")) {

    class APIRoutes
    {
        protected $MessageBuilderAPI;

        public function __construct()
        {
            $this->load_api_files();

            add_action('rest_api_init', array($this, 'register_api_routes'));

            $this->MessageBuilderAPI           = new MessageBuilderAPI();
        }

        /**
         * Load all your api files
         *
         * @return void
         */
        function load_api_files()
        {
            include get_stylesheet_directory() . "/builder/api/class.MessageBuilderAPI.php";
        }

        /**
         * Register all API routes here
         *
         * @return void
         */
        function register_api_routes()
        {
            register_rest_route(
                CommonFunctions::API_NAMESPACE,
                'api name here',
                array(
                    'methods'  => 'GET',
                    'callback' => array($this->MessageBuilderAPI, 'function name here'),
                )
            );

            register_rest_route(
                CommonFunctions::API_NAMESPACE,
                'api name here',
                array(
                    'methods'  => 'POST',
                    'callback' => array($this->MessageBuilderAPI, 'function name here'),
                )
            );
        }
    }

    new APIRoutes();
}
