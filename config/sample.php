<?php

return [
	'oauth2' => [
		'clientId' => '',
		'clientSecret' => '',
	],
	'options' => [
		'scope' => ['openid email profile offline_access accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
	],
    'tokenProcessor' => '\LantosBro\OAuth2\Support\AuthorisationProcessor',
    'tokenModel' => '\LantosBro\OAuth2\Support\FileToken',
	'authorisedRedirect' => '',
	'failedRedirect' => '',
];
