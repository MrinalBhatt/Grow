<?php

if (!class_exists("CommonFunctions")) {

    class CommonFunctions
    {
        const API_NAMESPACE = "builderapp";

        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'gbEnqueueAdminScripts'));
            add_action('wp_enqueue_scripts', array($this, 'gbEnqueueWebScripts'));
        }

        /**
         * API response data
         *
         * @return array
         */
        public function apiResponse()
        {
            return [
                'EmptyData'          => new \stdClass(),
                'InvalidToken'       => [
                    'IsSuccess'  => false,
                    'StatusCode' => 401,
                    'Message'    => 'Access Token Invalid',
                ],
                'ValidResponse'      => [
                    'IsSuccess' => true,
                ],
                'InvalidResponse'    => [
                    'IsSuccess'  => false,
                    'StatusCode' => 402,
                ],
                'InvalidInviteCode'  => [
                    'IsSuccess'  => false,
                    'StatusCode' => 403,
                    'Message'    => 'Incorrect invite code',
                ],
                'InvalidSocialLogin' => [
                    'IsSuccess'  => false,
                    'StatusCode' => 404,
                    'Message'    => 'This user does not exist',
                ],
                'ExistFilter'        => [
                    'IsSuccess'  => false,
                    'StatusCode' => 405,
                    'Message'    => 'This filter is already exist',
                ],
            ];
        }

        /**
         * Enqueue admin scripts and styles
         *
         * @return void
         */
        public function gbEnqueueAdminScripts()
        {
            wp_enqueue_style('admin-builder-style', get_stylesheet_directory_uri() . "/builder/assets/css/admin/admin-styles.css");
            wp_enqueue_script('admin-builder-js', get_stylesheet_directory_uri() . "/builder/assets/js/admin/admin-scripts.js", array('jquery'), '', true);
        }

        /**
         * Enqueue web scripts
         *
         * @return void
         */
        public function gbEnqueueWebScripts()
        {
            $messages = APIManager::messageArray;
            $messages['ajaxurl'] = admin_url('admin-ajax.php');
            $messages['siteurl'] = site_url();

            wp_enqueue_style('builder-app-style', get_stylesheet_directory_uri() . "/builder/assets/css/frontend/builder-app.css");
            wp_enqueue_script('builder-common-js', get_stylesheet_directory_uri() . "/builder/assets/js/frontend/common.js", array('jquery'), '', true);
            

            wp_localize_script('builder-common-js','jsMsg',$messages);
        }


        /**
         * Upload Image
         *
         * @return integer
         */
        function UploadImage($file_handler)
        {
            // These files need to be included as dependencies when on the front end.
            require_once ABSPATH . "wp-admin" . '/includes/image.php';
            require_once ABSPATH . "wp-admin" . '/includes/file.php';
            require_once ABSPATH . "wp-admin" . '/includes/media.php';

            $upload_overrides = array('test_form' => false);

            $attachment_id = 0;

            $movefile = wp_handle_upload($file_handler, $upload_overrides);

            if (isset($file_handler) && !empty($file_handler)) {
                if ($movefile && !isset($movefile['error'])) {
                    $filename = $movefile['file'];
                    $fname    = basename($filename);

                    $attachment = array(
                        'post_mime_type' => $movefile['type'],
                        'post_title'     => preg_replace('/\.[^.]+$/', '', $fname),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    $attachment_id   = wp_insert_attachment($attachment, $movefile['url']);
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                    $uploaddir = wp_upload_dir();
                    $dir       = ltrim($uploaddir['subdir'], '/');
                    update_post_meta($attachment_id, '_wp_attached_file', $dir . "/" . $fname);
                }
            }

            if (is_wp_error($attachment_id)) {
                return false;
            }

            return $attachment_id;
        }

        /**
         * Upload Video thumbnail
         *
         * @return string
         */
        function UploadVideoThumbnail($file_handler, $video_file_id)
        {
            // These files need to be included as dependencies when on the front end.
            require_once ABSPATH . "wp-admin" . '/includes/image.php';
            require_once ABSPATH . "wp-admin" . '/includes/file.php';
            require_once ABSPATH . "wp-admin" . '/includes/media.php';

            $upload_overrides = array('test_form' => false);

            $attachment_id = 0;

            $movefile = wp_handle_upload($file_handler, $upload_overrides);

            if (isset($file_handler) && !empty($file_handler)) {
                if ($movefile && !isset($movefile['error'])) {
                    $filename = $movefile['file'];
                    $fname    = basename($filename);

                    $attachment = array(
                        'post_mime_type' => $movefile['type'],
                        'post_title'     => preg_replace('/\.[^.]+$/', '', $fname),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    );

                    $attachment_id   = wp_insert_attachment($attachment, $movefile['url']);
                    $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
                    wp_update_attachment_metadata($attachment_id, $attachment_data);
                    $uploaddir = wp_upload_dir();
                    $dir       = ltrim($uploaddir['subdir'], '/');
                    update_post_meta($attachment_id, '_wp_attached_file', $dir . "/" . $fname);
                }
            }

            if (is_wp_error($attachment_id)) {
                return false;
            }

            set_post_thumbnail($video_file_id, $attachment_id);

            return $attachment_id;
        }

        /**
         * Upload Image link
         *
         * @return string
         */
        public function UploadImageLink($string)
        {
            $fileResponseLink = $string;
            return $fileResponseLink;
        }

      
        /**
         * Insert API Logs
         *
         * @return string
         */
        public function ApiLogs($apiName, $apiLogRequest, $apiLogResponse, $apiLogUserId, $apiLogAppVersion = NULL, $apiLogModel = NULL, $apiLogOs = NULL)
        {
            global $wpdb;

            // Insert data in api_logs table
            $wpdb->insert(
                $wpdb->prefix . 'api_logs',
                array(
                    'api_name'    => $apiName,
                    'request'     => $apiLogRequest,
                    'response'    => $apiLogResponse,
                    'user_id'     => $apiLogUserId,
                    'app_version' => $apiLogAppVersion,
                    'model'       => $apiLogModel,
                    'os'          => $apiLogOs,
                )
            );
        }

    }

    new CommonFunctions();
}
