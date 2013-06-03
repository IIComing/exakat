<?php

namespace Tokenizer;

class Assignation extends TokenAuto {
    function check() {

        $this->conditions = array(0 => array('code' => array('='),
                                             'atom' => 'none'),
                                  1 => array('atom' => array('Integer', 'Multiplication')),
                                  
        );
        
        $this->actions = array('addEdge'    => array( '1' => 'RIGHT',
                                                      '-1' => 'LEFT'),
                               'changeNext' => array(1, -1),
                               'atom'       => 'Assignation',
                               'cleansemicolon' => 1);

        return $this->checkAuto();
    } 
}
?>