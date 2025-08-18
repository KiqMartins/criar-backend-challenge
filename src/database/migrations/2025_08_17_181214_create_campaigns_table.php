<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->foreignId('cluster_id')->nullable()->constrained('clusters')->onDelete('cascade');
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('active_cluster_id')->virtualAs('CASE WHEN is_active THEN cluster_id ELSE NULL END')->nullable();
            $table->unique(['active_cluster_id'], 'one_active_campaign_per_cluster');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
