<?php

namespace Botble\InstantNotifier\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class InstantNotifierSettingsRequest extends Request
{
    public function rules(): array
    {
        return [
            'instantnotifier_client_id' => ['required', 'string', 'min:28', 'max:28'],
            'instantnotifier_api_key' => ['required', 'string', 'min:28'],
        ];
    }
}
