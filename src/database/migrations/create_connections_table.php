<?php
/**
 * lumen-auth
 * This file contains CreateConnectionsTable class.
 *
 * Created by PhpStorm on 27/12/2021 at 12:29
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateConnectionsTable
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->dateTime('latest')->nullable();
            $table->dateTime('logout_at')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('expires');
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connections');
    }
}