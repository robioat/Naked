<?php
/**
 * Contains post elements options for the header
 */

/** Dont run without Unyson plugin **/
if (!defined('FW')) die('Forbidden');

$options = array(

	'opt_header_show_search' =>array(
		'type'  => 'switch',
		'value' => 'Show',
		'label' => __('Show Search Box in Header', 'thshpr'),
		'help' => __( 'This will display the search box in the header', 'thshpr'  ),
		'left-choice' => array(
			'value' => '1',
			'label' => __('Show', 'thshpr'),
		),
		'right-choice' => array(
			'value' => '0',
			'label' => __('Hide', 'thshpr'),
		),
	),

	'opt_header_show_social' =>array(
		'type'  => 'switch',
		'value' => 'Show',
		'label' => __('Show Social media Icons in Header', 'thshpr'),
		'help' => __( 'This will display the social media icons in the header', 'thshpr'  ),
		'left-choice' => array(
			'value' => '1',
			'label' => __('Show', 'thshpr'),
		),
		'right-choice' => array(
			'value' => '0',
			'label' => __('Hide', 'thshpr'),
		),
	),




);