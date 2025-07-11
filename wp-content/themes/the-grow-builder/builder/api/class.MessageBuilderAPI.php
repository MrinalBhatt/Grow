<?php

if (!class_exists("MessageBuilderAPI")) {

    class MessageBuilderAPI
    {
        public $commonFunctions;

        public function __construct()
        {
            $this->commonFunctions = new CommonFunctions();
        }

        /**
         * Describe your function in this line
         *
         * @param object $request
         * @return object
         */
        public function funtionNameHere($request) {
            $userId = 1;
            $params = $request->get_params();

            // write your code

             // Insert api logs
             $apiName        = 'your api name here';
             $apiLogRequest  = json_encode($params);
             $apiLogResponse = '';
             $apiLogUserId   = $userId;
 
             $this->commonFunctions->ApiLogs($apiName, $apiLogRequest, $apiLogResponse, $apiLogUserId);
 
             return new WP_REST_Response([
                 'IsSuccess' => $this->commonFunctions->apiResponse()['ValidResponse']['IsSuccess'],
                 'Message'   => 'Api return msg here',
                 'Data'      => $this->commonFunctions->apiResponse()['EmptyData'],
             ]);
        }
    }

    new MessageBuilderAPI();
}
