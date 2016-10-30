<?php

namespace spec\League\Tactician\Bernard;

use League\Tactician\Bernard\QueuedCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class QueueMiddlewareSpec extends ObjectBehavior
{
    /**
     * @param \Bernard\Producer $producer
     */
    function let($producer)
    {
        $this->beConstructedWith($producer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('League\Tactician\Bernard\QueueMiddleware');
    }

    function it_is_a_middleware()
    {
        $this->shouldImplement('League\Tactician\Middleware');
    }

    /**
     * @param \Bernard\Producer $producer
     * @param \Bernard\Message  $command
     */
    function it_executes_a_command($producer, $command)
    {
        $producer->produce($command)->shouldBeCalled();

        $this->execute(
            $command,
            function () {
            }
        );
    }

    /**
     * @param \Bernard\Producer            $producer
     * @param \League\Tactician\Middleware $middleware
     */
    function it_executes_invokes_the_next_middleware($producer, $middleware)
    {
        $command = new \stdClass;
        $producer->produce($command)->shouldNotBeCalled();
        $next = function () {};
        $middleware->execute($command, $next)->willReturn(true);

        $this->execute(
            $command,
            function ($command) use ($middleware, $next) {
                return $middleware->execute($command, $next);
            }
        );
    }

    /**
     * @param \Bernard\Producer            $producer
     * @param \Bernard\Message             $command
     * @param \League\Tactician\Middleware $middleware
     */
    function it_unwraps_a_command($producer, $command, $middleware)
    {
        $queuedCommand = new QueuedCommand($command->getWrappedObject());
        $producer->produce($command)->shouldNotBeCalled();
        $next = function () {};
        $middleware->execute($command, $next)->willReturn(true);

        $this->execute(
            $queuedCommand,
            function ($command) use ($middleware, $next) {
                return $middleware->execute($command, $next);
            }
        );
    }
}
