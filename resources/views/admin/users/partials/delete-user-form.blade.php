<button data-bs-toggle="modal" data-bs-target="#confirm-user-deletion-{{ $userId }}" type="button" class="btn-delete" data-id="{{ $user->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
        <path
            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
    </svg>
    
</button>

<div id="confirm-user-deletion-{{ $userId }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('users.destroy', $userId) }}" class="p-6">
                @csrf
                @method('delete')
        
                <h3 class="font-medium text-center m-3" style="color: #7b9a6c;">
                    {{ $userName }}
                </h3>
                <h4 class="font-medium text-center m-3">
                    Are you sure you want to delete this user?
                </h4>
        
                <div class="m-3 d-flex justify-content-center">
                    <x-secondary-button data-dismiss="modal">
                        {{ __('Cancel') }}
                    </x-secondary-button>
        
                    <x-danger-button class="ml-3">
                        Delete user
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
</div>