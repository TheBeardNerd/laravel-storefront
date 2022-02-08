<?php

namespace App\Traits;

use App\Models\Activity;

trait RecordsActivity
{
    /**
     * The old attributes for the model.
     *
     * @var array
     */
    public $oldAttributes = [];

    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    /**
     * Fetch the description of the activity.
     *
     * @param string $description
     * @return string
     */
    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * Fetch the model events that should record activity.
     *
     * @return array
     */
    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated', 'deleted'];

    }

    /**
     * The activity feed for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    /**
     * Record activity for the model.
     *
     * @param  string $type
     */
    public function recordActivity($type)
    {
        $this->activity()->create([
            'description' => $type,
            'changes' =>  $this->activityChanges(),
            'product_id' => class_basename($this) === 'Product' ? $this->id : $this->product_id
        ]);
    }

    /**
     * Fetch changes to the model.
     *
     * @return array|null
     */
    public function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                    'before' => array_diff($this->oldAttributes, $this->getAttributes()),
                    'after' => $this->getChanges()
            ];
        }
    }
}
