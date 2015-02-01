<?php namespace thinkspill;

use \ReflectionClass;
use \ReflectionMethod;

class FindMethodExceptions
{
    protected $matches = [];

    public function find($class, $method_name = false)
    {
        if (!class_exists($class)) {
            return "Class not found";
        }
        $reflection = new ReflectionClass($class);
        if ($method_name) {
            $this->analyze_method($class, $method_name);
        } else {
            $methods = $reflection->getMethods();
            foreach ($methods as $method) {
                $this->analyze_method($class, $method->name);
            }
        }
        return $this->matches;
    }

    /**
     * @param $class
     * @param $method
     */
    private function analyze_method($class, $method)
    {
        $reflected_method = new ReflectionMethod($class, $method);
        $filename = $reflected_method->getFileName();
        $file = file($filename);
        if (!$file) {
            return;
        }
        $startline = $reflected_method->getStartLine();
        $endline = $reflected_method->getEndLine();
        $source = '';
        for ($i = $startline; $i <= $endline; $i++) {
            //$this->try_preg_match_all($method, $file, $i);
            $source .= $file[$i];
        }
        $this->try_tokenizing($method, $source);
    }

    /**
     * @param $method
     * @param $source
     */
    private function try_tokenizing($method, $source)
    {
        $source = "<?php " . trim($source, " {}\r\n") . " ?>";

        $tokens = token_get_all($source);

        $t = array_map(function ($token) {
            if (is_array(($token))) {
                $v['token_index'] = $token[0];
                $v['string_content'] = $token[1];
                $v['line_number'] = $token[2];
                $v['token_name'] = token_name($token[0]);
                return $v;
            } else {
                return $token;
            }

        }, $tokens);
        $res = [];
        for ($i = 0; $i < count($t); $i++) {
            if (
                !empty($t[$i]['token_name']) && $t[$i]['token_name'] == 'T_THROW' &&
                !empty($t[$i + 2]) && $t[$i + 2]['token_name'] == 'T_NEW' &&
                !empty($t[$i + 4]) && $t[$i + 4]['token_name'] == 'T_STRING'
            ) {
                $res[] = $t[$i + 4]['string_content'];
            }
        }

        $this->matches[$method] = $res;
    }

    /**
     * @param $method
     * @param $file
     * @param $i
     */
    private function try_preg_match_all($method, $file, $i)
    {
        $line = trim($file[$i]);
        if ($matches = $this->find_matches($line)) {
            if (empty($this->matches[$method])) {
                $this->matches[$method] = [];
            }
            $this->matches[$method] = array_merge($this->matches[$method], $matches);
        }
    }

    /**
     * @param $line
     * @return mixed
     */
    private function find_matches($line)
    {
        if (strpos($line, 'throw') === false) return false;
        $matches = [];
        $res = [];
        preg_match_all('/(.*throw[\n\r ]new[\n\r ]([_a-z0-9]*)[($a-z)]*;)+/iU', $line, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $res[] = $m[2];
        }

        if (count($res)) {
            return $res;
        } else return false;
    }
}
