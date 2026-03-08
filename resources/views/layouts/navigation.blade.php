<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/60 bg-[rgba(255,250,244,0.82)] shadow-[0_10px_30px_rgba(77,52,31,0.06)] backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-200 via-amber-100 to-stone-100 shadow-inner ring-1 ring-orange-200/70">
                            <img src="{{ asset('images/logo/logo.png') }}" alt="Company Logo" class="h-9 w-auto">
                        </span>
                        <div class="hidden sm:block">
                            <p class="font-heading text-2xl font-semibold leading-none text-slate-800">Filia Studio</p>
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Project Workspace</p>
                        </div>
                    </a>
                </div>

                <div class="hidden items-center gap-2 lg:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-orange-100 text-orange-900 shadow-sm' : 'text-slate-600 hover:bg-white hover:text-orange-800' }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('dashboard.projects.index') }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('dashboard.projects.*') ? 'bg-slate-900 text-stone-50 shadow-sm' : 'text-slate-600 hover:bg-white hover:text-orange-800' }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>
                        Projects
                    </a>
                    <a href="{{ route('progress.index') }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold {{ request()->routeIs('progress.*') ? 'bg-emerald-100 text-emerald-900 shadow-sm' : 'text-slate-600 hover:bg-white hover:text-orange-800' }}">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Progress
                    </a>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-white hover:text-orange-800">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Website
                    </a>
                </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                <div class="rounded-full border border-white/70 bg-white/80 px-4 py-2 shadow-sm">
                    <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] uppercase tracking-[0.24em] text-slate-500">{{ Auth::user()->role }}</p>
                </div>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-full border border-white/70 bg-white/85 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:border-orange-200 hover:text-orange-800 focus:outline-none">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-orange-100 to-amber-50 text-orange-800">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-2 py-2">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-xl">
                                <svg class="mr-2 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="rounded-xl text-red-600"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="mr-2 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex h-12 w-12 items-center justify-center rounded-2xl border border-white/70 bg-white/85 text-slate-600 shadow-sm hover:text-orange-800 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-white/60 bg-[rgba(255,250,244,0.96)] px-4 pb-5 pt-4 sm:hidden">
        <div class="space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard') ? 'bg-orange-100 text-orange-900' : 'bg-white/80 text-slate-700' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('dashboard.projects.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard.projects.*') ? 'bg-slate-900 text-stone-50' : 'bg-white/80 text-slate-700' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                </svg>
                Projects
            </a>
            <a href="{{ route('progress.index') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('progress.*') ? 'bg-emerald-100 text-emerald-900' : 'bg-white/80 text-slate-700' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Progress
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-2xl bg-white/80 px-4 py-3 text-sm font-semibold text-slate-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Website
            </a>
        </div>

        <div class="mt-4 rounded-[1.5rem] border border-white/70 bg-white/85 p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</p>
            <p class="mt-1 text-xs uppercase tracking-[0.24em] text-slate-500">{{ Auth::user()->role }} · {{ Auth::user()->email }}</p>
            <div class="mt-4 space-y-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-2xl bg-stone-50 px-4 py-3 text-sm font-semibold text-slate-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-3 rounded-2xl bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
