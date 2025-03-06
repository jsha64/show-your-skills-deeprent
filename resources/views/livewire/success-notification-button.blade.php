<div>
    <button wire:click="showNotification" class="bg-blue-500 text-white px-4 py-2">Mostrar Notificación</button>

    @if ($showMessage)
        <div class="mt-4 p-4 bg-green-500 text-white">
            ✅ Success
        </div>
    @endif
</div>
