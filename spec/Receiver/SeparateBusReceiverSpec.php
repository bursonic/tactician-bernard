<?php

namespace spec\League\Tactician\Bernard\Receiver;

use Bernard\Message;
use League\Tactician\Bernard\Receiver;
use League\Tactician\Bernard\Receiver\SeparateBusReceiver;
use League\Tactician\CommandBus;
use PhpSpec\ObjectBehavior;

final class SeparateBusReceiverSpec extends ObjectBehavior
{
    function let(CommandBus $commandBus)
    {
        $this->beConstructedWith($commandBus);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SeparateBusReceiver::class);
    }

    function it_is_a_receiver()
    {
        $this->shouldHaveType(Receiver::class);
    }

    function it_handles_a_message(CommandBus $commandBus, Message $command)
    {
        $commandBus->handle($command)->shouldBeCalled();

        $this->handle($command);
    }

    function it_is_invokable(CommandBus $commandBus, Message $command)
    {
        $commandBus->handle($command)->shouldBeCalled();

        $this->__invoke($command);
    }
}
