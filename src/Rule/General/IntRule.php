<?php

declare(strict_types=1);

namespace SimpleAsFuck\Validator\Rule\General;

/**
 * @template TIn
 * @extends ReadableRule<TIn, int>
 */
abstract class IntRule extends ReadableRule
{
    /**
     * @return MinWithMax<int, int>
     */
    final public function min(int $min): MinWithMax
    {
        /** @var MinWithMax<int, int> $minRule */
        $minRule = new MinWithMax(
            $this->exceptionFactory(),
            /** @phpstan-ignore-next-line */
            $this->ruleChain(),
            $this->validated(),
            $this->valueName(),
            new ComparedValue(),
            /** @phpstan-ignore-next-line */
            new CastString(),
            $min
        );
        return $minRule;
    }

    /**
     * @return Max<int, int>
     */
    final public function max(int $max): Max
    {
        /** @var Max<int, int> $maxRule */
        $maxRule = new Max(
            $this->exceptionFactory(),
            /** @phpstan-ignore-next-line */
            $this->ruleChain(),
            $this->validated(),
            $this->valueName(),
            new ComparedValue(),
            /** @phpstan-ignore-next-line */
            new CastString(),
            $max
        );
        return $maxRule;
    }

    /**
     * @param non-empty-array<int> $values
     * @return InRule<int>
     */
    final public function in(array $values): InRule
    {
        /** @var InRule<int> $inRule */
        $inRule = new InRule(
            $this->exceptionFactory(),
            /** @phpstan-ignore-next-line */
            $this->ruleChain(),
            $this->validated(),
            $this->valueName(),
            /** @phpstan-ignore-next-line */
            new ComparedValue(),
            $values
        );
        return $inRule;
    }
}
