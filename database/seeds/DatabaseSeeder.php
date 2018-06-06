<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\{ Role, Bank, Box, Shelf, Folder };

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Registrador']);

        User::create([
          'name' => 'root',
          'last_name' => 'root',
          'email' => 'root@root.com',
          'num_id' => '123456789',
          'role_id' => 1,
          'password' => bcrypt('secret'),
      ]);

        Bank::create(['code' => '0001', 'name' => 'BANCO CENTRAL DE VENEZUELA']);
        Bank::create(['code' => '0102', 'name' => 'BANCO DE VENEZUELA S.A.C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0104', 'name' => 'VENEZOLANO DE CRÉDITO, S.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0105', 'name' => 'BANCO MERCANTIL, C.A. S.A.C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0108', 'name' => 'BANCO PROVINCIAL, S.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0114', 'name' => 'BANCO DEL CARIBE, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0115', 'name' => 'BANCO EXTERIOR, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0116', 'name' => 'BANCO OCCIDENTAL DE DESCUENTO BANCO UNIVERSAL, C.A.']);
        Bank::create(['code' => '0128', 'name' => 'BANCO CARONI, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0134', 'name' => 'BANESCO BANCO UNIVERSAL S.A.C.A.']);
        Bank::create(['code' => '0137', 'name' => 'BANCO SOFITASA BANCO UNIVERSAL, C.A.']);
        Bank::create(['code' => '0138', 'name' => 'BANCO PLAZA, BANCO UNIVERSAL C.A.']);
        Bank::create(['code' => '0146', 'name' => 'BANCO DE LA GENTE EMPRENDEDORA BANGENTE, C.A.']);
        Bank::create(['code' => '0149', 'name' => 'BANCO DEL PUEBLO SOBERANO, BANCO DE DESARROLLO']);
        Bank::create(['code' => '0151', 'name' => 'BFC BANCO FONDO COMUN C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0157', 'name' => 'DELSUR BANCO UNIVERSAL, C.A.']);
        Bank::create(['code' => '0163', 'name' => 'BANCO DEL TESORO, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0166', 'name' => 'BANCO AGRICOLA DE VENEZUELA, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0168', 'name' => 'BANCRECER S.A. BANCO DE DESARROLLO']);
        Bank::create(['code' => '0169', 'name' => 'MI BANCO, BANCO MICROFINANCIERO, C.A.']);
        Bank::create(['code' => '0171', 'name' => 'BANCO ACTIVO, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0172', 'name' => 'BANCAMIGA BANCO MICROFINANCIERO, C.A.']);
        Bank::create(['code' => '0173', 'name' => 'BANCO INTERNACIONAL DE DESARROLLO, C.A. BANCO UNIVERSAL']);
        Bank::create(['code' => '0174', 'name' => 'BANPLUS BANCO UNIVERAL, C.A.']);
        Bank::create(['code' => '0175', 'name' => 'BANCO BICENTENARIO BANCO UNIVERSAL, C.A.']);
        Bank::create(['code' => '0176', 'name' => 'NOVO BANCO, S.A. SUCURSAL VENEZUELA BANCO UNIVERSAL']);
        Bank::create(['code' => '0177', 'name' => 'BANCO DE LA FUERZA ARMADA NACIONAL BOLIVARIANA, B.U.']);
        Bank::create(['code' => '0190', 'name' => 'CITIBANK N.A.']);
        Bank::create(['code' => '0191', 'name' => 'BANCO NACIONAL CRÉDITO, C.A. BANCO UNIVERSAL']);


        for ($a=1; $a <= 16; $a++) { 
            Shelf::create(['name' => 'Archivo ' . $a]);
            for ($e=1; $e <= 5; $e++) { 
                $box = Box::create(['name' => 'Estante ' . $e . ' - ' . $a, 'shelf_id' => $a]);
                for ($p=1; $p <= 6; $p++) { 
                    Folder::create(['name' => 'Peldaño ' . $p . ' - ' . $e . ' - ' . $box->id, 'box_id' => $box->id]);
                }
            }
        }
        // $this->call(UsersTableSeeder::class);
    }
}
