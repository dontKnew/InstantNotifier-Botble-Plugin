<?php

namespace Botble\InstantNotifier\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

class InstantNotifier extends BaseModel
{
    protected $table = 'instant_notifiers';

    protected $fillable = [
        'name',
        'message',
        'message_type',
        'message_status',
        'response',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];
}
