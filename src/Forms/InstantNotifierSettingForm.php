<?php

namespace Botble\InstantNotifier\Forms;

use Botble\Base\Forms\Fields\TextField;
use Botble\InstantNotifier\Http\Requests\InstantNotifierSettingsRequest;
use Botble\Setting\Forms\SettingForm;

class InstantNotifierSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        $this
            ->setSectionTitle(trans('plugins/instantnotifier::instantnotifier.settings.title'))
            ->setSectionDescription(trans('plugins/instantnotifier::instantnotifier.settings.description'))
            ->setFormOption('id', 'instant-notifier-settings')
            ->setValidatorClass(InstantNotifierSettingsRequest::class)
            ->setActionButtons(view('core/setting::forms.partials.action', ['form' => $this->getFormOption('id')])->render())
            ->add('instantnotifier_client_id', TextField::class, [
                'label' => "Client Id",
                'value' => setting('instantnotifier_client_id'),
                'attr' => [
                    'placeholder' => "Example : ngS8iLah6MU1QD3Oxo4J940IBJG2",
                    'data-counter' => 28,
                ],  
                'help_block' => [
                    'text' => sprintf(
                        "<a href='https://instantnotifier.phpmaster.in/thank-you' target='_blank'>%s</a>",
                        'To Get Client Id,  click here'
                    ),
                ],
            ])
            ->add('instantnotifier_api_key', TextField::class, [
                'label' => "API Key",
                'value' => setting('instantnotifier_api_key'),
                'attr' => [
                    'placeholder' => "Example : s9vIhA1se42tckQIOY2eOmWa99pSa31d",
                    'data-counter' => 32,
                ],
                'help_block' => [
                    'text' => sprintf(
                        "<a href='https://instantnotifier.phpmaster.in/pricing' target='_blank'>%s</a>",
                        'To Get API Key, click here'
                    ),
                ],
            ]);

    }
}
