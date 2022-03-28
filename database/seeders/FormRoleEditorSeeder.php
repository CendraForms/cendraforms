<?php

namespace Database\Seeders;

use App\Models\FormRoleEditor;
use Illuminate\Database\Seeder;

class FormRoleEditorSeeder extends Seeder
{
    /**
     * Run the database form seeder.
     *
     * @return void
     */
    public function run()
    {
        FormRoleEditor::create([
            'form_id' => 1,
            'role_id' => 2,
        ]);

        FormRoleEditor::create([
            'form_id' => 2,
            'role_id' => 2,
        ]);

        FormRoleEditor::create([
            'form_id' => 3,
            'role_id' => 2,
        ]);
    }
}
