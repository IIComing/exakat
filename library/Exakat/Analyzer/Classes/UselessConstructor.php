<?php
/*
 * Copyright 2012-2017 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
 * This file is part of Exakat.
 *
 * Exakat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Exakat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Exakat.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://exakat.io/>.
 *
*/


namespace Exakat\Analyzer\Classes;

use Exakat\Analyzer\Analyzer;

class UselessConstructor extends Analyzer {
    public function dependsOn() {
        return array('Classes/Constructor');
    }

    public function analyze() {
        $checkConstructor = 'where( __.out("BLOCK").out("ELEMENT").hasLabel("Function").where( __.in("ANALYZED").has("analyzer", "Classes/Constructor")).count().is(eq(0)) )';
        
        // class a (no extends, no implements)
        $this->atomIs('Class')
             ->hasNoOut(array('EXTENDS', 'IMPLEMENTS'))
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Function')
             ->analyzerIs('Classes/Constructor')
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Void')
             ->back('first');
        $this->prepareQuery();

        // class a with extends, one level
        $this->atomIs('Class')
             ->hasOut('EXTENDS')
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Function')
             ->analyzerIs('Classes/Constructor')
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Void')
             ->back('first')
             ->outIs('EXTENDS')
             ->inIs('DEFINITION')
             ->hasNoOut('EXTENDS')
             ->hasNoOut('IMPLEMENTS')
             ->raw($checkConstructor)
             ->back('first');
        $this->prepareQuery();

        // class a with extends, two level
        $this->atomIs('Class')
             ->hasOut('EXTENDS')
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Function')
             ->analyzerIs('Classes/Constructor')
             ->outIs('BLOCK')
             ->outIs('ELEMENT')
             ->atomIs('Void')
             ->back('first')
             ->outIs('EXTENDS')
             ->inIs('DEFINITION')
             ->hasOut('EXTENDS')
             ->raw($checkConstructor)
             ->outIs('EXTENDS')
             ->inIs('DEFINITION')
             ->raw($checkConstructor)
             ->back('first');
        $this->prepareQuery();
    }
}

?>
