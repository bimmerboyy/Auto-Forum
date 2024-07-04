<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Topic;
use App\Models\User;

class TopicPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function close(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id;
    }
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Topic $topic)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Topic $topic)
    {
        //
    }
}
