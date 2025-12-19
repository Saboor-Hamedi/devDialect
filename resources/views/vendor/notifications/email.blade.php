<x-mail::message>
    {{-- Greeting --}}
    @if (!empty($greeting))
        # {{ $greeting }}
    @else
        @if ($level === 'error')
            # @lang('Whoops!')
        @else
            # @lang('Hello!')
        @endif
    @endif

    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
        {{ $line }}

    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
        <?php
        $color = match ($level) {
            'success', 'error' => $level,
            default => 'primary',
        };
                ?>
        <x-mail::button :url="$actionUrl" :color="$color">
            {{ $actionText }}
        </x-mail::button>
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
        {{ $line }}

    @endforeach

    {{-- Salutation --}}
    @if (!empty($salutation))
        {{ $salutation }}
    @else
        @lang('Regards,')<br>
        <strong>{{ config('app.name') }}</strong>
    @endif

    <div style="margin-top: 32px; border-top: 1px solid #e2e8f0; padding-top: 16px;"></div>

    @isset($actionText)
        <x-slot:subcopy>
            <p
                style="font-size: 13px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">
                Security Access</p>
            <p style="font-size: 14px; color: #64748b; margin-bottom: 12px;">If you're having trouble with the button, use
                the secure link below to proceed:</p>
            <a href="{{ $actionUrl }}"
                style="word-break: break-all; font-size: 13px; color: #6366f1; text-decoration: none; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; background: #f8fafc; padding: 12px; border-radius: 8px; display: block; border: 1px solid #e2e8f0;">{{ $actionUrl }}</a>
        </x-slot:subcopy>
    @endisset
</x-mail::message>