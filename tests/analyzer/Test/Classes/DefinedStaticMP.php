<?php

namespace Test;

include_once(dirname(dirname(dirname(dirname(__DIR__)))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class Classes_DefinedStaticMP extends Analyzer {
    /* 2 methods */

    public function testClasses_DefinedStaticMP01()  { $this->generic_test('Classes_DefinedStaticMP.01'); }
    public function testClasses_DefinedStaticMP02()  { $this->generic_test('Classes_DefinedStaticMP.02'); }
}
?>