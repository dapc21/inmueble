<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('DeleteAllTableSeeder');
		$this->call('UserTableSeeder');
		$this->command->info('users table seeded!');
		$this->call('StatusTableSeeder');
		$this->command->info('statuses table seeded!');
		$this->call('FacilityTableSeeder');
		$this->command->info('facilities table seeded!');
		$this->call('PropertyTableSeeder');
		$this->command->info('properties table seeded!');
		$this->call('PropertyFacilityTableSeeder');
		$this->command->info('properties_facilities table seeded!');
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insertGetId(array('username' => 'JOLIVIERI', 'email' => 'javier.olivieri@nextdots.com', 'password' => '$2y$10$WNegGPzq/UWV2pt5GOPlS.PW5G6PYhMmu0FkoUqUOEDQx0uoz9K6W', 'firstname' => 'Javier', 'lastname' => 'Olivieri','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
    }

}

class StatusTableSeeder extends Seeder {

    public function run()
    {
        DB::table('statuses')->insertGetId(array('name' => 'ACTIVO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('statuses')->insertGetId(array('name' => 'EN REVISIÓN','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('statuses')->insertGetId(array('name' => 'INACTIVO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
    }

}

class FacilityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('facilities')->insertGetId(array('name' => 'EDIFICIO CON ASCENSOR','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('facilities')->insertGetId(array('name' => 'PISCINA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('facilities')->insertGetId(array('name' => 'ESTACIONAMIENTO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('facilities')->insertGetId(array('name' => 'COCINA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('facilities')->insertGetId(array('name' => 'AIRE ACONDICIONADO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('facilities')->insertGetId(array('name' => 'CALEFACCIÓN','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
    }

}

class PropertyTableSeeder extends Seeder {

    public function run()
    {
        DB::table('properties')->insertGetId(array('title' => 'PARQUE NACIONAL MOCHIMA','description' => 'SITIO TURÍSTICO PARA PASAR UN MOMENTO RELAX EN FAMILIA, PAREJA O SOLO','address' => 'PUEBLO DE MOCHIMA, CARRETERA CUMANÁ-PUERTO LA CRUZ','town' => 'MOCHIMA','country' => 'VENEZUELA','status_id' => 1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties')->insertGetId(array('title' => 'COMPLEJO TURÍSTICO PARQUE EL AGUA','description' => 'PARQUE ACUATICO DE PRESTIGIO INTERNACIONAL','address' => 'AV. 31 DE JULIO, EL CARDÓN','town' => 'PORLAMAR','country' => 'VENEZUELA','status_id' => 2,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties')->insertGetId(array('title' => 'HOTEL NUEVA TOLEDO SUITES','description' => 'SITIO TURÍSTICO PARA HOSPEDAJE','address' => 'AV. UNIVERSIDAD, SECTOR LOS BORDONES','town' => 'CUMANÁ','country' => 'VENEZUELA','status_id' => 3,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
    }

}

class PropertyFacilityTableSeeder extends Seeder {

    public function run()
    {
        DB::table('properties_facilities')->insertGetId(array('property_id' => 1,'facility_id' => 1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 1,'facility_id' => 2,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 1,'facility_id' => 3,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 1,'facility_id' => 4,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 1,'facility_id' => 5,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 1,'facility_id' => 6,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 2,'facility_id' => 1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 2,'facility_id' => 2,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 2,'facility_id' => 3,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 3,'facility_id' => 1,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 3,'facility_id' => 2,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 3,'facility_id' => 3,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
        DB::table('properties_facilities')->insertGetId(array('property_id' => 3,'facility_id' => 5,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s")));
    }

}

class DeleteAllTableSeeder extends Seeder {

    public function run()
    {
        DB::table('properties_facilities')->delete();
        $this->command->info('properties_facilities table deleted!');
        DB::table('properties')->delete();
        $this->command->info('properties table deleted!');
        DB::table('facilities')->delete();
        $this->command->info('facilities table deleted!');
        DB::table('statuses')->delete();
        $this->command->info('statuses table deleted!');
        DB::table('users')->delete();
        $this->command->info('users table deleted!');
        DB::table('password_resets')->delete();
        $this->command->info('password_resets table deleted!');
    }

}