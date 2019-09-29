<?php


namespace App\IM\Handler;


use Hyperf\Utils\Contracts\Jsonable;
use Swoole\Process;

class Operate implements Jsonable
{
    protected $op;

    protected $message;

    protected $data;

    public function __construct(int $op, string $message = null, array $data = [])
    {
        $this->op = $op;
        $this->message = $message ?? CodeEnum::getMessage($op);
        $this->data = $data;
    }

    public function __toString(): string
    {
        return json_encode([
            'op' => $this->op,
            'message' => $this->message,
            'data' => $this->data,
        ]);
    }

    /**
     * @return int
     */
    public function getOp(): int
    {
        return $this->op;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param Operate $operate
     * @return bool
     * TODO: array equal array
     */
    public function equal(Operate $operate): bool
    {
        return $operate->getMessage() === $this->getMessage() &&
            $operate->getOp() === $this->getOp() &&
            $operate->getData() === $this->getData();
    }
}