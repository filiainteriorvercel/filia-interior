<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('customer_code')->nullable()->after('role');
        });

        // Backfill customer code untuk data existing role customer.
        $customers = DB::table('users')
            ->where('role', 'customer')
            ->whereNull('customer_code')
            ->select('id')
            ->get();

        foreach ($customers as $customer) {
            DB::table('users')
                ->where('id', $customer->id)
                ->update([
                    'customer_code' => 'CUST-' . str_pad((string) $customer->id, 4, '0', STR_PAD_LEFT),
                ]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->unique('customer_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['customer_code']);
            $table->dropColumn(['phone', 'customer_code']);
        });
    }
};
