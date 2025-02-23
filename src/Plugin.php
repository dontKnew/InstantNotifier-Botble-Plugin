<?php

namespace Botble\InstantNotifier;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('InstantNotifiers');
        Schema::dropIfExists('InstantNotifiers_translations');
    }
}
