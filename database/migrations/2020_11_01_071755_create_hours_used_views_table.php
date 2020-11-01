<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateHoursUsedViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW used_hours_v AS
                        SELECT
                            hs.id,
                            SUM(COALESCE(a.used_hours, 0)) AS used_hours
                        FROM hour_stacks hs
                        INNER JOIN activities a ON (hs.id = a.hourstack_id)
                        GROUP BY hs.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW used_hours_v");
    }
}
