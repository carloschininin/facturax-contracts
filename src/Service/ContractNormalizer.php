<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Service;

use Symfony\Component\Serializer\SerializerInterface;

final readonly class ContractNormalizer
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $dto): array
    {
        /** @var array<string, mixed> $data */
        $data = $this->serializer->normalize($dto, 'array');

        return $data;
    }
}

