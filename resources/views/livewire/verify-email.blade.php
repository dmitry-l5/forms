<div class=" h-full w-full flex-col flex justify-center items-center" >
    <div class="p-5 shadow border sm:max-w-[600px] lg:max-w-[1000px]">
        <div class="mb-4 text-gray-600 text-2xl">
            Перед использованем сервиса, пожалуйста, подтвердите ваш email. После нажатия на кнопку "Отправить проверочный email", вам на адрес, указфнный при регистрации, придёт письмо. Перейдите по указанной в письме ссылке. Если письмл не пришло нажмите кнопку ещё раз, а также проверьте папку "Спам".
        </div>
        
        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-2xl text-green-600">
            Новая ссылка была отправлена на email, указаный при регистрации.
        </div>
        @endif
        
        <div class="mt-4 flex items-center justify-between  ">
            <x-primary-button wire:click="sendVerification" class="text-xl">
                Отправить проверочный email
            </x-primary-button>
            
            <button wire:click="logout" type="submit" class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500  text-2xl">
                Выйти
            </button>
        </div>
    </div>
</div>