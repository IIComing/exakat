<?php

namespace Test;

include_once(dirname(dirname(dirname(dirname(__DIR__)))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class Structures_IssetWithConstant extends Analyzer {
    /* 3 methods */

    public function testStructures_IssetWithConstant01()  { $this->generic_test('Structures_IssetWithConstant.01'); }
    public function testStructures_IssetWithConstant02()  { $this->generic_test('Structures_IssetWithConstant.02'); }
    public function testStructures_IssetWithConstant03()  { $this->generic_test('Structures/IssetWithConstant.03'); }
}
?>