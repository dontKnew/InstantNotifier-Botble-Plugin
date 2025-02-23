<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('instant_notifiers')) {
            Schema::create('instant_notifiers', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('status', 60)->default('published');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('instant_notifiers_translations')) {
            Schema::create('instant_notifiers_translations', function (Blueprint $table) {
                $table->string('lang_code');
                $table->foreignId('instant_notifiers_id');
                $table->string('name', 255)->nullable();

                $table->primary(['lang_code', 'instant_notifiers_id'], 'instant_notifiers_translations_primary');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('instant_notifiers');
        Schema::dropIfExists('instant_notifiers_translations');
    }
};
