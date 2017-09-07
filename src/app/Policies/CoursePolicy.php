<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

use Illuminate\Support\Facades\Auth;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function view(Admin $admin, Course $course)
    {

    }

    /**
     * Determine whether the user can create courses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function update(Admin $admin, Course $course)
    {
        $cos = Course::find($course);

        if($cos)
        {

            foreach($cos->admins as $ad)
            {
                $check = $us->pivot->admin_id;
                if ($admin->id== $check) 
                {
                    echo $check;
                    return true;
                }
            }
            return false;
        }
        else
            return false;
    }

    /**
     * Determine whether the user can delete the course.
     *
     * @param  \App\User  $user
     * @param  \App\Course  $course
     * @return mixed
     */
    public function delete(Admin $admin, Course $course)
    {
        $cos = Course::find($course);

        if($cos)
        {

            foreach($cos->admins as $ad)
            {
                $check = $us->pivot->admin_id;
                if ($admin->id== $check) 
                {
                    return true;
                }
            }
            return false;
        }
        else
            return false;
    }
}
