<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        Permission::create(['name' => 'be god']);
        Permission::create(['name' => 'I play with madness']);

        // create permissions
        Permission::create(['name' => 'Users: must change password']);

        Permission::create(['name' => 'Users: create']);
        Permission::create(['name' => 'Users: edit']);
        Permission::create(['name' => 'Users: delete']);
        Permission::create(['name' => 'Users: assign permission']);
        Permission::create(['name' => 'Users: service requests']);

        Permission::create(['name' => 'OrganizationalUnits: create']);
        Permission::create(['name' => 'OrganizationalUnits: edit']);
        Permission::create(['name' => 'OrganizationalUnits: delete']);

        Permission::create(['name' => 'Documents: create']);
        Permission::create(['name' => 'Documents: edit']);
        Permission::create(['name' => 'Documents: add number']);
        Permission::create(['name' => 'Documents: signatures and distribution']);

        Permission::create(['name' => 'Resources: create']);
        Permission::create(['name' => 'Resources: edit']);
        Permission::create(['name' => 'Resources: delete']);

        Permission::create(['name' => 'Drugs: view receptions']);
        Permission::create(['name' => 'Drugs: create receptions']);
        Permission::create(['name' => 'Drugs: edit receptions']);
        Permission::create(['name' => 'Drugs: destroy drugs']);
        Permission::create(['name' => 'Drugs: view reports']);
        Permission::create(['name' => 'Drugs: manage parameters']);
        Permission::create(['name' => 'Drugs: manage substances']);
        Permission::create(['name' => 'Drugs: manage courts']);
        Permission::create(['name' => 'Drugs: manage police units']);
        Permission::create(['name' => 'Drugs: delete destructions']);
        Permission::create(['name' => 'Drugs: add results from ISP']);
        Permission::create(['name' => 'Drugs: add protocols']);


        Permission::create(['name' => 'Tickets: create']);
        Permission::create(['name' => 'Tickets: manage']);
        Permission::create(['name' => 'Tickets: TI']);

        Permission::create(['name' => 'Calendar: view']);
        Permission::create(['name' => 'Calendar: aps']);

        Permission::create(['name' => 'Integrity: manage complaints']);

        Permission::create(['name' => 'Indicators: view']);
        Permission::create(['name' => 'Indicators: manager']);

        Permission::create(['name' => 'Authorities: view', 'description' => 'Permite tener acceso al módulo de autoridades']);
        Permission::create(['name' => 'Authorities: create', 'description' => 'Permite crear una autoridad']);
        Permission::create(['name' => 'Authorities: edit', 'description' => 'Permite editar una autoridad']);

        Permission::create(['name' => 'Requirements: create']);

        Permission::create(['name' => 'Agreements: user']);
        Permission::create(['name' => 'Agreements: manager']);

        Permission::create(['name' => 'Pharmacy: manager']);
        Permission::create(['name' => 'Pharmacy: user']);
        //Permission::create(['name' => 'Pharmacy: SSI (id:1)']);
        // Permission::create(['name' => 'Pharmacy: REYNO (id:2)']);
        // Permission::create(['name' => 'Pharmacy: APS (id:3)']);
        // Permission::create(['name' => 'Pharmacy: Servicios generales (id:4)']);
        Permission::create(['name' => 'Pharmacy: create']);
        Permission::create(['name' => 'Pharmacy: deliver']);
        Permission::create(['name' => 'Pharmacy: dispatch']);
        Permission::create(['name' => 'Pharmacy: edit_delete']);
        Permission::create(['name' => 'Pharmacy: mantenedores']);
        Permission::create(['name' => 'Pharmacy: purchase']);
        Permission::create(['name' => 'Pharmacy: receiving']);
        Permission::create(['name' => 'Pharmacy: reports']);
        Permission::create(['name' => 'Pharmacy: transfer']);
        Permission::create(['name' => 'Pharmacy: transfer view ortesis']);
        Permission::create(['name' => 'Pharmacy: create suppliers']);
        Permission::create(['name' => 'Pharmacy: create establishments']);
        Permission::create(['name' => 'Pharmacy: create products']);
        Permission::create(['name' => 'Pharmacy: create programs']);

        Permission::create(['name' => 'Service Request']);
        Permission::create(['name' => 'Service Request: additional data']);
        Permission::create(['name' => 'Service Request: additional data finanzas']);
        Permission::create(['name' => 'Service Request: additional data oficina partes']);
        Permission::create(['name' => 'Service Request: additional data rrhh']);
        Permission::create(['name' => 'Service Request: consolidated data']);
        Permission::create(['name' => 'Service Request: change signature flow']);
        Permission::create(['name' => 'Service Request: audit']);
        Permission::create(['name' => 'Service Request: delete request']);
        Permission::create(['name' => 'Service Request: derive requests']);
        Permission::create(['name' => 'Service Request: fulfillments']);
        Permission::create(['name' => 'Service Request: fulfillments finance']);
        Permission::create(['name' => 'Service Request: fulfillments responsable']);
        Permission::create(['name' => 'Service Request: fulfillments rrhh']);
        Permission::create(['name' => 'Service Request: maintainers']);
        Permission::create(['name' => 'Service Request: pending requests']);
        Permission::create(['name' => 'Service Request: report to pay']);
        Permission::create(['name' => 'Service Request: sign document']);
        Permission::create(['name' => 'Service Request: transfer requests']);
        Permission::create(['name' => 'Service Request: view']);
        Permission::create(['name' => 'Service Request: with resolution']);

        Permission::create(['name' => 'Shift Management: view']);

        Permission::create(['name' => 'Suitability: admin']);
        Permission::create(['name' => 'Suitability: test']);
        Permission::create(['name' => 'Suitability: ssi']);

        Permission::create(['name' => 'Request Forms: Finance add item code']);
        Permission::create(['name' => 'Request Forms: config']);

        Permission::create(['name' => 'Health Plan']);

        Permission::create(['name' => 'Partes: user']);
        Permission::create(['name' => 'Partes: director']);
        Permission::create(['name' => 'Partes: oficina']);


        Permission::create(['name' => 'Replacement Staff: create request']);
        Permission::create(['name' => 'Replacement Staff: list rrhh']);
        Permission::create(['name' => 'Replacement Staff: manage']);
        Permission::create(['name' => 'Replacement Staff: technical evaluation']);
        Permission::create(['name' => 'Replacement Staff: assign request']);
        Permission::create(['name' => 'Replacement Staff: view requests']);
        Permission::create(['name' => 'Programming: view']);

        // @role(
        //   'Replacement Staff: admin |
        //   Replacement Staff: user'
        // )

        // create roles and assign created permissions
        // GOD LIKE
        $role = Role::create(['name' => 'god']);
        $role = Role::create(['name' => 'dev']);
        //$role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Drugs: admin']);
        $role->givePermissionTo(['Drugs: view receptions',
                                'Drugs: create receptions',
                                'Drugs: edit receptions',
                                'Drugs: destroy drugs',
                                'Drugs: view reports',
                                'Drugs: manage parameters',
                                'Drugs: manage substances',
                                'Drugs: manage courts',
                                'Drugs: manage police units',
                                'Drugs: delete destructions',
                                'Drugs: add results from ISP',
                                'Drugs: add protocols']);

        $role = Role::create(['name' => 'Drugs: receptionist']);
        $role->givePermissionTo(['Drugs: view receptions',
                                'Drugs: create receptions',
                                'Drugs: edit receptions',
                                'Drugs: destroy drugs',
                                'Drugs: view reports',
                                'Drugs: manage substances',
                                'Drugs: manage courts',
                                'Drugs: manage police units',
                                'Drugs: add protocols']);

        $role = Role::create(['name' => 'Drugs: basic']);
        $role->givePermissionTo(['Drugs: view receptions',
                                'Drugs: destroy drugs',
                                'Drugs: view reports',
                                'Drugs: add results from ISP']);

        $role = Role::create(['name' => 'RRHH: admin']);
        $role->givePermissionTo(['Users: create', 'Users: edit', 'Users: delete', 'Users: assign permission']);

        $role = Role::create(['name' => 'Resources: admin']);
        $role->givePermissionTo(['Resources: create', 'Resources: edit', 'Resources: delete']);

        $role = Role::create(['name' => 'Tickets: admin']);
        $role->givePermissionTo(['Tickets: create', 'Tickets: manage','Tickets: TI']);

        $role = Role::create(['name' => 'Replacement Staff: admin']);
        $role->givePermissionTo(['Replacement Staff: manage', 'Replacement Staff: list rrhh','Replacement Staff: assign request','Replacement Staff: create request']);

        $role = Role::create(['name' => 'Replacement Staff: view requests']);
        $role->givePermissionTo(['Replacement Staff: view requests','Replacement Staff: list rrhh','Replacement Staff: assign request']);

        $role = Role::create(['name' => 'Replacement Staff: user rys']);

    }
}
