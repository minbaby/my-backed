<?php


namespace App\IM\Packet;

use App\Constants\StatusEnum;
use App\Traits\ArrayableTrait;
use Hyperf\Utils\Contracts\Arrayable;

class ResponseBody implements Arrayable
{
    use ArrayableTrait;

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string | null
     */
    protected $message;

    protected $data = [];

    /**
     * @param string $code
     * @param string $message
     * @param array $data
     */
    public function __construct(
        string $code = StatusEnum::OK,
        string $message = null,
        $data = []
    )
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }


    /**
     * @param int $code
     * @return ResponseBody
     */
    public function setCode(int $code): ResponseBody
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param string $message
     * @return ResponseBody
     */
    public function setMessage(string $message): ResponseBody
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param array $data
     * @return ResponseBody
     */
    public function setData(array $data): ResponseBody
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        if ($this->message === null && $this->getCode() !== null) {
            return StatusEnum::getMessage($this->getCode());
        }
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}