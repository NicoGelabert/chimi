<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 bg-black">
    <div class="mx-auto flex items-center justify-center flex-wrap gap-4 rounded-lg p-8">
        <p class="small cookie-consent__message text-white">
            {!! trans('cookie-consent::texts.message') !!}
        </p>
        <x-button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer btn-primary text-white">
            <i class="fi fi-rr-arrow-right arrow-to-right"></i> <span>{{ trans('cookie-consent::texts.agree') }}</span>
        </x-button>
    </div>
</div>
