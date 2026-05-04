<?php

namespace App\Traits;

use App\Models\Movement;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        foreach (static::getActivitiesToLog() as $event) {
            static::$event(function ($model) use ($event) {
                $model->logActivity($event);
            });
        }
    }

    protected static function getActivitiesToLog()
    {
        return ['created', 'updated', 'deleted'];
    }

    protected function logActivity(string $event)
    {
        $description = $this->getActivityDescription($event);
        
        $oldValues = null;
        $newValues = null;

        if ($event === 'updated') {
            $oldValues = array_intersect_key($this->getOriginal(), $this->getDirty());
            $newValues = $this->getDirty();
            
            // Don't log if only timestamps changed
            if (count($newValues) === 1 && isset($newValues['updated_at'])) {
                return;
            }
            
            // Remove updated_at from logs
            unset($oldValues['updated_at'], $newValues['updated_at']);
            
            if (empty($newValues)) {
                return;
            }
        } elseif ($event === 'created') {
            $newValues = $this->getAttributes();
            unset($newValues['created_at'], $newValues['updated_at']);
        } elseif ($event === 'deleted') {
            $oldValues = $this->getAttributes();
            unset($oldValues['created_at'], $oldValues['updated_at']);
        }

        Movement::create([
            'user_id' => Auth::id(),
            'action' => $event,
            'movable_type' => get_class($this),
            'movable_id' => $this->id,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }

    protected function getActivityDescription(string $event): string
    {
        $modelName = class_basename($this);
        $name = $this->name ?? $this->id;

        switch ($event) {
            case 'created':
                return "Se creó el registro de $modelName: $name";
            case 'updated':
                return "Se actualizó el registro de $modelName: $name";
            case 'deleted':
                return "Se eliminó el registro de $modelName: $name";
            default:
                return "Acción $event en $modelName: $name";
        }
    }
}
