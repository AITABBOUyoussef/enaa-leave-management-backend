<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ex: Congés Payés, Congés Maladie, Autorisation d'absence
            $table->string('code')->unique(); // ex: CP, SICK, PERMIT
            $table->string('unit')->default('days'); // 'days' or 'hours'
            $table->decimal('default_quota', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
