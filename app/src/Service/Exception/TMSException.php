<?php

namespace App\Service\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

class TMSException extends JsonResponse
{
    /**
     * Messages with status code below STATUS_ERROR will be sent as OK
     */
    private const STATUS_ERROR = 300;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $status;

    public function __construct(
        $message = [],
        int $statusCode = 200
    )
    {
        $this->status = ($statusCode < self::STATUS_ERROR) ? 'OK' : 'ERROR';
        $this->message = [ 
            'status' => $this->status,
            'message' => $message ];
        $this->statusCode = $statusCode;
        parent::__construct($this->message, $this->statusCode, []);
    }
}