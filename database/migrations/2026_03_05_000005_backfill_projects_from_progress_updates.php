<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Backfill customer_code jika ada customer lama yang belum punya ID.
        $customers = DB::table('users')
            ->where('role', 'customer')
            ->whereNull('customer_code')
            ->select('id')
            ->get();

        foreach ($customers as $customer) {
            DB::table('users')->where('id', $customer->id)->update([
                'customer_code' => 'CUST-' . str_pad((string) $customer->id, 4, '0', STR_PAD_LEFT),
            ]);
        }

        $legacyProjects = DB::table('progress_updates')
            ->whereNotNull('id_project')
            ->whereNull('project_id')
            ->selectRaw('user_id, id_project, MIN(tanggal_update) as first_update')
            ->groupBy('user_id', 'id_project')
            ->get();

        foreach ($legacyProjects as $legacy) {
            $user = DB::table('users')->where('id', $legacy->user_id)->first();
            if (! $user) {
                continue;
            }

            $baseCode = trim((string) $legacy->id_project);
            if ($baseCode === '') {
                $baseCode = 'PRJ-' . str_pad((string) $legacy->user_id, 4, '0', STR_PAD_LEFT);
            }

            $projectCode = $baseCode;
            $suffix = 1;
            while (DB::table('projects')->where('project_code', $projectCode)->exists()) {
                $projectCode = $baseCode . '-R' . $suffix;
                $suffix++;
            }

            $projectId = DB::table('projects')->insertGetId([
                'project_code' => $projectCode,
                'user_id' => $legacy->user_id,
                'customer_name' => $user->name,
                'customer_phone' => $user->phone,
                'customer_email' => $user->email,
                'deal_date' => $legacy->first_update,
                'deal_payment_proof' => null,
                'status' => 'in_progress',
                'notes' => 'Auto-generated from legacy progress data',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('progress_updates')
                ->where('user_id', $legacy->user_id)
                ->where('id_project', $legacy->id_project)
                ->whereNull('project_id')
                ->update([
                    'project_id' => $projectId,
                    'id_project' => $projectCode,
                ]);
        }
    }

    public function down(): void
    {
        // Tidak melakukan rollback data backfill otomatis untuk mencegah kehilangan data historis.
    }
};
