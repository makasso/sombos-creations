<div role="status" id="toaster"
     x-data="toasterHub(@js($toasts), @js($config))"
     style="position:fixed; z-index:99999; top:1rem; right:1rem; display:flex; flex-direction:column; align-items:flex-end; pointer-events:none; gap:0.5rem; max-width:24rem; width:100%;"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible"
             x-init="$nextTick(() => toast.show($el))"
             x-transition:enter="toaster-enter"
             x-transition:enter-start="toaster-enter-start"
             x-transition:enter-end="toaster-enter-end"
             x-transition:leave="toaster-leave"
             x-transition:leave-end="toaster-leave-end"
             style="position:relative; width:100%; pointer-events:auto; background:#fff; border-radius:0.5rem; box-shadow:0 20px 25px -5px rgba(0,0,0,.1),0 8px 10px -6px rgba(0,0,0,.1); overflow:hidden; border:1px solid #e5e7eb;"
        >
            {{-- Colored left accent bar --}}
            <div style="position:absolute; left:0; top:0; bottom:0; width:4px;"
                 :style="toast.select({
                     error: 'background:#ef4444;',
                     info: 'background:#3b82f6;',
                     success: 'background:#10b981;',
                     warning: 'background:#f59e0b;'
                 })"
            ></div>

            <div style="display:flex; align-items:flex-start; padding:1rem 1rem 1rem 1.25rem; gap:0.75rem;">
                {{-- Icon --}}
                <div style="flex-shrink:0; margin-top:1px;">
                    <template x-if="toast.type === 'success'">
                        <svg style="width:1.25rem; height:1.25rem; color:#10b981;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg style="width:1.25rem; height:1.25rem; color:#ef4444;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg style="width:1.25rem; height:1.25rem; color:#f59e0b;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg style="width:1.25rem; height:1.25rem; color:#3b82f6;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </template>
                </div>

                {{-- Message --}}
                <div style="flex:1; min-width:0;">
                    <p x-text="toast.select({ error: 'Error', info: 'Info', success: 'Success', warning: 'Warning' })"
                       style="margin:0 0 0.125rem 0; font-size:0.8125rem; font-weight:600; line-height:1.25;"
                       :style="toast.select({
                           error: 'color:#991b1b;',
                           info: 'color:#1e40af;',
                           success: 'color:#065f46;',
                           warning: 'color:#92400e;'
                       })"
                    ></p>
                    <p x-text="toast.message"
                       style="margin:0; font-size:0.8125rem; color:#6b7280; line-height:1.4;"
                    ></p>
                </div>

                {{-- Close button --}}
                @if($closeable)
                <button @click="toast.dispose()" aria-label="@lang('close')" style="flex-shrink:0; padding:0.25rem; background:none; border:none; cursor:pointer; color:#9ca3af; border-radius:0.25rem; transition:color 0.15s, background 0.15s;" onmouseover="this.style.color='#374151'; this.style.background='#f3f4f6';" onmouseout="this.style.color='#9ca3af'; this.style.background='none';">
                    <svg style="width:1rem; height:1rem;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </template>
</div>

<style>
    .toaster-enter { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .toaster-enter-start { opacity: 0; transform: translateX(1rem); }
    .toaster-enter-end { opacity: 1; transform: translateX(0); }
    .toaster-leave { transition: all 0.2s cubic-bezier(0.4, 0, 1, 1); }
    .toaster-leave-end { opacity: 0; transform: translateX(1rem); }
</style>
