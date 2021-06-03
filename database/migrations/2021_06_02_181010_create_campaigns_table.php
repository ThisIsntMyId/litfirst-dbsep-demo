<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Ignite\Support\Migration\MigratePermissions;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('master')->create('campaigns', function (Blueprint $table) {
            $table->id();

			$table->string('slug')->nullable();

            $table->string('title');
            $table->text('description')->nullable();

            $table->string('link');
            $table->text('terms')->nullable();

            $table->decimal('price')->nullable();
            $table->decimal('rebated_price')->nullable();

            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            $table->integer('rebates_per_interval')->nullable();
            $table->integer('rebates_count')->nullable();
            $table->enum('rebate_interval', ['hour', 'quarter day', 'half day', 'full day'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
