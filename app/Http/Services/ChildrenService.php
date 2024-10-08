<?php

namespace App\Http\Services;

use App\Http\Repositories\ChildrenRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ChildrenService{

    public function createChildrens(array $data, User $user,$request)
    {
        try {
            $incomingChildrens =  collect($data ?? [])->pluck('id')->toArray();
            $allChildrens = $user->childrens()->get()->pluck('id')->toArray();
            $childrensToDelete = array_diff($allChildrens, $incomingChildrens);
            $user->childrens()->whereIn('id', $childrensToDelete)->delete();

            collect($data ?? [])->each(function ($childrenData, $index) use ($user,$request) {

                if ($request->hasFile("childrens.$index.photo")) {
                    $childrenData['photo'] = $request->file("childrens.$index.photo")->store('images/childrens', 'public');
                }

                $childrenData['user_id'] = $user->id;
                $birthday = $childrenData['birth_date'];
                $document = $childrenData['document'];

                list($year, $month,$day) = explode('-', $birthday);
                $childrenData['register_number'] = "MATR".Carbon::now()->year.substr($document, -4).$month.$day;
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
