<div role="status" id="toaster"
     x-data="toasterHub(@js($toasts), @js($config))"
     style="position:fixed; z-index:9999; padding:1rem; width:100%; display:flex; flex-direction:column; pointer-events:none; {{ $alignment->is('bottom') ? 'bottom:0;' : ($alignment->is('top') ? 'top:0;' : 'top:50%; transform:translateY(-50%);') }} {{ $position->is('left') ? 'align-items:flex-start;' : ($position->is('right') ? 'align-items:flex-end;' : 'align-items:center;') }}"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible"
             x-init="$nextTick(() => toast.show($el))"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-end="opacity-0"
             style="position:relative; max-width:22rem; width:100%; pointer-events:auto; {{ $position->is('center') ? 'text-align:center;' : '' }}"
        >
            <div x-text="toast.message"
                 style="display:inline-block; user-select:none; font-style:normal; padding:0.75rem 1.5rem; border-radius:0.375rem; box-shadow:0 10px 15px -3px rgba(0,0,0,.1),0 4px 6px -4px rgba(0,0,0,.1); font-size:0.875rem; width:100%; {{ $alignment->is('bottom') ? 'margin-top:0.75rem;' : 'margin-bottom:0.75rem;' }}"
                 :style="toast.select({
                     error: 'background-color:#ef4444; color:#fff;',
                     info: 'background-color:#e5e7eb; color:#1f2937;',
                     success: 'background-color:#16a34a; color:#fff;',
                     warning: 'background-color:#f97316; color:#fff;'
                 })"
            ></div>

            @if($closeable)
            <button @click="toast.dispose()" aria-label="@lang('close')" style="position:absolute; right:0; padding:0.5rem; background:none; border:none; cursor:pointer; color:inherit; {{ $alignment->is('bottom') ? 'top:0.75rem;' : 'top:0;' }}">
                <svg style="height:1rem; width:1rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
            @endif
        </div>
    </template>
</div>
