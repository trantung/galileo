<?php

return array(

    'multi' => array(
        'admin' => array(
            'driver' => 'eloquent',
            'model' => 'Admin'
        ),
        'partner' => array(
            'driver' => 'eloquent',
            'model' => 'Partner'
        ),
        'user' => array(
            'driver' => 'eloquent',
            'table' => 'users'
        )
    ),

    'reminder' => array(

        'email' => 'emails.auth.reminder',

        'table' => 'password_reminders',

        'expire' => 60,

    ),

);
