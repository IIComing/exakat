<?php

namespace Analyzer\Classes;

use Analyzer;

class RedefinedProperty extends Analyzer\Analyzer {
    /* Remove this is useless
    public function dependsOn() {
        return array("MethodDefinition");
    }
    */
    
    public function analyze() {
        $this->atomIs('Ppp')
             ->outIs('DEFINE')
             ->savePropertyAs('code', 'property')
             ->goToClass()
             ->goToAllParents()
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Ppp')
             ->outIs('DEFINE')
             ->samePropertyAs('code', 'property');
        $this->prepareQuery();
    }
}

?>
