<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class ConvertTypeColumnToEnum extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE sanction_type AS ENUM ('Carton Jaune', 'Carton Rouge', 'Avertissement')");

        DB::statement("ALTER TABLE sanctions ALTER COLUMN type TYPE sanction_type USING type::sanction_type");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE sanctions ALTER COLUMN type TYPE TEXT");

        DB::statement("DROP TYPE sanction_type");
    }
}
