@extends('layouts.master')

@section('javascript')
<script src="assets/js/plugins/sweetalert.min.js"></script>
<script>
    $('.confirm-modal').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: "Êtes-vous sûr ?",
            text: "Cette opération est irreversible !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
@endsection
