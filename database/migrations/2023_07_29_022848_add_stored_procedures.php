<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $getProductWithMostStockProcedure = "
                                            CREATE PROCEDURE `GetProductWithMostStock` ()
                                            BEGIN
                                                SELECT id, name, stock
                                                FROM products
                                                ORDER BY stock DESC
                                                LIMIT 1;
                                            END;";

        // Procedimiento almacenado para obtener el producto más vendido
        $getMostSoldProductProcedure = "
                    CREATE PROCEDURE `GetMostSoldProduct` ()
                    BEGIN
                        SELECT p.id, p.name, SUM(s.quantity) as total_quantity
                        FROM products p
                        JOIN sells s ON p.id = s.product_id
                        GROUP BY p.id, p.name
                        ORDER BY total_quantity DESC
                        LIMIT 1;
                    END;";
        DB::unprepared('DROP PROCEDURE IF EXISTS GetProductWithMostStock');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetMostSoldProduct');
        DB::unprepared($getProductWithMostStockProcedure);
        DB::unprepared($getMostSoldProductProcedure);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar los procedimientos almacenados si es necesario (opcional)
        DB::unprepared('DROP PROCEDURE IF EXISTS GetProductWithMostStock');
        DB::unprepared('DROP PROCEDURE IF EXISTS GetMostSoldProduct');
    }
};
