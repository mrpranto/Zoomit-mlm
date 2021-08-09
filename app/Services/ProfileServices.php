<?php


namespace App\Services;


use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Repository\CustomInfoRepository;
use Illuminate\Support\Facades\Hash;

class ProfileServices extends BaseServices
{
    use PasswordValidationRules;

    protected $user;
    protected $employee;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getProfileInfo($request): array
    {

        if ($request->user) {

            return $this->geUserInfo($request->user);

        }
    }

    private function geUserInfo($user_id): array
    {
        $this->user = $this->user::query()
                    ->with('role', 'profilePicture')
                    ->findOrFail($user_id);

        $profileInfo = [

            'user' => true,
            'id' => $this->user->id,
            'role_id' => $this->user->role_id,
            'name' => $this->user->name,
            'employee_id' => $this->user->employee_id,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'role' => $this->user->role->name,
            'dob' => $this->user->date_of_birth,
            'profile_picture' => optional($this->user->profilePicture)->full_url,
            'social_links' => resolve(CustomInfoRepository::class)->getFormatSocialLinks(User::class, $this->user->id)

        ];

        return $profileInfo;
    }


    public function updateProfile($request, $user)
    {
        resolve(UserServices::class)
            ->validateUser($request, $user)
            ->updateUser($request, $user);

    }

    public function validatePassword($request): ProfileServices
    {
        if ($request->user_id == auth()->id()) {

            $request->validate([

                'old_password' => ['required', 'string'],
                'password' => $this->passwordRules(),
            ]);

        }else{

            $request->validate([
                'password' => $this->passwordRules(),
            ]);
        }

        return $this;
    }

    public function changePassword($request): ProfileServices
    {

        $this->user::query()
            ->where('id', auth()->id())
            ->update([
                'password' => Hash::make($request->password)
            ]);

        return $this;
    }

    public function validateSocialLinks($request): ProfileServices
    {
        $request->validate([

            'social_link.*' => 'nullable|string|url'

        ]);

        return $this;
    }

    public function storeLinks($request, $user)
    {
        foreach ($request->social_link ?? [] as $key => $social_link){

            if ($social_link) {

                $user->socialLinks()
                    ->updateOrCreate(
                        [
                            'type' => 'social_links',
                            'name'  => $key
                        ], [
                            'value' => $social_link
                        ]
                    );

            }
        }
    }

}
