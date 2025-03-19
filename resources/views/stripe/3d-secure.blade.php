@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Completa los pasos de seguridad') }}</div>

                <div class="card-body">
                    <p>Necesita seguir algunos pasos con su banco.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ App\ConfigGeneral::first()->stripe_public }}');

        stripe.handleCardAction("{{ $clientSecret }}")
            .then(function (result) {
                if (result.error) {
                    window.location.replace("{{ route('cancelled') }}");
                } else {
                    window.location.replace("{{ route('approval') }}");
                }

            });

    </script>
@endpush
@endsection
