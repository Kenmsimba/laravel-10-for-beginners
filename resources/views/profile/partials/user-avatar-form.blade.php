<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            User avatar
        </h2>
        
        <img width="50" height="50" class="rounded-full" src="{{ "/storage/$user->avatar" }}" alt="user avatar">
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Add or update User Avatar
        </p>
    </header>

    <!-- display any message if it exists -->
    @if (session('message'))
        <div class="text-red-500">
            {{ session('message') }}
        </div>
    @endif

    <!-- the avatar's form -->
    <form method="post" action="{{'/profile/avatar'}}" enctype="multipart/form-data"> 
        <!-- provide method spoofing since the method should be a patch request and html doesnt provide a direct patch request -->
        @method('patch')

        <!--  another possible approach
        <input type="hidden" name="_method" value="patch">
        -->

        <!-- Adding CSRF. (Prevevents malicious attempts to submit malicious content through the form )
        <input type="hidden" name="_token"value="{{ csrf_token() }}">
          Another possible approach 
        -->
        @csrf
        

        <div>
            <x-input-label for="name" value="Avatar" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" 
            :value="old('avatar', $user->name)"
              autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            
                    
        </div>
    </form>
</section>
