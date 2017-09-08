<?php
/*
<<<<<<< HEAD
 * This file is part of php-token-stream.
=======
 * This file is part of the PHP_TokenStream package.
>>>>>>> release/v2
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A stream of PHP tokens.
<<<<<<< HEAD
=======
 *
 * @author    Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright Sebastian Bergmann <sebastian@phpunit.de>
 * @license   http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link      http://github.com/sebastianbergmann/php-token-stream/tree
 * @since     Class available since Release 1.0.0
>>>>>>> release/v2
 */
class PHP_Token_Stream implements ArrayAccess, Countable, SeekableIterator
{
    /**
     * @var array
     */
<<<<<<< HEAD
    protected static $customTokens = [
=======
    protected static $customTokens = array(
>>>>>>> release/v2
        '(' => 'PHP_Token_OPEN_BRACKET',
        ')' => 'PHP_Token_CLOSE_BRACKET',
        '[' => 'PHP_Token_OPEN_SQUARE',
        ']' => 'PHP_Token_CLOSE_SQUARE',
        '{' => 'PHP_Token_OPEN_CURLY',
        '}' => 'PHP_Token_CLOSE_CURLY',
        ';' => 'PHP_Token_SEMICOLON',
        '.' => 'PHP_Token_DOT',
        ',' => 'PHP_Token_COMMA',
        '=' => 'PHP_Token_EQUAL',
        '<' => 'PHP_Token_LT',
        '>' => 'PHP_Token_GT',
        '+' => 'PHP_Token_PLUS',
        '-' => 'PHP_Token_MINUS',
        '*' => 'PHP_Token_MULT',
        '/' => 'PHP_Token_DIV',
        '?' => 'PHP_Token_QUESTION_MARK',
        '!' => 'PHP_Token_EXCLAMATION_MARK',
        ':' => 'PHP_Token_COLON',
        '"' => 'PHP_Token_DOUBLE_QUOTES',
        '@' => 'PHP_Token_AT',
        '&' => 'PHP_Token_AMPERSAND',
        '%' => 'PHP_Token_PERCENT',
        '|' => 'PHP_Token_PIPE',
        '$' => 'PHP_Token_DOLLAR',
        '^' => 'PHP_Token_CARET',
        '~' => 'PHP_Token_TILDE',
        '`' => 'PHP_Token_BACKTICK'
<<<<<<< HEAD
    ];
=======
    );
>>>>>>> release/v2

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var array
     */
<<<<<<< HEAD
    protected $tokens = [];

    /**
     * @var int
=======
    protected $tokens = array();

    /**
     * @var integer
>>>>>>> release/v2
     */
    protected $position = 0;

    /**
     * @var array
     */
<<<<<<< HEAD
    protected $linesOfCode = ['loc' => 0, 'cloc' => 0, 'ncloc' => 0];
=======
    protected $linesOfCode = array('loc' => 0, 'cloc' => 0, 'ncloc' => 0);
>>>>>>> release/v2

    /**
     * @var array
     */
    protected $classes;

    /**
     * @var array
     */
    protected $functions;

    /**
     * @var array
     */
    protected $includes;

    /**
     * @var array
     */
    protected $interfaces;

    /**
     * @var array
     */
    protected $traits;

    /**
     * @var array
     */
<<<<<<< HEAD
    protected $lineToFunctionMap = [];
=======
    protected $lineToFunctionMap = array();
>>>>>>> release/v2

    /**
     * Constructor.
     *
     * @param string $sourceCode
     */
    public function __construct($sourceCode)
    {
        if (is_file($sourceCode)) {
            $this->filename = $sourceCode;
            $sourceCode     = file_get_contents($sourceCode);
        }

        $this->scan($sourceCode);
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
<<<<<<< HEAD
        $this->tokens = [];
=======
        $this->tokens = array();
>>>>>>> release/v2
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $buffer = '';

        foreach ($this as $token) {
            $buffer .= $token;
        }

        return $buffer;
    }

