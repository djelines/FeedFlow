<?php

namespace App\DTOs;

use App\Actions\Survey\UpdateSurveyAction;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

final class SurveyDTO
{
    private function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly int $user_id,
        public readonly int $organization_id,
        public readonly Carbon $start_date,
        public readonly Carbon $end_date,
        public readonly bool $is_anonymous,
    ) {}

    public static function fromRequest(StoreSurveyRequest|UpdateSurveyRequest $request): self
    {

        //Convert Date in Carbon
        $start = Carbon::parse($request->start_date);
        $end   = Carbon::parse($request->end_date);
        
    return new self(
        title: $request->title ?? "",
        description: $request->description ?? "",
        is_anonymous: $request->is_anonymous ?? false,
        user_id: Auth::user()->id,
        organization_id: $request->organization_id ?? 0,
        start_date: $start ?? "",
        end_date: $end ?? ""
    );
    }
}

