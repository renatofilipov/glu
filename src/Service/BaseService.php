<?php
/**
 * Base Service
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

namespace App\Service;

use App\Exception\TaskException;
use Respect\Validation\Validator as v;

/**
 * All custom services will extend from this base class
 */
abstract class BaseService {
    const STATUS_NEW = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_DONE = 2;

    /**
     * Validate whether provided task status is valid or not
     *
     * @param int $status
     * @return int
     * @throws TaskException
     */
    protected static function validateTaskStatus(int $status): int {
        if (!v::numeric()->between(self::STATUS_NEW, self::STATUS_DONE)->validate($status)) {
            throw new TaskException('Invalid status', 400);
        }

        return $status;
    }
}
