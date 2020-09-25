<?php

namespace MG\Inbox\Traits;

use MG\Inbox\Models\InboxThread;

/**
 * Class InboxServiceProvider.
 */
trait Threads
{
    public function sentThreads()
    {
        return InboxThread::where('sender_id', auth()->id())->get();
    }

    public function receivedThreads()
    {
        return InboxThread::where('receiver_id', auth()->id())->get();
    }

    public function threadMessages($threadId = null)
    {
        $threadMessages = InboxMessage::query();

        if (! is_null($threadId)){
            $threadMessages->where('thread_id', $threadId)->groupBy('thread_id');
        }

        return $threadMessages->get();
    }
}