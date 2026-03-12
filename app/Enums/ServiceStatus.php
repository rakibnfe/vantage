<?php

namespace App\Enums;

enum ServiceStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::ARCHIVED => 'Archived',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::DRAFT => 'yellow',
            self::PUBLISHED => 'green',
            self::ARCHIVED => 'gray',
        };
    }

    public static function forSelect(): array
    {
        return [
            self::DRAFT->value => self::DRAFT->label(),
            self::PUBLISHED->value => self::PUBLISHED->label(),
            self::ARCHIVED->value => self::ARCHIVED->label(),
        ];
    }
}