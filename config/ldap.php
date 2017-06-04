<?php

return [
	'class'=>'Edvlerblog\Ldap',
	'options'=> [
	        'ad_port'      => 389,
	        'domain_controllers'    => array( '127.0.0.1', '127.0.0.1' ),
	        'account_suffix' =>  '',
	        'base_dn' => "dc=poli,dc=edu,dc=co",
	        // for basic functionality this could be a standard, non privileged domain user (required)
	        'admin_username' => 'cn=admin,dc=poli,dc=edu,dc=co',
	        'admin_password' => 'ldapQapassw0rd'
	    ],
	    //Connect on Adldap instance creation (default). If you don't want to set password via main.php you can
	    //set autoConnect => false and set the admin_username and admin_password with
	//\Yii::$app->ldap->connect('admin_username', 'admin_password');
	//See function connect() in https://github.com/Adldap2/Adldap2/blob/v5.2/src/Adldap.php

	'autoConnect' => true
];
