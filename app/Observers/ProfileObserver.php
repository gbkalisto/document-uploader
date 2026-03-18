<?php

namespace App\Observers;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileObserver
{

    /**
     * Handle the Profile "creating" event.
     */
    public function creating(Profile $profile)
    {
        if (request()->hasFile('profile_picture')) {
            $file = request()->file('profile_picture');

            // Generate a unique name: timestamp + random string
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Store the file
            $path = $file->storeAs('profiles', $fileName, 'public');

            // Set the path in the model
            $profile->profile_picture = $path;
        }
    }
    /**
     * Handle the Profile "created" event.
     */
    public function created(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "updated" event.
     */
    public function updated(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "updating" event.
     */
    public function updating(Profile $profile)
    {
        // If profile_picture is changed
        if ($profile->isDirty('profile_picture')) {

            $oldImage = $profile->getOriginal('profile_picture');

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }
    }

    /**
     * Handle the Profile "deleted" event.
     */
    public function deleted(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "restored" event.
     */
    public function restored(Profile $profile): void
    {
        //
    }

    /**
     * Handle the Profile "force deleted" event.
     */
    public function forceDeleted(Profile $profile): void
    {
        //
    }
}
