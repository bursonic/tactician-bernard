<?php

namespace spec\League\Tactician\Bernard\Receiver;

use Bernard\Message;
use League\Tactician\CommandBus;
use PhpSpec\ObjectBehavior;

class SeparateBusReceiverSpec extends ObjectBehavior
{
    /**
     * @param \League\Tactician\CommandBus $commandBus
     */
    function let(CommandBus $commandBus)
    {
        $this->beConstructedWith($commandBus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('League\Tactician\Bernard\Receiver\SeparateBusReceiver');
        $this->shouldHaveType('League\Tactician\Bernard\Receiver');
    }

    /**
     * @param \League\Tactician\CommandBus $commandBus
     * @param \Bernard\Message    $command
     */
    function it_handles_a_message(CommandBus $commandBus, Message $command)
    {
        $commandBus->handle($command)->willReturn(true);

        $this->handle($command)->shouldReturn(true);
    }

    /**
     * @param \League\Tactician\CommandBus $commandBus
     * @param \Bernard\Message    $command
     */
    function it_is_invokable(CommandBus $commandBus, Message $command)
    {
        $commandBus->handle($command)->willReturn(true);

        $this->__invoke($command)->shouldReturn(true);
    }
}
