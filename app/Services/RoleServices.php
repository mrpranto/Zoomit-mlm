<?php


namespace App\Services;


use App\HelperTrait\SlugMaker;
use App\Models\Backend\Company;
use App\Models\Backend\GroupInfo;
use App\Models\Backend\HRM\HrSetup\Department;
use App\Models\Backend\HRM\HrSetup\Designation;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleServices extends BaseServices
{
    use SlugMaker;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function roles($request): array
    {
        return [
            'roles' => $this->model::query()
                ->with('users')
                ->when($request->search, function (Builder $builder) use($request) {
                    $builder->where('name', 'Like', "%{$request->search}%")
                        ->orWhere('slug', 'Like', "%{$request->search}%");
                })->paginate(request('per_page') ?: app_settings()['pagination'])
        ];
    }

    public function createCredentials(): array
    {
        return [
            'modules' => Module::query()->with('permissions')->get(['id', 'name']),
        ];
    }

    public function validateRole($request): RoleServices
    {
        $request->validate([

            'name' => 'required|string|max:100',
            'note' => 'nullable|max:1000',
            'is_delete' => 'required|boolean',
            'permission' => 'required|array'

        ]);

        return $this;
    }

    public function storeRole($request)
    {
        DB::transaction(function () use($request){

            $this->model = $this->model->newQuery()
                ->create($this->requestInfo($request));

            $this->model
                ->permissions()
                ->sync($request->permission);

        });

        Artisan::call('cache:clear');
    }

    private function requestInfo($request, $update = null): array
    {
        if ($update){

            return [
                'name' => $request->name,
                'note' => $request->note,
                'delete_able' => $request->is_delete,
            ];
        }

        return [
            'name' => $request->name,
            'slug' => $this->getSlug($request->name, $this->model),
            'note' => $request->note,
            'delete_able' => $request->is_delete,
        ];
    }

    public function updateRole($request, $role)
    {
        DB::transaction(function () use($request, $role){

            $role->update($this->requestInfo($request, true));

            $role->permissions()->sync($request->permission);

        });

        Artisan::call('cache:clear');
    }

}
