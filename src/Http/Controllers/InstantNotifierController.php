<?php

namespace Botble\InstantNotifier\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\InstantNotifier\Http\Requests\InstantNotifierRequest;
use Botble\InstantNotifier\Models\InstantNotifier;
use Botble\Base\Http\Controllers\BaseController;
use Botble\InstantNotifier\Tables\InstantNotifierTable;
use Botble\InstantNotifier\Forms\InstantNotifierForm;

class InstantNotifierController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/instantnotifier::instantnotifier.name')), route('instantnotifier.index'));
    }

    public function index(InstantNotifierTable $table)
    {
        $this->pageTitle(trans('plugins/instantnotifier::instantnotifier.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/instantnotifier::instantnotifier.create'));

        return InstantNotifierForm::create()->renderForm();
    }

    public function store(InstantNotifierRequest $request)
    {
        $form = InstantNotifierForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('instantnotifier.index'))
            ->setNextUrl(route('instantnotifier.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(InstantNotifier $instantNotifier)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $instantNotifier->name]));

        return InstantNotifierForm::createFromModel($instantNotifier)->renderForm();
    }

    public function update(InstantNotifier $instantNotifier, InstantNotifierRequest $request)
    {
        InstantNotifierForm::createFromModel($instantNotifier)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('instantnotifier.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(InstantNotifier $instantNotifier)
    {
        return DeleteResourceAction::make($instantNotifier);
    }
}
