<?php

namespace Test;

include_once(dirname(dirname(dirname(dirname(__DIR__)))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class Cakephp_Cakephp33 extends Analyzer {
    /* 1 methods */

    public function testCakephp_Cakephp3301()  { $this->generic_test('Cakephp/Cakephp33.01'); }
}
?>