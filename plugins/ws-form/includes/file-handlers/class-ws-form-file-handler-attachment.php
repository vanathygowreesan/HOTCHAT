<?php

	class WS_Form_File_Handler_Attachment extends WS_Form_File_Handler {

		public $id = 'attachment';
		public $pro_required = false;
		public $label;
		public $public = true;

		public function __construct() {

			// Set label
			$this->label = __('Media Library', 'ws-form');

			// Register action
			parent::register($this);

			// Create intial file handler
			add_filter('wsf_file_handler_' . $this->id, array($this, 'handler'), 10, 5);
		}

		// Handler
		public function handler($file_objects, $submit, $field, $section_repeatable_index) {

			$form_id = $submit->form_id;
			$submit_hash = $submit->hash;

			// Check form ID
			WS_Form_Common::check_form_id($form_id);

			// Need to require these files
			if(!function_exists('media_handle_upload')) {

				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				require_once(ABSPATH . "wp-admin" . '/includes/file.php');
				require_once(ABSPATH . "wp-admin" . '/includes/media.php');
			}

			// Field ID
			$field_id = intval($field->id);
			if($field_id == 0) { parent::db_throw_error(__('Invalid field ID', 'ws-form')); }

			foreach($file_objects as $file_object_index => $file_object) {

				// Get file name
				if(!isset($file_object['name'])) { parent::db_throw_error(__('File name not found in file object', 'ws-form')); }
				$file_name = $file_object['name'];

				// Get file type
				if(!isset($file_object['type'])) { parent::db_throw_error(__('File type not found in file object', 'ws-form')); }
				$file_type = $file_object['type'];

				// Get file path
				if(!isset($file_object['path'])) { parent::db_throw_error(__('File source path not found in file object', 'ws-form')); }
				$file_path = $file_object['path'];

				// Get file size
				if(!isset($file_object['size'])) { parent::db_throw_error(__('File size not found in file object', 'ws-form')); }
				$file_size = $file_object['size'];

				// Get attachment ID
				$attachment_id = isset($file_object['attachment_id']) ? $file_object['attachment_id'] : false;

				// If attachment has not yet been handled, create attachment
				if($attachment_id === false) {

					// Build file array
					$file_single = array(

						'name'					=>	$file_name,
						'type'					=>	$file_type,
						'tmp_name'				=>	$file_path,
						'error'					=>	0,
						'size'					=>	$file_size,
					);

					$attachment_id = media_handle_sideload($file_single, 0);

					if(is_wp_error($attachment_id)) {

						$error_message = __('Error handling media upload', 'ws-form');

						if(
							isset($attachment_id->errors) &&
							isset($attachment_id->errors['upload_error']) &&
							isset($attachment_id->errors['upload_error'][0])
						) {

							$error_message = $attachment_id->errors['upload_error'][0];
						}

						parent::db_throw_error(

							sprintf(__('File handler error [%s]: %s', 'ws-form'), $this->id, $error_message)
						);
					}
				}

				// Add meta data
				update_post_meta($attachment_id, '_wsf_attachment_handler_' . $this->id, true);

				// Remove as scratch
				delete_post_meta($attachment_id, '_wsf_attachment_scratch');

				// Get file path full
				$file_path_full = get_attached_file($attachment_id);

				// Get file path
				$file_path = str_replace(wp_upload_dir()['basedir'] . '/', '', $file_path_full);

				// Set path
				$file_objects[$file_object_index]['path'] = $file_path;
				$file_objects[$file_object_index]['attachment_id'] = $attachment_id;
			}

			self::touch($file_objects);

			return $file_objects;
		}

		// Get URL
		public function get_url($file_object, $field_id = 0, $file_object_index = 0, $submit_hash = '') {

			// Ensure this file object belongs to this file handler
			if(!isset($file_object['handler']) || ($file_object['handler'] != $this->id)) { return false; }

			// Check attachment ID exists
			if(!isset($file_object['attachment_id'])) { return false; }

			return wp_get_attachment_url($file_object['attachment_id']);
		}

		// Get value for parse variables
		public function get_value_parse_variable($file_object, $field_id = 0, $file_object_index = 0, $submit_hash = '', $file_links = false, $file_embed = false, $content_type = 'text/html') {

			$value_array = array();

			if($content_type == 'text/plain') { $file_embed = false; }

			// Read file data
			$file_name = $file_object['name'];
			$file_size = WS_Form_Common::get_file_size($file_object['size']);
			$file_type = $file_object['type'];
			$file_path = $file_object['path'];

			$file_data = false;

			// File embed?
			if($file_embed) {

				$value_array[] = sprintf('<img src="%s" style="max-width: 100%%;" />', self::get_url($file_object, $field_id, $file_object_index, $submit_hash));
			}

			// File links?
			if($file_links) {

				$file_url = self::get_url($file_object, $field_id, $file_object_index, $submit_hash);

				$value_array[] = sprintf('<a href="%s" target="_blank">%s</a> (%s)', $file_url, $file_name, $file_size);

			} else {

				$value_array[] = sprintf('%s (%s)', $file_name, $file_size);
			}

			return implode((($content_type == 'text/html') ? '<br />' : "\n"), $value_array);
		}

		// Copy to file
		public function copy_to_temp_file($file_object, $temp_path = false) {

			// Ensure this file object belongs to this file handler
			if(!isset($file_object['handler']) || ($file_object['handler'] != $this->id)) { return false; }

			// Check attachment id
			if(!isset($file_object['attachment_id']) || ($file_object['attachment_id'] == '')) { return false; }
			$attachment_id = intval($file_object['attachment_id']);
			if(!$attachment_id) { return false; }

			// Check name
			if(!isset($file_object['name']) || ($file_object['name'] == '')) { return false; }
			$name = $file_object['name'];
			if(!$name) { return false; }

			// Get file path to copy from
			$file_path_copy_from = get_attached_file($attachment_id);
			if($file_path_copy_from === false) { return false; }

			// Check file exists
			if(!file_exists($file_path_copy_from)) { return false; }

			// Get file path to copy to
			require_once(ABSPATH . 'wp-admin/includes/file.php');

			if($temp_path === false) {

				$file_path_copy_to = wp_tempnam();

			} else {

				if(!file_exists($temp_path)) {

					wp_mkdir_p($temp_path);
				}

				if(!isset($file_object['name']) || ($file_object['name'] == '')) { return false; }

				$file_path_copy_to = $temp_path . '/' . $file_object['name'];
			}

			// Create temporary file
			return copy($file_path_copy_from, $file_path_copy_to) ? $file_path_copy_to : false;
		}

		// Get temp file
		public function get_temp_file($file_object, $temp_path = false) {

			// Ensure this file object belongs to this file handler
			if(!isset($file_object['handler']) || ($file_object['handler'] != $this->id)) { return false; }

			// Check attachment id
			if(!isset($file_object['attachment_id']) || ($file_object['attachment_id'] == '')) { return false; }
			$attachment_id = intval($file_object['attachment_id']);
			if(!$attachment_id) { return false; }

			return array(

				'path' 				=> get_attached_file($attachment_id),
				'unlink_after_use' 	=> false
			);
		}

		// Delete file
		public function delete($file_object) {

			// Ensure this file object belongs to this file handler
			if(!isset($file_object['handler']) || ($file_object['handler'] != $this->id)) { return false; }

			// Read attachment ID
			if(!isset($file_object['attachment_id'])) { return false; }
			$attachment_id = intval($file_object['attachment_id']);
			if(!$attachment_id) { return false; }

			// Ensure attachment_id was uploaded by this handler
			if(!get_post_meta($attachment_id, '_wsf_attachment_handler_' . $this->id, true)) { return false; }

			// Delete attachment
			wp_delete_attachment($attachment_id, true);

			return true;
		}
	}

	new WS_Form_File_Handler_Attachment();
