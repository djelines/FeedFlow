<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class UserDTO
{
    public function __construct(
        public ?string $last_name,
        public ?string $first_name,
        public ?string $email,
        public ?string $password,
        public bool $mail_notifications = true
    ) {}

    /**
     * Create DTO from Request
     * @param Request $request
     * @return self
     */
    public static function fromRequest(Request $request): self
    {
        return new self(
            (string) $request->input('last_name'),
            (string) $request->input('first_name'),
            (string) $request->input('email'),
            $request->input('password'), 
            (bool) $request->input('mail_notifications', true)
        );
    }
}