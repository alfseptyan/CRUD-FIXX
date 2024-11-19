<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    /**
     * Create a new resource instance.
     *
     * @param mixed $status
     * @param mixed $message
     * @param mixed $resource
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => parent::toArray($request),
        ];
    }
}
