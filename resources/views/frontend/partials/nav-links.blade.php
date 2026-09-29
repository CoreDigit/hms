<li class="">
    <a href="{{ route('web.index') }}">{{ __('general.words.home') }}</a>
</li>

<li class="dropdown">
    <a href="">{{ __('cruds.services.') }}</a>
    <ul>
        <li>
            <a href="{{ route('web.single.services.index') }}">
                {{ __('cruds.services.single') }}
            </a>
        </li>
        <li>
            <a href="{{ route('web.multi.services.index') }}">
                {{ __('cruds.services.multi') }}
            </a>
        </li>
        <li>
            <a href="{{ route('web.services.index') }}">
                {{ __('field.info') }}
            </a>
        </li>
    </ul>
</li>

<li class="">
    <a href="{{ route('web.doctors.index') }}">{{ __('users.doctors') }}</a>
</li>

<li class="">
    <a href="{{ route('web.departments.index') }}">{{ __('cruds.departments') }}</a>
</li>

<li>
    <a href="{{ route('web.contacts.create') }}">{{ __('general.contact.') }}</a>
</li>

<li class="dropdown">
    <a href="">{{ __('general.about.') }}</a>
    <ul>
        <li>
            <a href="{{ route('web.about.us') }}">
                {{ __('general.about.us') }}
            </a>
        </li>
        <li>
            <a href="{{ route('web.about.faq') }}">
                {{ __('general.faq.') }}
            </a>
        </li>
    </ul>
</li>

<li class="dropdown">
    <a href="">{{ __('general.words.language') }}</a>
    <ul>
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" hreflang="{{ $localeCode }}"
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>
</li>

@if (auth()->guard('admin')->check() ||
        auth()->guard('doctor')->check() ||
        auth()->guard('patient')->check() ||
        auth()->guard('rayEmployee')->check() ||
        auth()->guard('labEmployee')->check())
    <li>
        <a href="{{ route('dashboard') }}">{{ __('general.dashboard.') }}</a>
    </li>
@else
    <li>
        <a href="{{ route('login') }}">{{ __('auth.login.') }}</a>
    </li>
    <li>
        <a href="{{ route('register') }}">{{ __('auth.register.') }}</a>
    </li>
@endif
