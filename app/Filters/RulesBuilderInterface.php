<?php

namespace App\Filters;

interface RulesBuilderInterface
{
    public function build(array $config);

    /**
     * @return array
     */
    public function getHideOthersRules(): array;

    /**
     * @return array
     */
    public function getRules(): array;
}
