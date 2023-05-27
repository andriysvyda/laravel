<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Student $student): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        if (
            $user->role != 'guest'
        ) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Student $student): bool
    {
        if (
            $user->id === $student->superior_id ||
            $user->role === "editor" ||
            $user->role === "Admin" ||
            $user->role === "User"
        ) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Student $student): bool
    {
        if (
            $user->id == $student->superior_id ||
            $user->role == "Admin"
        ) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Student $student): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Student $student): bool
    {
        return false;
    }
}