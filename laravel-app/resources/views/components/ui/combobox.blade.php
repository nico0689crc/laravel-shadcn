@props([
    'name'              => null,
    'value'             => null,
    'options'           => [],
    'placeholder'       => null,
    'searchPlaceholder' => 'Buscar...',
    'emptyMessage'      => 'Sin resultados.',
    'size'              => 'md',
    'state'             => null,
    'disabled'          => false,
])

@php
$normalized = collect($options)
    ->map(fn($v, $k) => is_array($v) ? $v : ['value' => (string) $k, 'label' => (string) $v, 'disabled' => false])
    ->values()
    ->all();

$triggerSize = match($size) {
    'sm'    => 'h-8 pl-3 pr-2 text-[13px] gap-1.5',
    'lg'    => 'h-12 pl-4 pr-3 text-base gap-2.5',
    default => 'h-10 pl-3 pr-2.5 text-sm gap-2',
};

$stateClass = match($state) {
    'destructive' => 'border-destructive-border focus-visible:ring-destructive',
    'success'     => 'border-success-border focus-visible:ring-success',
    'warning'     => 'border-warning-border focus-visible:ring-warning',
    'info'        => 'border-info-border focus-visible:ring-info',
    default       => 'border-input focus-visible:ring-ring',
};

$chevronSize = match($size) {
    'sm'    => 'size-3.5',
    'lg'    => 'size-5',
    default => 'size-4',
};

$inputSize = match($size) {
    'sm'    => 'h-8 px-3 text-[13px]',
    'lg'    => 'h-12 px-4 text-base',
    default => 'h-9 px-3 text-sm',
};

$itemSize = match($size) {
    'sm'    => 'py-1 text-[13px]',
    'lg'    => 'py-2 text-base',
    default => 'py-1.5 text-sm',
};
@endphp

<div
    {{ $attributes->twMerge('inline-block w-full') }}
    x-data="{
        open:    false,
        value:   @js($value),
        search:  '',
        options: @js($normalized),
        uid: null, top: 0, left: 0, w: 0, _oc: null, _sc: null,

        init() {
            this.uid = 'cb-' + Math.random().toString(36).slice(2, 9);
        },

        get label() {
            const o = this.options.find(o => String(o.value) === String(this.value));
            return o ? o.label : null;
        },
        get filtered() {
            const q = this.search.toLowerCase();
            return q ? this.options.filter(o => o.label.toLowerCase().includes(q)) : this.options;
        },

        _open() {
            this.open = true;
            this.search = '';
            this.$nextTick(() => {
                this._place();
                this.$refs.searchInput?.focus();
                this._oc = e => {
                    const p = document.getElementById(this.uid);
                    if (!this.$refs.trigger?.contains(e.target) && !p?.contains(e.target)) this._close();
                };
                this._sc = () => { if (this.open) this._place(); };
                document.addEventListener('click', this._oc);
                window.addEventListener('scroll', this._sc, true);
                window.addEventListener('resize', this._sc);
            });
        },
        _close() {
            this.open = false;
            this.search = '';
            document.removeEventListener('click', this._oc);
            window.removeEventListener('scroll', this._sc, true);
            window.removeEventListener('resize', this._sc);
            this.$refs.trigger?.focus();
        },
        select(val, disabled) {
            if (disabled) return;
            this.value = val;
            this._close();
        },
        move(dir) {
            const enabled = this.filtered.filter(o => !o.disabled);
            if (!enabled.length) return;
            let idx = enabled.findIndex(o => String(o.value) === String(this.value));
            idx = (idx + dir + enabled.length) % enabled.length;
            this.value = enabled[idx].value;
        },
        _place() {
            const p = document.getElementById(this.uid);
            const t = this.$refs.trigger;
            if (!p || !t) return;
            const r  = t.getBoundingClientRect();
            const ph = p.offsetHeight;
            const g  = 4, m = 8;
            this.w    = r.width;
            this.left = r.left;
            this.top  = (r.bottom + ph + g > innerHeight - m) ? r.top - ph - g : r.bottom + g;
        }
    }"
    @keydown.escape.prevent="open && _close()"
    @keydown.arrow-down.prevent="open ? move(1) : _open()"
    @keydown.arrow-up.prevent="open && move(-1)"
    @keydown.enter.prevent="open ? null : _open()"
    @keydown.tab="open && _close()"
