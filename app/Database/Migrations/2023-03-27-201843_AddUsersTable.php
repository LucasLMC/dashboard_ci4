<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ],
            'reset_hash' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
                'default' => null
            ],
            'reset_hash_expiration_time' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'img_user' => [
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => true,
                'default' => null
            ],
            'active' => [
                'type' => 'BOOLEAN',
                'null' => false,
                'default' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');

        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
