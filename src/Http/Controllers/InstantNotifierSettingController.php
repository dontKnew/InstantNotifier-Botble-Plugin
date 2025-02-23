<?php

namespace Botble\InstantNotifier\Http\Controllers;

use Botble\Analytics\Forms\AnalyticsSettingForm;
use Botble\Analytics\Http\Requests\Settings\AnalyticsSettingRequest;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\InstantNotifier\Forms\InstantNotifierSettingForm;
use Botble\InstantNotifier\Http\Requests\InstantNotifierSettingsRequest;
use Botble\Setting\Http\Controllers\SettingController;

class InstantNotifierSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/instantnotifier::instantnotifier.settings.title'));

        return InstantNotifierSettingForm::create()->renderForm();
    }

    public function update(InstantNotifierSettingsRequest $request): BaseHttpResponse
    {
        return $this->performUpdate($request->validated());
    }
}
