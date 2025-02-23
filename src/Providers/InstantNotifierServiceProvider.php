<?php

namespace Botble\InstantNotifier\Providers;


use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Facades\DashboardMenu;

use Botble\InstantNotifier\Models\InstantNotifier;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Setting\PanelSections\SettingOthersPanelSection;

class InstantNotifierServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/instantnotifier')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();
            
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(InstantNotifier::class, [
                    'name',
                ]);
            }
            
            DashboardMenu::default()->beforeRetrieving(function () {
                DashboardMenu::registerItem([
                    'id' => 'cms-plugins-instantnotifier',
                    'priority' => 5,
                    'parent_id' => null,
                    'name' => 'plugins/instantnotifier::instantnotifier.name',
                    'icon' => 'ti ti-bell-ringing',
                    'url' => route('instantnotifier.index'),
                    'permissions' => ['instantnotifier.index'],
                ]);
            });

            PanelSectionManager::default()->beforeRendering(function () {
                PanelSectionManager::registerItem(
                    SettingOthersPanelSection::class,
                    fn () => PanelSectionItem::make('instantnotifier')
                        ->setTitle(trans('plugins/instantnotifier::instantnotifier.settings.title'))
                        ->withIcon('ti ti-bell-ringing')
                        ->withDescription(trans('plugins/instantnotifier::instantnotifier.settings.description'))
                        ->withPriority(160)
                        ->withRoute('instantnotifier.settings')
                );
            });
    }
}
