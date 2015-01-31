<?php

namespace spec\thinkspill;
xdebug_disable();
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

require_once __DIR__ . '/../vendor/autoload.php';


class FindMethodExceptionsSpec extends ObjectBehavior
{
    protected $class = '\thinkspill\Example\MethodsWithExceptions';

    function it_is_initializable()
    {
        $this->shouldHaveType('\thinkspill\FindMethodExceptions');
    }

    function it_finds_an_exception_in_a_class_with_just_one()
    {
        $method = 'throwsOneException';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
    }

    function it_finds_an_exception_with_braces_in_a_class_with_just_one()
    {
        $method = 'throwsOneExceptionWithBraces';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
    }

    function it_finds_an_exception_with_braces_and_variables_in_a_class_with_just_one()
    {
        $method = 'throwsOneExceptionWithBracesAndVariables';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
    }

    function it_finds_two_exceptions_in_a_class_with_just_two()
    {
        $method = 'throwsTwoExceptions';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_2');
    }

    function it_finds_two_exceptions_with_braces_in_a_class_with_just_two()
    {
        $method = 'throwsTwoExceptionsWithBraces';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_2');
    }

    function it_finds_two_exceptions_with_braces_and_variables_in_a_class_with_just_two()
    {
        $method = 'throwsTwoExceptionsWithBracesAndVariables';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_2');
    }

    function it_finds_two_exceptions_on_the_same_line()
    {
        $method = 'throwsTwoExceptionsOnOneLine';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_4');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_5');
    }

    function it_finds_three_exceptions_on_the_same_line()
    {
        $method = 'throwsThreeExceptionsOnOneLine';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_2');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_3');
    }

    function it_finds_six_exceptions_on_two_lines()
    {
        $method = 'throwsSixExceptionsOnTwoLines';
        $this->find($this->class, $method)->shouldHaveKey($method);
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_4');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_5');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_6');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_1');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_2');
        $this->find($this->class, $method)[$method]->shouldHaveValue('Ex_3');
    }

    public function getMatchers()
    {
        return [
            'haveKey' => function ($subject, $key) {
                return array_key_exists($key, $subject);
            },
            'haveValue' => function ($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }
}
