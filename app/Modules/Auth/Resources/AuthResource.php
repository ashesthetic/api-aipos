<?php

namespace App\Modules\Auth\Resources;

use App\Modules\Users\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function __construct(private readonly array $authData)
    {
        parent::__construct($authData);
    }

    public function toArray(Request $request): array
    {
        return [
            'token' => $this->authData['token'],
            'user'  => new UserResource($this->authData['user']),
        ];
    }
}
