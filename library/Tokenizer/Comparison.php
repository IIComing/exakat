<?php

namespace Tokenizer;

class Comparison extends TokenAuto {
    static public $operators = array('T_IS_EQUAL','T_IS_NOT_EQUAL', 'T_IS_GREATER_OR_EQUAL', 'T_IS_SMALLER_OR_EQUAL', 'T_IS_IDENTICAL', 'T_IS_NOT_IDENTICAL', 'T_GREATER', 'T_SMALLER', );
    function _check() {
    
        $operands = array('Variable', 'Array', 'Property', 'Integer', 'Sign', 'Float', 'Constant', 'Boolean',
                          'Property', 'Staticproperty', 'Methodcall', 'Staticmethodcall', 'Functioncall',
                           'Magicconstant', 'Staticconstant', 'String', 'Addition', 'Multiplication',
                          'Nsname', 'Not', 'Reference', 'Parenthesis', 'Noscream', 'Preplusplus', 'Postplusplus',
                          'Bitshift',  );
        //'Assignation','Assignation', 
        
        $this->conditions = array(-2 => array('filterOut' => array_merge(array('T_OBJECT_OPERATOR', 'T_DOUBLE_COLON'), 
                                                                         Addition::$operators, Bitshift::$operators, Multiplication::$operators)), 
                                  -1 => array('atom' => $operands ),
                                   0 => array('token' => Comparison::$operators,
                                              'atom' => 'none'),
                                   1 => array('atom' => $operands),
                                   2 => array('filterOut' => array_merge(array('T_OPEN_PARENTHESIS', 'T_OPEN_BRACKET', 'T_OPEN_CURLY'), 
                                                           Addition::$operators, Multiplication::$operators )),
        );
        
        $this->actions = array('makeEdge'    => array('1' => 'RIGHT',
                                                      '-1' => 'LEFT'
                                                      ),
                               'atom'       => 'Comparison',
                               );
        $r = $this->checkAuto(); 

        return $r;
    }

    
    function reserve() {
        Token::$reserved = array_merge(Token::$reserved, Comparison::$operators);
        
        return true;
    }
}

?>