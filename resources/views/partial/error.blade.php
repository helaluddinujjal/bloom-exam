
    <script>
        @if (Session::has('error_msg'))
          toastr.error("{!! session('error_msg') !!}");
      @endif
      @if (Session::has('success_msg'))
      toastr.success("{!! session('success_msg') !!}");
      @endif
      @if (Session::has('warning_msg'))
      toastr.warning("{!! session('warning_msg') !!}");
      @endif
      @if (Session::has('info_msg'))
      toastr.info("{!! session('info_msg') !!}");
      @endif

      {{--  //laravel message  --}}

    @if($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
</script>
