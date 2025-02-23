<?php

return [
    [
        'name' => 'Instant Notifiers',
        'flag' => 'instantnotifier.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'instantnotifier.create',
        'parent_flag' => 'instantnotifier.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'instantnotifier.edit',
        'parent_flag' => 'instantnotifier.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'instantnotifier.destroy',
        'parent_flag' => 'instantnotifier.index',
    ],
];
