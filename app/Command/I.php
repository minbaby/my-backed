<?php

namespace App\Command;

use App\Utils\LogUtils;
use App\Utils\MemUtils;
use Hyperf\Command\Annotation\Command;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Redis\Redis;
use Hyperf\Utils\Str;
use MongoDB\Client;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Exception\UnexpectedValueException;
use Symfony\Component\Finder\Finder;
use function MongoDB\BSON\fromPHP;

/**
 * Class I
 * @package App\Command
 * @Command()
 */
class I extends \Hyperf\Command\Command
{
    protected $name = 'import';

    protected const PATH = '/e/data/BreachCompilation/data';

    /**
     * @var \SplFileInfo
     */
    private $file;

    /**
     * @var Redis
     * @Inject()
     */
    protected $redis;

    private $client;
    private $count = 1;
    /**
     * @var array
     */
    private $cache = [];
    private $total = 0;

    public function __construct(string $name = null)
    {
        parent::__construct($name);
        $this->client = new Client("mongodb://127.0.0.1:27017/");
    }

    /**
     * Handle the current command.
     */
    public function handle()
    {
        $this->yyy();
    }

    protected function yyy()
    {
        $finder = Finder::create()->in(static::PATH);
        /** @var \SplFileInfo $file */
        $c = ['err' => 0, 'succ' => 0];
        foreach ($finder->files() as $file) {
            $this->file = $file;
            $fp = $file->openFile();

            $this->line("begin: " . $this->file->getPathname());
            while (!$fp->eof() && $str = $fp->getCurrentLine()) {
                $delimiter = ':';
                if (Str::contains(';', $str)) {
                    $delimiter = ';';
                }

                $ex = explode($delimiter, trim($str));
                if (count($ex) != 2) {
                    $c['err'] += 1;
                    continue;
                }
                $c['succ'] += 1;

                $this->save2($ex);

                unset($ex, $delimiter);
                rand(0, 1000) == 1000 && $this->info(MemUtils::mem() . '=>');
            }
            unset($fp);
            $this->line("done: " . $this->file->getPathname());
        }

    }

    /**
     * @param $ex
     */
    protected function save2($ex)
    {
        $c = 100000;
        if ($this->count % $c !== 0) {
            $tmp = ['email' => $ex[0], 'pwd' => null];
            if (count($ex) == 2) {
                $tmp['pwd'] = $ex[1];
            }
            $this->cache[] = $tmp;
            $this->count++;
            return;
        }

        LogUtils::get(__METHOD__)->info(MemUtils::mem());

        $new = [];
        foreach ($this->cache as $e) {
            $this->safeH($e, $new, __LINE__);
        }

        if (!empty($new)) {
            $b = new BulkWrite();
            foreach ($new as $n) {
                $b->insert($n);
            }
            $this->client->getManager()->executeBulkWrite('pwd.pwd', $b);
        }


        $newC = count($new);
        LogUtils::get(__METHOD__)->info(['total' => $this->total, 'new' => $newC]);

        $this->cache = [];
        $this->count = 1;
        $this->total++;
    }


    protected function safeH($e, &$new, $line)
    {
        if ($this->checkEncoding($e)) {
            $new[$e['email']] = $e;
        } else {
            LogUtils::get(__METHOD__)->info('params ==>', $e);
        }
    }


    protected function checkEncoding($value)
    {
        try {
            fromPHP($value);
            return true;
        } catch (UnexpectedValueException $exception) {
            LogUtils::get(__METHOD__)->error($exception->getMessage(), $value);
        }
        return false;
    }
}