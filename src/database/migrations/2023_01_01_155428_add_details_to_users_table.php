<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->boolean('must_change_password')->default(true);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('contactperson_id')->nullable();
            $table->string('host')->nullable();
            $table->integer('pid')->nullable();
            $table->string('locale')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->string('administration')->nullable();
            $table->string('identifier')->nullable();
            $table->string('relation_nr')->nullable();
            $table->string('debtor_nr')->nullable();
            $table->string('user_nr')->nullable();
            $table->string('number')->nullable();
            $table->string('sex')->nullable();
            $table->string('initials')->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstnames')->nullable();
            $table->string('nameInsertion')->nullable();
            $table->string('company')->nullable();
            $table->string('companyNr')->nullable();
            $table->string('taxNr')->nullable();
            $table->string('address')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('addressSuffix')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable()->default('nl');
            $table->string('state')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('birthcity')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('bsn')->nullable();
            $table->string('iban')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->dateTime('lastLogin')->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('admin')->default(0);
            $table->tinyInteger('developer')->default(0);
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if columns exist before dropping them
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
            $table->dropColumn([
                'created_by', 'updated_by', 'deleted_by', 'company_id', 'contactperson_id',
                'host', 'pid', 'locale', 'active', 'administration', 'identifier',
                'relation_nr', 'debtor_nr', 'user_nr', 'number', 'sex', 'initials',
                'lastname', 'firstnames', 'nameInsertion', 'company', 'companyNr',
                'taxNr', 'address', 'housenumber', 'addressSuffix', 'zipcode',
                'city', 'country', 'state', 'birthdate', 'birthcity', 'phone',
                'phone2', 'bsn', 'iban', 'maritalStatus', 'lastLogin', 'code',
                'admin', 'developer', 'comment', 'must_change_password'
            ]);
        });
    }
};
