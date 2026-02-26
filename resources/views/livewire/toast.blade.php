<div class="fixed top-4 right-4 z-[9999] flex flex-col gap-2 pointer-events-none" x-data="{ 
        remove(id) {
            $wire.removeToast(id);
        }
    }" @toast-timeout.window="setTimeout(() => remove($event.detail.id), 3000)">
    @foreach($toasts as $toast)
        <div wire:key="toast-{{ $toast['id'] }}" x-data="{ show: false }" x-init="setTimeout(() => show = true, 10)"
            x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0" class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg border min-w-[300px] max-w-md bg-white 
                    @if($toast['type'] === 'success') border-emerald-100 bg-emerald-50 text-emerald-800 @endif
                    @if($toast['type'] === 'error') border-rose-100 bg-rose-50 text-rose-800 @endif
                    @if($toast['type'] === 'warning') border-amber-100 bg-amber-50 text-amber-800 @endif
                    @if($toast['type'] === 'info') border-blue-100 bg-blue-50 text-blue-800 @endif">
            <div class="flex-shrink-0">
                @if($toast['type'] === 'success')
                    <i class='bx bxs-check-circle text-xl text-emerald-500'></i>
                @elseif($toast['type'] === 'error')
                    <i class='bx bxs-error-circle text-xl text-rose-500'></i>
                @elseif($toast['type'] === 'warning')
                    <i class='bx bxs-error text-xl text-amber-500'></i>
                @else
                    <i class='bx bxs-info-circle text-xl text-blue-500'></i>
                @endif
            </div>

            <div class="flex-1 text-sm font-medium">
                {{ $toast['message'] }}
            </div>

            <button @click="show = false; setTimeout(() => remove('{{ $toast['id'] }}'), 200)"
                class="flex-shrink-0 text-slate-400 hover:text-slate-600 transition-colors">
                <i class='bx bx-x text-xl'></i>
            </button>
        </div>
    @endforeach
</div>