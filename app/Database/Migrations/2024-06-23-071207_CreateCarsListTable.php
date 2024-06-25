<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCarsListTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'cl_id' => [
                'type'           => 'INT',
                'null'           => false,
                'auto_increment' => true
            ],
            'cl_brand' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false
            ],
            'cl_model' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false
            ],
            'cl_color' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => true
            ],
            'cl_year' => [
                'type' => 'INT',
                'null' => false
            ]
        ]);

        $this->forge->addPrimaryKey('cl_id');

        $this->forge->createTable('cars_list');
    }

    public function down()
    {
        $this->forge->dropTable('cars_list');
    }
}

// use in command line (from the project folder!): "php spark make:"migration Create<name>Table
// use in command line (from the project folder!): "php spark migrate" to run the up function and create the table
// use in command line (from the project folder!): "php spark migrate:rollback" to run the down function and delete the table