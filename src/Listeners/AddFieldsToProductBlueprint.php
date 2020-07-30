<?php

namespace DoubleThreeDigital\DigitalProducts\Listeners;

use Statamic\Events\EntryBlueprintFound;

class AddFieldsToProductBlueprint
{
    public function handle(EntryBlueprintFound $event)
    {
        if ($event->blueprint->namespace() !== "collections.".config('simple-commerce.collections.products')) {
            return ;
        }

        $event->blueprint->ensureField('is_digital_product', [
            'type' => 'toggle',
            'display' => 'Is Digital Product?',
        ], 'Digital Product');

        $event->blueprint->ensureField('downloadable_asset', [
            'type' => 'assets',
            'mode' => 'grid',
            'display' => 'Downloadable Asset',
            'max_files' => 1,
            'if' => [
                'is_digital_product' => 'equals true',
            ],
        ], 'Digital Product');
    }
}
