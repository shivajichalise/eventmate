<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('gender', ['Male', 'Female', 'Other'])->after('email');
            $table->date('dob')->nullable()->after('gender');
            $table->string('address_line_1')->nullable()->after('dob');
            $table->string('address_line_2')->nullable()->after('address_line_1');
            $table->string('state')->nullable()->after('address_line_2');
            $table->string('city')->nullable()->after('state');
            $table->string('country')->nullable()->after('city');
            $table->string('mobile_number', 15)->after('country');
            $table->string('emergency_number', 15)->nullable()->after('mobile_number');
            $table->boolean('is_disabled')->default(false)->after('emergency_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'dob',
                'address_line_1',
                'address_line_2',
                'state',
                'city',
                'country',
                'mobile_number',
                'emergency_number',
                'is_disabled',
            ]);
        });
    }
};
