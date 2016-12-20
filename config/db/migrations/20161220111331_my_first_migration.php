<?php
use Phinx\Migration\AbstractMigration;

class MyFirstMigration extends AbstractMigration
{
    public function up()
    {
        $this->execute('
            CREATE TABLE `users` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(250) NOT NULL DEFAULT \'anon\',
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ');
    }

    public function down()
    {
        $this->execute('
            DROP TABLE `users`;
        ');
    }
}
