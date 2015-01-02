<?php

/*
 * This file is part of the Indigo Doris package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Doris;

use Tactician\CommandBus\CommandBus;
use Bernard\Queue;
use Bernard\Envelope;
use Bernard\Message;

/**
 * Sends the command to a remote location using message queues
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class RemoteCommandBus implements CommandBus
{
    /**
     * @var Queue
     */
    protected $queue;

    /**
     * @param Queue $queue
     */
    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($command)
    {
        if (!$command instanceof Message) {
            $command = new CommandMessage($command);
        }

        $this->queue->enqueue(new Envelope($command));
    }
}
