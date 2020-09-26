<?php

namespace MG\Inbox\Traits;

use MG\Inbox\Models\InboxThread;
use MG\Inbox\Models\InboxMessage;

trait Threads
{
    public function composeThread($receiversIds, $subject, $message, $cc = null)
    {
        return DB::transaction(function () use ($receiversIds, $subject, $message, $cc) {
            $thread = InboxThread::create([
                'sender_id'     => auth()->id(),
                'receiver_id'   => $receiversIds,
                'cc'            => $cc,
                'subject'       => $subject,
            ]);
    
            $thread->messages()->create([
                'sender_id'     => auth()->id(),
                'receiver_id'   => $receiversIds,
                'message'       => $message,
            ]);

            return $thread;
        });
    }

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

    public function starThread($threadId)
    {
        return InboxThread::find($threadId)->update(['starred' => true]);
    }
}