<?php

namespace Test;

include_once(dirname(dirname(dirname(dirname(__DIR__)))).'/library/Autoload.php');
spl_autoload_register('Autoload::autoload_test');
spl_autoload_register('Autoload::autoload_phpunit');
spl_autoload_register('Autoload::autoload_library');

class Wordpress_NoGlobalModification extends Analyzer {
    /* 2 methods */

    public function testWordpress_NoGlobalModification01()  { $this->generic_test('Wordpress_NoGlobalModification.01'); }
    public function testWordpress_NoGlobalModification02()  { $this->generic_test('Wordpress_NoGlobalModification.02'); }
}
?>