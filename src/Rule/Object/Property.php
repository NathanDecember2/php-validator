<?php

declare(strict_types=1);

namespace SimpleAsFuck\Validator\Rule\Object;

use SimpleAsFuck\Validator\Rule\ArrayRule\ArrayRule;
use SimpleAsFuck\Validator\Rule\General\Rule;
use SimpleAsFuck\Validator\Rule\Numeric\BoolRule;
use SimpleAsFuck\Validator\Rule\Numeric\FloatRule;
use SimpleAsFuck\Validator\Rule\Numeric\IntRule;
use SimpleAsFuck\Validator\Rule\String\StringRule;

/**
 * @extends Rule<object, mixed>
 */
final class Property extends Rule
{
    private string $propertyName;

    /**
     * @param Rule<mixed, object> $rule
     */
    public function __construct(Rule $rule, string $propertyName)
    {
        parent::__construct($rule->exceptionFactory(), $rule->ruleChain(), $rule->validated(), $rule->valueName().'->'.$propertyName);
        $this->propertyName = $propertyName;
    }

    public function string(): StringRule
    {
        return new StringRule($this->exceptionFactory(), $this->ruleChain(), $this->validated(), $this->valueName());
    }

    public function int(): IntRule
    {
        return new IntRule($this->exceptionFactory(), $this->ruleChain(), $this->validated(), $this->valueName());
    }

    public function float(): FloatRule
    {
        return new FloatRule($this->exceptionFactory(), $this->ruleChain(), $this->validated(), $this->valueName());
    }

    public function bool(): BoolRule
    {
        return new BoolRule($this->exceptionFactory(), $this->ruleChain(), $this->validated(), $this->valueName());
    }

    public function object(): ObjectRule
    {
        return new ObjectRule($this->exceptionFactory(), $this->ruleChain(), $this->validated(), $this->valueName());
    }

    public function array(): ArrayRule
    {
        return new ArrayRule($this->exceptionFactory(), $this->ruleChain(), $this->validated(), $this->valueName());
    }

    /**
     * @param object $value
     * @return mixed|null
     */
    protected function validate($value)
    {
        if (property_exists($value, $this->propertyName)) {
            return $value->{$this->propertyName};
        }

        return null;
    }
}
