<?php

namespace App\Http\Services;

use App\Http\Repositories\ChildrenRepository;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ChildrenService{

    // protected $repository;

    // public function __construct(ChildrenRepository $repository){
    //     $this->repository = $repository;
    // }

    // public function index()
    // {
    //     return $this->repository->getAll();
    // }

    public function createChildrens(array $data, User $user)
    {
        try {
            $incomingChildrens =  collect($data ?? [])->pluck('id')->toArray();
            $allChildrens = $user->childrens()->get()->pluck('id')->toArray();
            $childrensToDelete = array_diff($allChildrens, $incomingChildrens);
            $user->childrens()->whereIn('id', $childrensToDelete)->delete();

            collect($data ?? [])->each(function ($childrenData) use ($user) {
                $childrenData['user_id'] = $user->id;
                if (isset($childrenData['id'])) {
                    $childrenToUpdate = $user->childrens()->find($childrenData['id']);

                    if ($childrenToUpdate) {
                        $childrenToUpdate->update($childrenData);
                    }
                } else {
                    $user->childrens()->create($childrenData);
                }
            });
        } catch (\Exception $e) {
            Log::error('Error an creating a new user contact' . $e->getMessage());
        }
    }

}