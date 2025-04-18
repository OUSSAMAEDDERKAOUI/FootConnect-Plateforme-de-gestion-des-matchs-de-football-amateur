<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddSuspensionToSanctionType extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TYPE sanction_type ADD VALUE IF NOT EXISTS 'Suspension'");
    }

    public function down(): void
    {
    }
}
