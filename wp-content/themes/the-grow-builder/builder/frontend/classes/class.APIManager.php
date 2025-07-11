<?php

if (!class_exists("APIManager")) {

    class APIManager {
        public $Manage;

        const BaseURL = "http://localhost/builderapp/wp-json/builderapp/";

        // google keys
        const GOOGLE_CLIENT_ID     = "716025080972-4j8m43tr8gvv1gn956m3o6fij6voctki.apps.googleusercontent.com";
        const GOOGLE_CLIENT_SECRET = "JNvxOofp4TiOmdAatRtBueK4";

        // facebook keys

        const FACEBOOK_APP_ID     = "571954536866411";
        const FACEBOOK_APP_SECRET = "3e68157cda788ab761cb8ac89e9337f3";

        // User API
        const getConfiguration     = APIManager::BaseURL . "getConfiguration";
        

        // Keys
        const KeyFirstName       = "FirstName";
        
        // message array
        const messageArray = [
            'FirstNameRequired'       => "Please enter first name.",
        ];

        // Session variables
        const errorMessage      = "errorMessage";
        const successMessage    = "successMessage";
        const infoMessage       = "infoMessage";
        const warningMessage    = "warningMessage";

        // default message
        const somethingWentWrong = "Something went wrong.";
        const fileUploadError    = "Error while uploading a file";
        const fileUploadSuccess  = "File uploaded successfully";
        const noDataFound        = "No data found.";
        const comingSoon         = "Coming Soon";

        public function __construct() {
            $this->Manage = new Manage();

            add_action('init', array($this, 'gbStartSession'), 1);
        }

        /**
         * Start session
         *
         * @return void
         */
        public function gbStartSession() {
            if (!session_id()) {
                session_start();
            }
        }

        /**
         * API call function
         *
         * @param string $method
         * @param string $api
         * @param array $header
         * @param array $params
         * @return object
         */
        public function ggAPICall($method, $api, $header = [], $params = []) {
            $finalResponse = new \stdClass;

            if ($method == "GET") {
                $argsGet = [
                    'headers' => $header,
                ];

                $response = wp_remote_get($api, $argsGet);
            } else if ($method == "POST") {
                $argsPost = [
                    'body'    => $params,
                    'headers' => $header,
                ];

                $response = wp_remote_post($api, $argsPost);
            }

            $body = wp_remote_retrieve_body($response);
            $body = json_decode($body);

            if ($body->IsSuccess) {
                $finalResponse = $body;
            } else {
                switch ($response['response']['code']) {
                case 401:
                    // $finalResponse = $body;
                    // break;
                    wp_logout();
                case 402:
                    $finalResponse = $body;
                    break;
                default:
                    $finalResponse = $body;
                }
            }

            $finalResponse->statusCode = $response['response']['code'];
            return $finalResponse;
        }
    }

    new APIManager();
}
