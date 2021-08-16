<?php


namespace App\Services;


use App\Filters\UsersFilter;
use App\HelperTrait\FileHandler;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\UserRegistration;
use App\Notifications\UserUpdate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class UserServices extends BaseServices
{
    use FileHandler;

    public function __construct(User $user, UsersFilter $filter)
    {
        $this->model = $user;
        $this->filter = $filter;
    }

    public function users(): array
    {
        return [
            'date_format' => app_settings()['date_format'],
            'total_registration_fee' => Wallet::query()->where('type', 'registration_fee')->sum('amount'),
            'total_income' => Wallet::query()->where('type', 'income')->sum('amount'),
            'users' => $this->model::query()
                ->filters($this->filter)
                ->with(['role', 'profilePicture', 'sponsor', 'payment'])
                ->paginate(
                    request('per_page') ?: app_settings()['pagination']
                )
        ];
    }

    public function createCredentials(): array
    {
        return [
            'roles' => Role::query()->pluck('name', 'id')
        ];
    }

    public function validateUser($request, $user = null): UserServices
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                $user
                    ? Rule::unique(User::class)->ignore($user->id)
                    : Rule::unique(User::class)
            ],
            'phone' => [
                'required',
                'string',
                'numeric',
                $user
                    ? Rule::unique(User::class)->ignore($user->id)
                    : Rule::unique(User::class)
            ],
        ]);

        return $this;
    }

    public function createUser($request): UserServices
    {
        $this->model = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
        ]);

        $this->uploadProfilePhoto($request, $this->model);

        return $this;
    }

    public function updateUser($request, $user): UserServices
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

//        $this->uploadProfilePhoto($request, $user);

        return $this;
    }

    public function sendNotification($request)
    {
        $content = [

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $this->model->role->name,

        ];

        Notification::route('mail', $request->email)
            ->notify(new UserRegistration($content));
    }

    public function sendUpdateNotification($request, $user)
    {
        $content = [

            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role->name,

        ];

        Notification::route('mail', $user->email)
            ->notify(new UserUpdate($content));
    }

    public function uploadProfilePhoto($request, $user)
    {
        if ($request->user_image) {

            $this->deleteImage(optional($user->profilePicture)->path);

            $file_path = $this->uploadImage($request->user_image, config('file.profile_picture.folder'));

            $user->profilePicture()->updateOrCreate([
                'type' => 'profile_picture'
            ], [
                'path' => $file_path
            ]);
        }

    }

    public function deleteUser($user): bool
    {
        $this->deleteImage(optional($user->profilePicture)->path);

        $user->delete();

        return true;
    }

}
