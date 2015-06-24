<?php

$socials = array(

	'socials'  => array(

		'general-options' => array(
			'title' => __( 'Social Network Options', 'yith-wcet' ),
			'type' => 'title',
			'desc' => '',
			'id' => 'yith-wcet-socials-options'
		),

		'facebook' => array(
			'id'        => 'yith-wcet-facebook',
			'name'      => __( 'Facebook Page URL', 'yith-wcet' ),
			'type'      => 'text',
			'desc'      => __( 'Enter your Facebook page URL', 'yith-wcet' ),
		),

		'twitter' => array(
			'id'        => 'yith-wcet-twitter',
			'name'      => __( 'Twitter Profile URL', 'yith-wcet' ),
			'type'      => 'text',
			'desc'      => __( 'Enter your Twitter profile URL', 'yith-wcet' ),
		),

		'google' => array(
			'id'        => 'yith-wcet-google',
			'name'      => __( 'Google+ Profile URL', 'yith-wcet' ),
			'type'      => 'text',
			'desc'      => __( 'Enter your Google+ profile URL', 'yith-wcet' ),
		),

		'general-options-end' => array(
			'type'      => 'sectionend',
			'id'        => 'yith-wcet-socials-options'
		)

	)
);

return $socials;