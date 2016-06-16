<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'opt_post_options' => array(
		'type' => 'box',
		'title' => __('Post Options', 'thshpr'),
		'options' => array(

			'opt_post_template_picker' => array(
			    'type'  => 'multi-picker',
			    'label' => false,
			    'desc'  => false,
			    'value' => array(
			        'template' => '1',
			    ),
			    'picker' => array(
			        // '<custom-key>' => option
			        'template' => array(
			            'label'   => __('Choose post template', 'fw'),
			            'type'    => 'select', // or 'short-select'
			            'choices' => array(
			                '1'  => __('1', 'fw'),
			                '2' => __('2', 'fw')
			            ),
			            'desc'    => __('Description', 'fw'),
			            'help'    => __('Help tip', 'fw'),
			        )
			    ),

			    'choices' => array(
			        '1' => array(

						'general_options_box' => array(
					    	'type' => 'tab',
							'title' => __('General Options', 'thshpr'),
					    	'options' => array(
								'opt_subtitle' => array(
									'label' => __( 'Sub Title', 'thshpr' ),
									'type'  => 'textarea',
									'value' => '',
									'desc'  => __( 'An optional field that can be displayed providing more information about the post', 'thshpr' ),
									'help' =>__( 'Leave empty to not display. Will only be displayed if this is added in Appearance->Customize->Posts->Post Title Options->Add Title Elements', 'thshpr'  ),
								),
								'opt_show_progress_indicator' =>array(
									'type'  => 'switch',
									'value' => 'Show',
									'label' => __('Show Article Progress Indicator', 'thshpr'),
									'help' => __( 'This will display a thin bar which reveals the progress of the article being read by the user', 'thshpr'  ),
									'left-choice' => array(
										'value' => '1',
										'label' => __('Show', 'thshpr'),
									),
									'right-choice' => array(
										'value' => '0',
										'label' => __('Hide', 'thshpr'),
									),
								),
							),
						),

						'fullscreen_header_image_box' => array(
					    	'type' => 'tab',
							'title' => __('Full Width Header Image', 'thshpr'),
					    	'options' => array(
								'opt_header_show_image' =>array(
									'type'  => 'switch',
									'value' => 'Hide',
									'label' => __('Show Full Width Header Image', 'thshpr'),
									'desc'  => __('Show the full width header image', 'thshpr'),
									'left-choice' => array(
										'value' => '1',
										'label' => __('Show', 'thshpr'),
									),
									'right-choice' => array(
										'value' => '0',
										'label' => __('Hide', 'thshpr'),
									),
								),
								'opt_header_shift_title' =>array(
									'type'  => 'switch',
									'value' => 'Offset',
									'label' => __('Offset the title upwards', 'thshpr'),
									'desc'  => __('Offsets the title upwards to slightly overlay the full width header image', 'thshpr'),
									'left-choice' => array(
										'value' => '1',
										'label' => __('Offset', 'thshpr'),
									),
									'right-choice' => array(
										'value' => '0',
										'label' => __('Normal', 'thshpr'),
									),
								),
					        	fw()->theme->get_options('background-shared-options'),
								'opt_header_image_height' => array(
									'label' => __( 'Header Image Area Height', 'thshpr' ),
									'type'  => 'text',
									'value' => '200',
									'desc'  => __( 'Enter the height of the header image area height in pixels', 'thshpr' ),
									'help' =>__( 'This needs to be smaller than the image height. Because this is applied as a background image scaling will be used.', 'thshpr'  ),
								),
							),
						),

			        ),
			        '2' => array(
			            'price' => array(
			                'type'  => 'text',
			                'label' => __('Price', 'fw'),
			            ),
			            'webcam' => array(
			                'type'  => 'switch',
			                'label' => __('Webcam', 'fw'),
			            )
			        ),
			    ),
			    /**
			     * (optional) if is true, the borders between choice options will be shown
			     */
			    'show_borders' => false,
			),










		),
	),
);
