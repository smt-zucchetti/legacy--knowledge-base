<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('lastUpdatedBy', 'updated_by');
            
            $table->renameColumn('createdBy', 'created_by');
            
            $table->renameColumn('dateCreated', 'created_at');
            $table->timestamp('created_at')->change();
            
            $table->renameColumn('lastUpdated', 'updated_at');
            $table->timestamp('updated_at')->change();

            $table->timestamp('deleted_at');

            $table->dropColumn('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
