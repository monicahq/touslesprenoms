<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait Translatable
{
    /**
     * Get the label of the given object.
     * The object can have a default label that can be translated.
     * However, if a label exists, it will be used instead of the default one.
     *
     * @return Attribute<string,never>
     */
    protected function label(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if (! $value) {
                    return __($attributes['label_translation_key']);
                }

                return $value;
            }
        );
    }
}
