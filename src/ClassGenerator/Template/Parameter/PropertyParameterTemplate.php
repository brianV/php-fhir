<?php namespace DCarbone\PHPFHIR\ClassGenerator\Template\Parameter;

/*
 * Copyright 2016-2018 Daniel Carbone (daniel.p.carbone@gmail.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use DCarbone\PHPFHIR\ClassGenerator\Config;
use DCarbone\PHPFHIR\ClassGenerator\Template\Property\BasePropertyTemplate;
use DCarbone\PHPFHIR\ClassGenerator\Utilities\NameUtils;

/**
 * Class PropertyParameterTemplate
 * @package DCarbone\PHPFHIR\ClassGenerator\Template\Parameter
 */
class PropertyParameterTemplate extends BaseParameterTemplate
{
    /** @var BasePropertyTemplate */
    private $_property;

    /**
     * PropertyParameterTemplate constructor.
     * @param \DCarbone\PHPFHIR\ClassGenerator\Config $config
     * @param \DCarbone\PHPFHIR\ClassGenerator\Template\Property\BasePropertyTemplate $propertyTemplate
     */
    public function __construct(Config $config, BasePropertyTemplate $propertyTemplate)
    {
        parent::__construct($config, $propertyTemplate->getName(), $propertyTemplate->getPHPType());
        $this->_property = $propertyTemplate;
    }

    /**
     * @return string
     */
    public function getParamDocBlockFragment()
    {
        $property = $this->getProperty();

        return sprintf(
            '@param %s%s %s',
            $property->isPrimitive() || $property->isList() ? '' : '\\',
            $property->getPHPType(),
            NameUtils::getPropertyVariableName($property->getName())
        );
    }

    /**
     * @return BasePropertyTemplate
     */
    public function getProperty()
    {
        return $this->_property;
    }
}