<?php

namespace Botble\InstantNotifier\Forms;

use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\InstantNotifier\Http\Requests\InstantNotifierRequest;
use Botble\InstantNotifier\Models\InstantNotifier;

class InstantNotifierForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(InstantNotifier::class)
            ->setValidatorClass(InstantNotifierRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required()->toArray())
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->setBreakFieldPoint('status');
    }
}
