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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_name');
            $table->string('company_name');
            $table->string('email')->nullable();
            $table->string('phone');

            $table->foreignId('lead_source_id')
                  ->constrained('lead_sources');

            $table->string('status')->default('New');

            $table->foreignId('assigned_salesperson_id')
                  ->nullable()
                  ->constrained('users');

            $table->decimal('expected_deal_value', 12, 2)->default(0);

            $table->date('follow_up_date')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
