<div>
    {{-- The whole world belongs to you. --}}
</div>
@push('script')
    <script type="text/javascript">
        window.addEventListener('swal:alert', event => { 
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('swal:confirm', event => { 
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
                confirmButtonText: event.detail.confirmButtonText,
                cancelButtonText: event.detail.cancelButtonText,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // window.livewire.emit('deleteData', event.detail.id);
                    window.livewire.emit(event.detail.emitDelete, event.detail.id);
                }
            });
        });
    </script>
@endpush
