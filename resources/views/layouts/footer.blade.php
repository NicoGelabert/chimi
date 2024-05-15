<footer>
    <div class="footer-container">
        <div class="flex flex-col items-center md:items-start gap-y-4">
            <div class="logo footer-logo">
                <x-application-logo />
                <x-social-icons />
            </div>
            <p class="">Fuengirola, Málaga.</p>
        </div>
        <div class="footer-menu">
            <div>
                <h6>{{ __('My account') }}</h6>
                <ul>
                    <li>
                        <a href="{{ route('register') }}">
                            {{ __('Login') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">
                            {{ __('Register now') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h6>{{ __('The company') }}</h6>
                <ul>
                    <li><a href="#">{{ __('About us') }}</a></li>
                    <li><a href="#">{{ __('Work with us') }}</a></li>
                    <li><a href="#">{{ __('Terms & conditions') }}</a></li>
                    <li><a href="#">{{ __('Privacy policy') }}</a></li>
                </ul>
            </div>
            <div>
                <h6>{{ __('Help') }}</h6>
                <ul>
                    <li><a href="#">{{ __('Support') }}</a></li>
                    <li><a href="#">{{ __('Faq') }}</a></li>
                    <li><a href="#">{{ __('Contact us') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="footer-divider" />
    <div class="post-footer">
        <span class="developed-by">{{__('Sitio diseñado y desarrollado por')}}<a href="https://nicolasgelabert.com.ar" target="_blank"> Nicolás Gelabert</a></span>
        <ul class="flex gap-x-4">
            @foreach (Config::get('languages') as $lang => $language)
                @if ($lang != App::getLocale())
                    <li>
                        <a class="flex items-center gap-x-1 opacity-50" href="{{ route('lang.switch', $lang) }}">
                            <span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                            <span>{{$language['display']}}</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a class="flex items-center gap-x-1" href="{{ route('lang.switch', $lang) }}">
                            <span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                            <span>{{$language['display']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</footer>