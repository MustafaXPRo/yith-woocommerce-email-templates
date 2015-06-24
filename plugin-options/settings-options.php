<?php

$settings = array(

	'settings'  => array(

		'general-options' => array(
			'title' => __( 'General Options', 'yith-wcet' ),
			'type' => 'title',
			'desc' => '',
			'id' => 'yith-wcet-general-options'
		),

		'custom-default-header-logo' => array(
			'id'        => 'yith-wcet-custom-default-header-logo',
			'name'      => __( 'Default Logo', 'yith-wcet' ),
			'type'      => 'yith_wcet_upload',
			'desc'      => __( 'Upload your custom default logo', 'yith-wcet' ),
		),

		'general-options-end' => array(
			'type'      => 'sectionend',
			'id'        => 'yith-wcqv-general-options'
		)

	)
);

return apply_filters( 'yith_wcet_panel_settings_options', $settings );