<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body {
            background-color: rgb(230, 230, 230)
        }
    </style>
</head>
<body>



<section class="space-y-6" style="padding: 5rem">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- <x-danger-button --}}
    <x-danger-button onclick="showConfirm()" style="background-color: rgb(202, 0, 0); color : white; border: none" class="ml-3">
        {{ __('Delete Account') }}
    </x-danger-button>

    <div name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" style="display: none; margin-top:4rem" focusable id="confirmDelete">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                {{-- <x-input-label for="password" value="Password" class="sr-only" /> --}}
                <label for="password" value="Password" class="sr-only">Password</label>

                {{-- <x-text-input --}}
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end" style="margin-top: 20px">
                <x-secondary-button onclick="closeConfirm()">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button style="background-color: rgb(202, 0, 0); color : white; border: none" class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</section>



<script>

function showConfirm() {
    document.getElementById("confirmDelete").style.display = 'block';
}
function closeConfirm() {
    document.getElementById("confirmDelete").style.display = 'none';
}

</script>


</body>
</html>
