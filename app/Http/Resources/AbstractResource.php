<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class AbstractResource extends JsonResource
{
    protected ?string $_message;

    /**
     * AbstractResource constructor.
     */
    public function __construct($resource, string $message = null)
    {
        $this->_message = $message;
        if ($this->_message) {
            $this->with = ['message' => $this->_message];
        }
        parent::__construct($resource);
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->_message = $message;
        if ($this->_message) {
            $this->with = ['message' => $this->_message];
        }
    }
}
