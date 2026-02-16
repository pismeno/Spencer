<?php

namespace App\Services;

use App\Models\Group;
use App\Models\User;
use App\Models\Event;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SearchService
{
    public function users(Request $request): Collection|User
    {
        $request->validate([
            'email' => ['nullable', 'string', 'min:1'],
        ]);

        $requester = auth()->user();

        if (!$request->filled('email')) {
            return $this->relatedUsers($requester);
        }

        return User::whereLike('email', '%' . $request->email . '%')
            ->where('id', '!=', $requester->id)
            ->limit(10)
            ->get();
    }

    //TODO: implement actual logic
    private function relatedUsers(Authenticatable $user): array
    {
        return [];
    }

    public function groups(Request $request): Collection|Group
    {
        $request->validate([
            'title' => ['nullable', 'string', 'min:1'],
        ]);

        $requester = auth()->user();

        if (!$request->filled('title')) {
            return $this->relatedGroups($requester);
        }

        return Group::whereLike('name', '%' . $request->title . '%')
            ->limit(10)
            ->get();
    }

    //TODO: implement actual logic
    private function relatedGroups(Authenticatable $user): array
    {
        return [];
    }

    public function events(Request $request): Collection|Event
    {
        $request->validate([
            'title' => ['nullable', 'string', 'min:1'],
        ]);

        $requester = auth()->user();

        if (!$request->filled('title')) {
            return $this->relatedEvents($requester);
        }

        return Event::whereLike('title', '%' . $request->title . '%')
            ->limit(10)
            ->get();
    }

    private function relatedEvents(Authenticatable $user): array
    {
        return [];
    }
}
