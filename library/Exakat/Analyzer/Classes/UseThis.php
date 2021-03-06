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

class UseThis extends Analyzer {
    public function analyze() {
        // Valid for both statics and normal
        // parent::
        $this->atomIs('Function')
             ->hasClassTrait()
             ->outIs('BLOCK')
             ->atomInside(array('Staticmethodcall', 'Staticconstant', 'Staticproperty'))
             ->outIs('CLASS')
             ->codeIs('parent')
             ->back('first');
        $this->prepareQuery();

        // Case for normal methods
        $this->atomIs('Function')
             ->hasClassTrait()
             ->hasNoOut('STATIC')
             ->outIs('BLOCK')
             ->atomInside('Variable')
             ->codeIs('$this', true)
             ->back('first');
        $this->prepareQuery();

        // Case for statics methods
        $this->atomIs('Function')
             ->hasClassTrait()
             ->hasOut('STATIC')
             ->outIs('BLOCK')
             ->atomInside(array('Staticmethodcall', 'Staticproperty', 'Staticconstant'))
             ->outIs('CLASS')
             ->tokenIs(array('T_STRING', 'T_NS_SEPARATOR'))
             ->savePropertyAs('fullnspath', 'classe')
             ->goToClassTrait()
             ->samePropertyAs('fullnspath', 'classe')
             ->back('first');
        $this->prepareQuery();

        $this->atomIs('Function')
             ->hasClassTrait()
             ->hasOut('STATIC')
             ->outIs('BLOCK')
             ->atomInside('Staticproperty')
             ->outIs('CLASS')
             ->tokenIs(array('T_STRING', 'T_NS_SEPARATOR'))
             ->savePropertyAs('fullnspath', 'classe')
             ->goToClassTrait()
             ->samePropertyAs('fullnspath', 'classe')
             ->back('first');
        $this->prepareQuery();

    // static constant are excluded.
    }
}

?>
