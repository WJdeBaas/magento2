<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types = 1);

namespace Magento\Framework\GraphQl\Type\Output\ElementMapper\Formatter;

use Magento\Framework\GraphQl\Type\Definition\OutputType;
use Magento\Framework\GraphQl\Config\Data\TypeInterface;
use Magento\Framework\GraphQl\Config\Data\Type;
use Magento\Framework\GraphQl\Type\Output\ElementMapper\FormatterInterface;
use Magento\Framework\GraphQl\Type\Output\OutputMapper;

/**
 * Add interfaces implemented by type if configured.
 */
class Interfaces implements FormatterInterface
{
    /**
     * @var OutputMapper
     */
    private $outputMapper;

    /**
     * @param OutputMapper $outputMapper
     */
    public function __construct(OutputMapper $outputMapper)
    {
        $this->outputMapper = $outputMapper;
    }

    /**
     * {@inheritDoc}
     */
    public function format(TypeInterface $typeStructure, OutputType $outputType) : array
    {
        $config = [];
        if ($typeStructure instanceof Type && !empty($typeStructure->getInterfaces())) {
            $interfaces = [];
            foreach ($typeStructure->getInterfaces() as $interface) {
                $interfaces[$interface['interface']] = $this->outputMapper->getOutputType($interface['interface']);
            }
            $config['interfaces'] = $interfaces;
        }

        return $config;
    }
}
