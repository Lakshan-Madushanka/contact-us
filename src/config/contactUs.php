<?php

return [
    // include role names to send the email
    'roles' => ['admin', 'super_admin'],

    // you can change email contain column below
    'email_column' => 'email',

    // you can change name contain column below
    'name_column' => 'name',

    /*
     include relationship name
    to obtain roles if roles are
    in seperate table other than user
     */

    'relationship' => 'roles',

    // you can change role table column name below

    'role_column_name' => 'name',

    /* define list of emails if
    need to send particular users
     */

    'users' => [
            //'exampl@text.com' => 'name'
        ]

];