    /**
     * @return string
<<<<<<< HEAD
=======
     * @since  Method available since Release 1.1.0
>>>>>>> release/v2
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Scans the source for sequences of characters and converts them into a
     * stream of tokens.
     *
     * @param string $sourceCode
     */
    protected function scan($sourceCode)
    {
        $id        = 0;
        $line      = 1;
        $tokens    = token_get_all($sourceCode);
        $numTokens = count($tokens);

        $lastNonWhitespaceTokenWasDoubleColon = false;

        for ($i = 0; $i < $numTokens; ++$i) {
            $token = $tokens[$i];
            $skip  = 0;

            if (is_array($token)) {
                $name = substr(token_name($token[0]), 2);
                $text = $token[1];

                if ($lastNonWhitespaceTokenWasDoubleColon && $name == 'CLASS') {
                    $name = 'CLASS_NAME_CONSTANT';
<<<<<<< HEAD
                } elseif ($name == 'USE' && isset($tokens[$i + 2][0]) && $tokens[$i + 2][0] == T_FUNCTION) {
=======
                } elseif ($name == 'USE' && isset($tokens[$i+2][0]) && $tokens[$i+2][0] == T_FUNCTION) {
>>>>>>> release/v2
                    $name = 'USE_FUNCTION';
                    $skip = 2;
                }

                $tokenClass = 'PHP_Token_' . $name;
            } else {
                $text       = $token;
                $tokenClass = self::$customTokens[$token];
            }

            $this->tokens[] = new $tokenClass($text, $line, $this, $id++);
            $lines          = substr_count($text, "\n");
<<<<<<< HEAD
            $line += $lines;
=======
            $line          += $lines;
>>>>>>> release/v2

            if ($tokenClass == 'PHP_Token_HALT_COMPILER') {
                break;
            } elseif ($tokenClass == 'PHP_Token_COMMENT' ||
                $tokenClass == 'PHP_Token_DOC_COMMENT') {
                $this->linesOfCode['cloc'] += $lines + 1;
            }

            if ($name == 'DOUBLE_COLON') {
                $lastNonWhitespaceTokenWasDoubleColon = true;
            } elseif ($name != 'WHITESPACE') {
                $lastNonWhitespaceTokenWasDoubleColon = false;
            }

            $i += $skip;
        }

        $this->linesOfCode['loc']   = substr_count($sourceCode, "\n");
        $this->linesOfCode['ncloc'] = $this->linesOfCode['loc'] -
                                      $this->linesOfCode['cloc'];
    }

    /**
<<<<<<< HEAD
     * @return int
=======
     * @return integer
>>>>>>> release/v2
     */
    public function count()
    {
        return count($this->tokens);
    }

    /**
     * @return PHP_Token[]
     */
    public function tokens()
    {
        return $this->tokens;
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        if ($this->classes !== null) {
            return $this->classes;
        }

        $this->parse();

        return $this->classes;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        if ($this->functions !== null) {
            return $this->functions;
        }

        $this->parse();

        return $this->functions;
    }

    /**
     * @return array
     */
    public function getInterfaces()
    {
        if ($this->interfaces !== null) {
            return $this->interfaces;
        }

        $this->parse();

        return $this->interfaces;
    }

    /**
     * @return array
<<<<<<< HEAD
=======
     * @since  Method available since Release 1.1.0
>>>>>>> release/v2
     */
    public function getTraits()
    {
        if ($this->traits !== null) {
            return $this->traits;
        }

        $this->parse();

        return $this->traits;
    }

    /**
     * Gets the names of all files that have been included
     * using include(), include_once(), require() or require_once().
     *
     * Parameter $categorize set to TRUE causing this function to return a
     * multi-dimensional array with categories in the keys of the first dimension
     * and constants and their values in the second dimension.
     *
     * Parameter $category allow to filter following specific inclusion type
     *
     * @param bool   $categorize OPTIONAL
     * @param string $category   OPTIONAL Either 'require_once', 'require',
<<<<<<< HEAD
     *                           'include_once', 'include'.
     *
     * @return array
=======
     *                                           'include_once', 'include'.
     * @return array
     * @since  Method available since Release 1.1.0
>>>>>>> release/v2
     */
    public function getIncludes($categorize = false, $category = null)
    {
        if ($this->includes === null) {
<<<<<<< HEAD
            $this->includes = [
              'require_once' => [],
              'require'      => [],
              'include_once' => [],
              'include'      => []
            ];
=======
            $this->includes = array(
              'require_once' => array(),
              'require'      => array(),
              'include_once' => array(),
              'include'      => array()
            );
>>>>>>> release/v2

            foreach ($this->tokens as $token) {
                switch (get_class($token)) {
                    case 'PHP_Token_REQUIRE_ONCE':
                    case 'PHP_Token_REQUIRE':
                    case 'PHP_Token_INCLUDE_ONCE':
                    case 'PHP_Token_INCLUDE':
                        $this->includes[$token->getType()][] = $token->getName();
                        break;
                }
            }
        }

        if (isset($this->includes[$category])) {
            $includes = $this->includes[$category];
        } elseif ($categorize === false) {
            $includes = array_merge(
                $this->includes['require_once'],
                $this->includes['require'],
                $this->includes['include_once'],
                $this->includes['include']
            );
        } else {
            $includes = $this->includes;
        }

        return $includes;
    }

