<?php

namespace App\Modules\Options\Services;

use App\Modules\Options\Models\Option;
use Illuminate\Database\Eloquent\Collection;

class OptionService
{
    public function getAll(): Collection
    {
        return Option::orderBy('key')->get();
    }

    public function findOrFail(int $id): Option
    {
        return Option::findOrFail($id);
    }

    public function create(array $data): Option
    {
        return Option::create($data);
    }

    public function update(Option $option, array $data): Option
    {
        $option->update($data);

        return $option->fresh();
    }

    public function delete(Option $option): void
    {
        $option->delete();
    }
}
