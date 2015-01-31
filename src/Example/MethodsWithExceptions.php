<?php namespace thinkspill\Example;

class MethodsWithExceptions
{
    public function throwsNoExceptions()
    {
        return 'Hello';
    }

    public function throwsOneException()
    {
        throw new Ex_1;
    }

    public function throwsOneExceptionWithBraces()
    {
        throw new Ex_1();
    }

    public function throwsOneExceptionWithBracesAndVariables($a)
    {
        throw new Ex_1($a);
    }

    public function throwsTwoExceptions($a = false)
    {
        if ($a) {
            throw new Ex_1;
        } else {
            throw new Ex_2;
        }
    }

    public function throwsTwoExceptionsWithBraces($a = false)
    {
        if ($a) {
            throw new Ex_1();
        } else {
            throw new Ex_2();
        }
    }

    public function throwsTwoExceptionsWithBracesAndVariables($a = false)
    {
        if ($a) {
            throw new Ex_1($a);
        } else {
            throw new Ex_2($a);
        }
    }

    public function throwsTwoExceptionsOnOneLine($a = false)
    {   #@formatter:off
        if ($a) { throw new Ex_4; } else { throw new Ex_5; }
    }

    public function throwsThreeExceptionsOnOneLine($a = false, $b = false)
    {   #@formatter:off
        if ($a) { throw new Ex_1(); } elseif ($b) { throw new Ex_2; } else { throw new Ex_3; }
    }

    public function throwsSixExceptionsOnTwoLines($a = false, $b = false, $c = false)
    {   #@formatter:off
        if ($a) { throw new Ex_4; } elseif ($b) { throw new Ex_5; } elseif ($a && $b) { throw new Ex_6; }
        elseif (!$a) { throw new Ex_1; } elseif (!$b) { throw new Ex_2; } else { throw new Ex_3; }
    }
}

class Ex_1 extends \Exception{}
class Ex_2 extends \Exception{}
class Ex_3 extends \Exception{}
class Ex_4 extends \Exception{}
class Ex_5 extends \Exception{}
class Ex_6 extends \Exception{}