>
    {{-- Trigger --}}
    <button
        type="button"
        role="combobox"
        x-ref="trigger"
        :aria-expanded="open.toString()"
        aria-haspopup="listbox"
        @click="open ? _close() : _open()"
        @if($disabled) disabled @endif
        class="w-full flex items-center justify-between whitespace-nowrap rounded-md border bg-background text-foreground shadow-xs transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer {{ $triggerSize }} {{ $stateClass }}"
    >
        <span
            x-text="label ?? @js($placeholder)"
            :class="!label ? 'text-muted-foreground' : ''"
            class="truncate"
        ></span>
        <x-ui.icon name="chevron-down"
            class="shrink-0 text-muted-foreground transition-transform duration-200 {{ $chevronSize }}"
            x-bind:class="open ? 'rotate-180' : ''"
        />
    </button>

    @if($name)
        <input type="hidden" name="{{ $name }}" :value="value" />
    @endif

    {{-- Dropdown teleportado a body para evitar clipping --}}
    <template x-teleport="body">
        <div
            :id="uid"
            x-show="open"
            x-cloak
            :style="{ top: top + 'px', left: left + 'px', width: w + 'px' }"
            x-transition:enter="transition ease-out duration-100 origin-top"
            x-transition:enter-start="opacity-0 scale-y-95"
            x-transition:enter-end="opacity-100 scale-y-100"
            x-transition:leave="transition ease-in duration-75 origin-top"
            x-transition:leave-start="opacity-100 scale-y-100"
            x-transition:leave-end="opacity-0 scale-y-95"
            class="fixed z-50 rounded-md border border-border bg-popover shadow-md"
        >
            {{-- Search --}}
            <div class="border-b border-border p-1">
                <div class="relative flex items-center">
                    <x-ui.icon name="search" class="pointer-events-none absolute left-2.5 size-3.5 text-muted-foreground" />
                    <input
                        type="text"
                        x-ref="searchInput"
                        x-model="search"
                        placeholder="{{ $searchPlaceholder }}"
                        class="w-full {{ $inputSize }} pl-8 bg-transparent text-foreground placeholder:text-muted-foreground focus-visible:outline-none"
                    />
                </div>
            </div>

            {{-- Options --}}
            <div class="max-h-56 overflow-y-auto p-1" role="listbox">
                <template x-if="filtered.length > 0">
                    <template x-for="opt in filtered" :key="opt.value">
                        <div
                            role="option"
                            :aria-selected="String(value) === String(opt.value)"
                            @click="select(opt.value, opt.disabled)"
                            :class="{
                                'bg-accent text-accent-foreground': String(value) === String(opt.value),
                                'hover:bg-accent hover:text-accent-foreground': !opt.disabled,
                                'opacity-50 cursor-not-allowed': opt.disabled,
                                'cursor-pointer': !opt.disabled,
                            }"
                            class="relative flex items-center rounded-sm pl-8 pr-2 {{ $itemSize }} select-none outline-none"
                        >
                            <span class="absolute left-2 flex size-4 items-center justify-center" x-show="String(value) === String(opt.value)">
                                <x-ui.icon name="check" class="size-3.5" stroke-width="2.5" />
                            </span>
                            <span x-text="opt.label"></span>
                        </div>
                    </template>
                </template>
                <template x-if="filtered.length === 0">
                    <div class="py-6 text-center text-sm text-muted-foreground">{{ $emptyMessage }}</div>
                </template>
            </div>
        </div>
    </template>
</div>
