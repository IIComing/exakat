<?php

namespace Test;

include_once(dirname(dirname(dirname(dirname(__DIR__)))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class Arrays_IsRead extends Analyzer {
    /* 2 methods */

    public function testArrays_IsRead01()  { $this->generic_test('Arrays_IsRead.01'); }
    public function testArrays_IsRead02()  { $this->generic_test('Arrays/IsRead.02'); }
}
?>