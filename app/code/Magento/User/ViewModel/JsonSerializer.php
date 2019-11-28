<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\User\ViewModel;

/**
 * JsonSerializer
 */
class JsonSerializer implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serializer;

    /**
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     */
    public function __construct(\Magento\Framework\Serialize\Serializer\Json $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Returns serialized version of data
     *
     * @param array $data
     * @return string
     */
    public function serialize(array $data): string
    {
        $result = json_encode($data, JSON_HEX_APOS);
        if (false === $result) {
            throw new \InvalidArgumentException("Unable to serialize value. Error: " . json_last_error_msg());
        }
        return $result;
    }
}
