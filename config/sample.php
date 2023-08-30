<?php

return [
	'oauth2' => [
		'clientId' => '',
		'clientSecret' => '',
        'redirectUri' => route('oauth2.callback', ['integration' => 'sample']),
        'pkceMethod' => \LantosBro\OAuth2\Connection::PKCE_METHOD_S256,
        'urlAuthorize' => '',
        'urlAccessToken' => '',
        'urlResourceOwnerDetails' => '',
	],
	'options' => [
		'scope' => ['openid email profile offline_access accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
	],
    'tokenProcessor' => '\LantosBro\OAuth2\Support\AuthorisationProcessor',
    'tokenModel' => '\LantosBro\OAuth2\Support\FileToken',
	'authorisedRedirect' => '',
	'failedRedirect' => '',
];
