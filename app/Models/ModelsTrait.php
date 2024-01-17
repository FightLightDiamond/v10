<?php

/**
 * Created by cuongpm/modularization.
 * User: e
 * Date: 1/7/17
 * Time: 1:36 PM
 */

namespace App\Models;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait ModelsTrait
{

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function creatorName($field = 'email')
    {
        if ($this->creator) {
            return $this->creator->$field;
        }
        return '--';
    }

    public function updaterName($field = 'email')
    {
        if ($this->updater) {
            return $this->updater->$field;
        }
        return '--';
    }

    //======================SCOPE===============================>

    public function scopeFilter($query, $params)
    {
        foreach ($params as $field => $value) {
            if ($value === '' || $value === null) {
                continue;
            }

            $method = 'filter' . Str::studly($field);

            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
                continue;
            }

            if (in_array($field, $this->fillable, true)) {
                $query->where($this->table . '.' . $field, $value);
                continue;
            }

            if ($field === 'sort') {
                $query->sortBy($value);
                continue;
            }

            if ($field === 'my') {
                $query->my();
                continue;
            }

            if ($field === 'relationship') {
                $query->with($value);
            }
        }

        return $query;
    }

    public function scopeSortBy($query, $value)
    {
        $sorts = explode('|', $value);

        return $query->orderBy($sorts[0], $sorts[1]);
    }

    public function scopeOrders($query, $input = [])
    {
        foreach ($input as $field => $sortBy) {
            $query->orderBy($this->table . '.' . $field, $sortBy);
        }

        return $query;
    }

    public function scopeMy($query, $field = 'user_id')
    {
        if (in_array($field, $this->fillable)) {
            return $query->where($this->table . '.' . $field, Auth::id());
        }

        return $query;
    }


    public function uploadImport($file)
    {

        $file->storeAs(
            $this->table
        );

        return storage_path("app/{$this->table}/{$file}");
    }
}
