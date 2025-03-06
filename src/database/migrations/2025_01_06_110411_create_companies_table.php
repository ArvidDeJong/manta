<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('relation_nr')->nullable()->after('identifier');
            $table->string('debtor_nr')->nullable()->after('relation_nr');
            $table->string('user_nr')->nullable()->after('debtor_nr');
            $table->string('number')->nullable()->after('user_nr');
            $table->string('sex')->nullable()->after('number');
            $table->string('initials')->nullable()->after('sex');
            $table->string('lastname')->nullable()->after('initials');
            $table->string('firstnames')->nullable()->after('lastname');
            $table->string('nameInsertion')->nullable()->after('firstnames');
            $table->string('company')->nullable()->after('nameInsertion');
            $table->string('companyNr')->nullable()->after('company');
            $table->string('taxNr')->nullable()->after('companyNr');
            $table->string('address')->nullable()->after('taxNr');
            $table->string('housenumber')->nullable()->after('address');
            $table->string('addressSuffix')->nullable()->after('housenumber');
            $table->string('zipcode')->nullable()->after('addressSuffix');
            $table->string('city')->nullable()->after('zipcode');
            $table->string('country')->nullable()->default('nl')->after('city');
            $table->string('state')->nullable()->after('country');
            $table->date('birthdate')->nullable()->after('state');
            $table->string('birthcity')->nullable()->after('birthdate');
            $table->string('phone')->nullable()->after('birthcity');
            $table->string('phone2')->nullable()->after('phone');
            $table->string('bsn')->nullable()->after('phone2');
            $table->string('iban')->nullable()->after('bsn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'relation_nr',
                'debtor_nr',
                'user_nr',
                'number',
                'sex',
                'initials',
                'lastname',
                'firstnames',
                'nameInsertion',
                'company',
                'companyNr',
                'taxNr',
                'address',
                'housenumber',
                'addressSuffix',
                'zipcode',
                'city',
                'country',
                'state',
                'birthdate',
                'birthcity',
                'phone',
                'phone2',
                'bsn',
                'iban',
            ]);
        });
    }
};
