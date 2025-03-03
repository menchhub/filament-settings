@props([
    'heading' => null,
    'subheading' => null,
])

<div class="flex h-screen">
    <!-- ✅ Left Pane (Illustration) -->
    <div class="hidden w-full lg:flex lg:w-1/2 items-center justify-center bg-black text-black
            bg-cover bg-center bg-no-repeat"
         style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
         url('{{ $settings["backgroundImage"] }}');">
        <div class="max-w-md text-center">
            <blockquote class="text-white text-left">
                <p class="text-2xl font-bold mb-2 uppercase">{{ $settings['title'] }}</p>
                <p class="text-2xl italic">
                    {{ $settings['description'] }}
                </p>
            </blockquote>
        </div>
    </div>

    <!-- ✅ Right Pane (Login Form) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center"
         style="background-color: {{ $settings['loginBgColor'] }};">
        <div class="max-w-md w-full p-6">
            <section class="grid auto-cols-fr gap-y-6">
                <x-filament-panels::header.simple
                        :heading="$heading ??= $this->getHeading()"
                        :logo="$this->hasLogo()"
                        :subheading="$subheading ??= $this->getSubHeading()"
                />

                @if (filament()->hasRegistration())
                    <x-slot name="subheading">
                        {{ __('filament-panels::pages/auth/login.actions.register.before') }}
                        {{ $this->registerAction }}
                    </x-slot>
                @endif

                <x-filament-panels::form wire:submit="authenticate">
                    {{ $this->form }}

                    <x-filament-panels::form.actions
                            :actions="$this->getCachedFormActions()"
                            :full-width="$this->hasFullWidthFormActions()"
                    />
                </x-filament-panels::form>
            </section>
        </div>
    </div>
</div>
