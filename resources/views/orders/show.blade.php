@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="container card mt-6 shadow-lg">
        <div class="card-header h3">Order Info</div>
        <div class="card-body fs-5">
            <div class=row>
            <div class="col-md-6">
                <p class="card-text">Patient Name: {{$order->patient->type->name}}</p>
                <p class="card-text">Assigned Pharmacy: {{$order->pharmacy->type->name}}</p>
                <p class="card-text">Doctor Name: {{$order->doctor->type->name}}</p>
                <p class="card-text">Total Price: {{$order->price."$"}}</p>
                <p class="card-text">Medicine Name: {{$medicine->name}}</p>
                <p class="card-text">Medicine Type: {{$medicine->type}}</p>
                <p class="card-text">Quantity: {{$order->medicineOrder->quantity}}</p>
                <p class="card-text">Status: {{$order->status}}</p>
                <p class="card-text">Creator Type: {{$order->creator_type}}</p>
                @if($order->is_insured)
                    <p class="card-text">Is_insured: Yes</p>
                @else
                    <p class="card-text">Is_insured: No</p>
                @endif
        </div>
        </div>
        </div>
    </div>
@endsection
