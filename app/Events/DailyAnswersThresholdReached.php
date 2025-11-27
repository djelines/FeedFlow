<?php

namespace App\Events;

use App\Models\SurveyAnswer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DailyAnswersThresholdReached
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     */
    public function __construct( public string $ownerEmail, public string $surveyName, public int $surveyAnswersCount, public string $userName)
    {
        $this->ownerEmail = $ownerEmail;
        $this->surveyName = $surveyName;
        $this->surveyAnswersCount = $surveyAnswersCount;
        $this->userName = $userName;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
