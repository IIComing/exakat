<?php
/*
 * Copyright 2012-2016 Damien Seguy – Exakat Ltd <contact(at)exakat.io>
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


namespace Exakat\Analyzer\Composer;

use Exakat\Analyzer\Analyzer;

class PackagesNames extends Analyzer {
    private $report = null;
    
    public function analyze() {
        return true;
    }

    public function toArray() {
        if ($this->report === null) {
            $this->hasResult();
        }

        return $this->report;
    }

    public function hasResults() {
        Analyzer::initDocs();
        
        $data = Analyzer::$datastore->getRow('composer');
        $this->report = array();
        foreach($data as $d) {
            $this->report[$d['component']. ' ('.$d['version'].')'] = true;
        }
        
        return count($this->report) > 0;
    }

}

?>