    /**
     * Returns the name of the function or method a line belongs to.
     *
     * @return string or null if the line is not in a function or method
<<<<<<< HEAD
=======
     * @since  Method available since Release 1.2.0
>>>>>>> release/v2
     */
    public function getFunctionForLine($line)
    {
        $this->parse();

        if (isset($this->lineToFunctionMap[$line])) {
            return $this->lineToFunctionMap[$line];
        }
    }

    protected function parse()
    {
<<<<<<< HEAD
        $this->interfaces = [];
        $this->classes    = [];
        $this->traits     = [];
        $this->functions  = [];
        $class            = [];
        $classEndLine     = [];
=======
        $this->interfaces = array();
        $this->classes    = array();
        $this->traits     = array();
        $this->functions  = array();
        $class            = array();
        $classEndLine     = array();
>>>>>>> release/v2
        $trait            = false;
        $traitEndLine     = false;
        $interface        = false;
        $interfaceEndLine = false;

        foreach ($this->tokens as $token) {
            switch (get_class($token)) {
                case 'PHP_Token_HALT_COMPILER':
                    return;

                case 'PHP_Token_INTERFACE':
                    $interface        = $token->getName();
                    $interfaceEndLine = $token->getEndLine();

<<<<<<< HEAD
                    $this->interfaces[$interface] = [
                      'methods'   => [],
=======
                    $this->interfaces[$interface] = array(
                      'methods'   => array(),
>>>>>>> release/v2
                      'parent'    => $token->getParent(),
                      'keywords'  => $token->getKeywords(),
                      'docblock'  => $token->getDocblock(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $interfaceEndLine,
                      'package'   => $token->getPackage(),
                      'file'      => $this->filename
<<<<<<< HEAD
                    ];
=======
                    );
>>>>>>> release/v2
                    break;

                case 'PHP_Token_CLASS':
                case 'PHP_Token_TRAIT':
<<<<<<< HEAD
                    $tmp = [
                      'methods'   => [],
=======
                    $tmp = array(
                      'methods'   => array(),
>>>>>>> release/v2
                      'parent'    => $token->getParent(),
                      'interfaces'=> $token->getInterfaces(),
                      'keywords'  => $token->getKeywords(),
                      'docblock'  => $token->getDocblock(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $token->getEndLine(),
                      'package'   => $token->getPackage(),
                      'file'      => $this->filename
<<<<<<< HEAD
                    ];
=======
                    );
>>>>>>> release/v2

                    if ($token instanceof PHP_Token_CLASS) {
                        $class[]        = $token->getName();
                        $classEndLine[] = $token->getEndLine();

<<<<<<< HEAD
                        $this->classes[$class[count($class) - 1]] = $tmp;
=======
                        if ($class[count($class)-1] != 'anonymous class') {
                            $this->classes[$class[count($class)-1]] = $tmp;
                        }
>>>>>>> release/v2
                    } else {
                        $trait                = $token->getName();
                        $traitEndLine         = $token->getEndLine();
                        $this->traits[$trait] = $tmp;
                    }
                    break;

                case 'PHP_Token_FUNCTION':
                    $name = $token->getName();
<<<<<<< HEAD
                    $tmp  = [
=======
                    $tmp  = array(
>>>>>>> release/v2
                      'docblock'  => $token->getDocblock(),
                      'keywords'  => $token->getKeywords(),
                      'visibility'=> $token->getVisibility(),
                      'signature' => $token->getSignature(),
                      'startLine' => $token->getLine(),
                      'endLine'   => $token->getEndLine(),
                      'ccn'       => $token->getCCN(),
                      'file'      => $this->filename
<<<<<<< HEAD
                    ];
=======
                    );
>>>>>>> release/v2

                    if (empty($class) &&
                        $trait === false &&
                        $interface === false) {
                        $this->functions[$name] = $tmp;

                        $this->addFunctionToMap(
                            $name,
                            $tmp['startLine'],
                            $tmp['endLine']
                        );
<<<<<<< HEAD
                    } elseif (!empty($class)) {
                        $this->classes[$class[count($class) - 1]]['methods'][$name] = $tmp;

                        $this->addFunctionToMap(
                            $class[count($class) - 1] . '::' . $name,
=======
                    } elseif (!empty($class) && $class[count($class)-1] != 'anonymous class') {
                        $this->classes[$class[count($class)-1]]['methods'][$name] = $tmp;

                        $this->addFunctionToMap(
                            $class[count($class)-1] . '::' . $name,
>>>>>>> release/v2
                            $tmp['startLine'],
                            $tmp['endLine']
                        );
                    } elseif ($trait !== false) {
                        $this->traits[$trait]['methods'][$name] = $tmp;

                        $this->addFunctionToMap(
                            $trait . '::' . $name,
                            $tmp['startLine'],
                            $tmp['endLine']
                        );
                    } else {
                        $this->interfaces[$interface]['methods'][$name] = $tmp;
                    }
                    break;

                case 'PHP_Token_CLOSE_CURLY':
                    if (!empty($classEndLine) &&
<<<<<<< HEAD
                        $classEndLine[count($classEndLine) - 1] == $token->getLine()) {
=======
                        $classEndLine[count($classEndLine)-1] == $token->getLine()) {
>>>>>>> release/v2
                        array_pop($classEndLine);
                        array_pop($class);
                    } elseif ($traitEndLine !== false &&
                        $traitEndLine == $token->getLine()) {
                        $trait        = false;
                        $traitEndLine = false;
                    } elseif ($interfaceEndLine !== false &&
                        $interfaceEndLine == $token->getLine()) {
                        $interface        = false;
                        $interfaceEndLine = false;
                    }
                    break;
            }
        }
    }

    /**
     * @return array
     */
    public function getLinesOfCode()
    {
        return $this->linesOfCode;
    }

    /**
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
<<<<<<< HEAD
     * @return bool
=======
     * @return boolean
>>>>>>> release/v2
     */
    public function valid()
    {
        return isset($this->tokens[$this->position]);
    }

    /**
<<<<<<< HEAD
     * @return int
=======
     * @return integer
>>>>>>> release/v2
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return PHP_Token
     */
    public function current()
    {
        return $this->tokens[$this->position];
    }

    /**
     */
    public function next()
    {
        $this->position++;
    }

    /**
<<<<<<< HEAD
     * @param int $offset
     *
     * @return bool
=======
     * @param  integer $offset
     * @return boolean
>>>>>>> release/v2
     */
    public function offsetExists($offset)
    {
        return isset($this->tokens[$offset]);
    }

    /**
<<<<<<< HEAD
     * @param int $offset
     *
     * @return mixed
     *
=======
     * @param  integer $offset
     * @return mixed
>>>>>>> release/v2
     * @throws OutOfBoundsException
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfBoundsException(
                sprintf(
                    'No token at position "%s"',
                    $offset
                )
            );
        }

        return $this->tokens[$offset];
    }

    /**
<<<<<<< HEAD
     * @param int   $offset
     * @param mixed $value
=======
     * @param integer $offset
     * @param mixed   $value
>>>>>>> release/v2
     */
    public function offsetSet($offset, $value)
    {
        $this->tokens[$offset] = $value;
    }

    /**
<<<<<<< HEAD
     * @param int $offset
     *
=======
     * @param  integer $offset
>>>>>>> release/v2
     * @throws OutOfBoundsException
     */
    public function offsetUnset($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new OutOfBoundsException(
                sprintf(
                    'No token at position "%s"',
                    $offset
                )
            );
        }

        unset($this->tokens[$offset]);
    }

    /**
     * Seek to an absolute position.
     *
<<<<<<< HEAD
     * @param int $position
     *
=======
     * @param  integer $position
>>>>>>> release/v2
     * @throws OutOfBoundsException
     */
    public function seek($position)
    {
        $this->position = $position;

        if (!$this->valid()) {
            throw new OutOfBoundsException(
                sprintf(
                    'No token at position "%s"',
                    $this->position
                )
            );
        }
    }

    /**
<<<<<<< HEAD
     * @param string $name
     * @param int    $startLine
     * @param int    $endLine
=======
     * @param string  $name
     * @param integer $startLine
     * @param integer $endLine
>>>>>>> release/v2
     */
    private function addFunctionToMap($name, $startLine, $endLine)
    {
        for ($line = $startLine; $line <= $endLine; $line++) {
            $this->lineToFunctionMap[$line] = $name;
        }
    }
}
