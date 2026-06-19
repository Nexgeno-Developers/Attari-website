<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('mkt_wati_template')) {
            Schema::create('mkt_wati_template', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('course_id');
                $table->longText('config')->nullable();
                $table->string('description', 255)->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

                $table->index('course_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mkt_wati_template');
    }
};
