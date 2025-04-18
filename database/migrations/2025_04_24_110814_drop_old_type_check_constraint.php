<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class DropOldTypeCheckConstraint extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE sanctions DROP CONSTRAINT IF EXISTS sanctions_type_check");
    }

    public function down(): void
    {
        // Si tu veux la remettre (optionnel)
        DB::statement("ALTER TABLE sanctions ADD CONSTRAINT sanctions_type_check CHECK (type IN ('Carton Jaune', 'Carton Rouge', 'Avertissement'))");
    }
}
