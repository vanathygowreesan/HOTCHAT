<?php

	class WS_Form_Data_Source_Pods extends WS_Form_Data_Source {

		public $id = 'pods';
		public $pro_required = false;
		public $label;
		public $label_retrieving;
		public $records_per_page = 0;

		public function __construct() {

			// Set label
			$this->label = __('Pods Field Options', 'ws-form');

			// Set label retrieving
			$this->label_retrieving = __('Retrieving Pods field options...', 'ws-form');

			// Register action
			parent::register($this);

			// Register config filters
			add_filter('wsf_config_meta_keys', array($this, 'config_meta_keys'), 10, 2);

			// Register API endpoint
			add_action('rest_api_init', array($this, 'rest_api_init'), 10, 0);

			// Records per page
			$this->records_per_page = apply_filters('wsf_data_source_' . $this->id . '_records_per_age', $this->records_per_page);
		}

		// Get
		public function get($form_object, $field_id, $page, $meta_key, $meta_value, $no_paging = false, $api_request = false) {

			// Check meta key
			if(empty($meta_key)) { return self::error(__('No meta key specified', 'ws-form'), $field_id, $this, $api_request); }

			// Get meta key config
			$meta_keys = WS_Form_Config::get_meta_keys();
			if(!isset($meta_keys[$meta_key])) { return self::error(__('Unknown meta key', 'ws-form'), $field_id, $this, $api_request); }
			$meta_key_config = $meta_keys[$meta_key];

			// Check meta value
			if(
				!is_object($meta_value) ||
				!isset($meta_value->columns) ||
				!isset($meta_value->groups) ||
				!isset($meta_value->groups[0])
			) {

				if(!isset($meta_key_config['default'])) { return self::error(__('No default value', 'ws-form'), $field_id, $this, $api_request); }

				// If meta_value is invalid, create one from default
				$meta_value = json_decode(json_encode($meta_key_config['default']));
			}

			// Columns
			$meta_value->columns = array(

				(object) array('id' => 0, 'label' => __('Value', 'ws-form')),
				(object) array('id' => 1, 'label' => __('Label', 'ws-form'))
			);

			// Base meta
			$group = clone($meta_value->groups[0]);

			// Get Pods field key
			$pods_field_id = $this->{'data_source_' . $this->id . '_field_id'};

			// Get Pods field settings
			$pods_field_settings = WS_Form_Pods::pods_get_field_settings($pods_field_id);
			if($pods_field_settings === false) { return self::error(__('Invalid field ID', 'ws-form'), $field_id, $this, $api_request); }

			// Filter by post?
			$filter_by_options = false;
			$filter_by_post = $this->{'data_source_' . $this->id . '_filter_by_post'};
			if($filter_by_post) {

				// Get post ID
				$filter_by_post_id = $this->{'data_source_' . $this->id . '_filter_by_post_id'};
				if($filter_by_post_id == '') { $filter_by_post_id = '#post_id'; }
				$filter_by_post_id = intval(WS_Form_Common::parse_variables_process($filter_by_post_id, $form_object, false, 'text/plain'));

				if($filter_by_post_id > 0) {

					$filter_by_options = rwmb_get_value($pods_field_id, '', $filter_by_post_id);
					if(empty($filter_by_options)) { $filter_by_options = array(); }
					if(is_string($filter_by_options)) { $filter_by_options = array($filter_by_options); }
				}
			}

			// Get Pods field label
			$label = isset($pods_field_settings['label']) ? $pods_field_settings['label'] : $this->label;

			// Get Pods field pick_custom
			$pick_custom = isset($pods_field_settings['options']['pick_custom']) ? $pods_field_settings['options']['pick_custom'] : array();

			// Get choices
			$choices = array();

			$rows = explode("\n", $pick_custom);

			foreach($rows as $row) {

				$row = trim($row);

				if($row == '') { continue; }

				$columns = explode('|', $row);

				if(count($columns) === 1) {

					$choices[$columns[0]] = $columns[0];
				}

				if(count($columns) === 2) {

					$choices[$columns[0]] = $columns[1];
				}
			}

			// Run through choices
			$rows = array();
			$row_index = 1;
			foreach($choices as $value => $text) {

				// Filter by post?
				if($filter_by_options !== false) {

					if(!in_array($value, $filter_by_options)) { continue; }
				}

				if($this->{'data_source_' . $this->id . '_image_tag'}) {

					$text = sprintf('<img src="%s" alt="%s" />', esc_attr($text), esc_attr($value));
				}

				$rows[] = (object) array(

					'id'		=> $row_index++,
					'default'	=> '',
					'required'	=> '',
					'disabled'	=> '',
					'hidden'	=> '',
					'data'		=> array(

						$value,
						$text
					)
				);
			}

			// Build new group if one does not exist
			if(!isset($meta_value->groups[0])) {

				$meta_value->groups[0] = $group;
			}

			$meta_value->groups[0]->label = $label;

			// Rows
			$meta_value->groups[0]->rows = $rows;

			// Delete any old groups
			$group_index = 1;
			while(isset($meta_value->groups[$group_index])) {

				unset($meta_value->groups[$group_index++]);
			}

			// Column mapping
			$meta_keys = parent::get_column_mapping(array(), $meta_value, $meta_key_config);

			// Return data
			return array('error' => false, 'error_message' => '', 'meta_value' => $meta_value, 'max_num_pages' => 0, 'meta_keys' => $meta_keys);
		}

		// Get meta keys
		public function get_data_source_meta_keys() {

			return array(

				'data_source_' . $this->id . '_field_id',
				'data_source_' . $this->id . '_filter_by_post',
				'data_source_' . $this->id . '_filter_by_post_id',
				'data_source_' . $this->id . '_image_tag'
			);
		}

		// Get settings
		public function get_data_source_settings() {

			// Build settings
			$settings = array(

				'meta_keys' => self::get_data_source_meta_keys()
			);

			// Add retrieve button
			$settings['meta_keys'][] = 'data_source_' . $this->id . '_get';

			// Wrap settings so they will work with sidebar_html function in admin.js
			$settings = parent::get_settings_wrapper($settings);

			// Add label
			$settings->label = $this->label;

			// Add label retrieving
			$settings->label_retrieving = $this->label_retrieving;

			// Add API GET endpoint
			$settings->endpoint_get = 'data-source/' . $this->id . '/';

			// Apply filter
			$settings = apply_filters('wsf_data_source_' . $this->id . '_settings', $settings);

			return $settings;
		}

		// Meta keys for this action
		public function config_meta_keys($meta_keys = array(), $form_id = 0) {

			// Build config_meta_keys
			$config_meta_keys = array(

				// Pods Field
				'data_source_' . $this->id . '_field_id' => array(

					'label'						=>	__('Pods Field', 'ws-form'),
					'type'						=>	'select',
					'options'					=>	WS_Form_Pods::pods_get_fields_all(false, false, true, false, true),
					'options_blank'				=>	__('Select...', 'ws-form')
				),

				// Pods Filter by Post
				'data_source_' . $this->id . '_filter_by_post' => array(

					'label'						=>	__('Filter by Post', 'ws-form'),
					'type'						=>	'checkbox',
					'default'					=>	'',
					'help'						=>	__('Filter the options by those selected in a post.', 'ws-form'),
					'condition'					=>	array(

						array(

							'logic'				=>	'!=',
							'meta_key'			=>	'data_source_' . $this->id . '_field_id',
							'meta_value'		=>	''
						)
					)
				),

				// Pods Filter by Post ID
				'data_source_' . $this->id . '_filter_by_post_id' => array(

					'label'						=>	__('Post ID', 'ws-form'),
					'type'						=>	'text',
					'default'					=>	'',
					'placeholder'				=>	'#post_id',
					'help'						=>	sprintf(

						/* translators: %s = WS Form */
						__('Choose the post ID to filter by. This can be a number or %s variable. If blank, the ID of the post the form is shown on will be used.', 'ws-form'),

						WS_FORM_NAME_GENERIC
					),
					'condition'					=>	array(

						array(

							'logic'				=>	'!=',
							'meta_key'			=>	'data_source_' . $this->id . '_field_id',
							'meta_value'		=>	''
						),

						array(

							'logic_previous'	=>	'&&',
							'logic'				=>	'==',
							'meta_key'			=>	'data_source_' . $this->id . '_filter_by_post'
						)
					)
				),

				// Images - As Tags
				'data_source_' . $this->id . '_image_tag' => array(

					'label'						=>	__('Convert Labels to &lt;img&gt; Tags', 'ws-form'),
					'type'						=>	'checkbox',
					'default'					=>	''
				),

				// Get Data
				'data_source_' . $this->id . '_get' => array(

					'label'						=>	__('Get Data', 'ws-form'),
					'type'						=>	'button',
					'condition'					=>	array(

						array(

							'logic'				=>	'!=',
							'meta_key'			=>	'data_source_' . $this->id . '_field_id',
							'meta_value'		=>	''
						)
					),
					'key'						=>	'data_source_get'
				)
			);

			// Merge
			$meta_keys = array_merge($meta_keys, $config_meta_keys);

			return $meta_keys;
		}

		// Build REST API endpoints
		public function rest_api_init() {

			// Get data source
			register_rest_route(WS_FORM_RESTFUL_NAMESPACE, '/data-source/' . $this->id . '/', array('methods' => 'POST', 'callback' => array($this, 'api_post'), 'permission_callback' => function () { return WS_Form_Common::can_user('edit_form'); }));
		}

		// api_post
		public function api_post() {

			// Get meta keys
			$meta_keys = self::get_data_source_meta_keys();

			// Read settings
			foreach($meta_keys as $meta_key) {

				$this->{$meta_key} = WS_Form_Common::get_query_var($meta_key, false);
				if(
					is_object($this->{$meta_key}) ||
					is_array($this->{$meta_key})
				) {

					$this->{$meta_key} = json_decode(json_encode($this->{$meta_key}));
				}
			}

			// Get field ID
			$field_id = WS_Form_Common::get_query_var('field_id', 0);

			// Get page
			$page = intval(WS_Form_Common::get_query_var('page', 1));

			// Get meta key
			$meta_key = WS_Form_Common::get_query_var('meta_key', 0);

			// Get meta value
			$meta_value = WS_Form_Common::get_query_var('meta_value', 0);

			// Get return data
			$get_return = self::get(false, $field_id, $page, $meta_key, $meta_value, false, true);

			// Error checking
			if($get_return['error']) {

				// Error
				return self::api_error($get_return);

			} else {

				// Success
				return $get_return;
			}
		}
	}

	new WS_Form_Data_Source_Pods();
