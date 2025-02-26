<?php

declare(strict_types=1);

namespace Shlinkio\Shlink\Rest\ApiKey\Model;

use Cake\Chronos\Chronos;
use Ramsey\Uuid\Uuid;

final readonly class ApiKeyMeta
{
    /**
     * @param iterable<RoleDefinition> $roleDefinitions
     */
    private function __construct(
        public string $key,
        public string|null $name,
        public Chronos|null $expirationDate,
        public iterable $roleDefinitions,
    ) {
    }

    public static function empty(): self
    {
        return self::fromParams();
    }

    /**
     * @param iterable<RoleDefinition> $roleDefinitions
     */
    public static function fromParams(
        string|null $key = null,
        string|null $name = null,
        Chronos|null $expirationDate = null,
        iterable $roleDefinitions = [],
    ): self {
        return new self(
            key: $key ?? Uuid::uuid4()->toString(),
            name: $name,
            expirationDate: $expirationDate,
            roleDefinitions: $roleDefinitions,
        );
    }

    public static function withRoles(RoleDefinition ...$roleDefinitions): self
    {
        return self::fromParams(roleDefinitions: $roleDefinitions);
    }
}
