@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Listing Details --}}
            <div class="card mb-4">
                <div class="card-body">

                    <h2 class="card-title mb-3">{{ $listing->title }}</h2>

                    <p class="mb-1">
                        <strong>Category:</strong>
                        {{ $listing->category->name }}
                    </p>

                    <p class="mb-1">
                        <strong>Price:</strong>
                        ${{ $listing->price }}
                    </p>

                    <p class="mb-3">
                        <strong>Email:</strong>
                        {{ $listing->email }}
                    </p>

                    <p class="card-text">
                        {{ $listing->description }}
                    </p>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('listings.edit', $listing) }}" class="btn btn-outline-secondary btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('listings.destroy', $listing) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this listing?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Contact Freelancer --}}
            <div class="card mb-4">
                <div class="card-body">

                    <h4 class="mb-3">Contact Freelancer</h4>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('listings.message', $listing) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="email" name="sender_email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="4" class="form-control" required></textarea>
                        </div>

                        <button class="btn btn-primary">
                            Send Message
                        </button>
                    </form>

                </div>
            </div>

            <a href="{{ route('listings.index') }}" class="btn btn-link">
                Back to Listings
            </a>

        </div>
    </div>
</div>
@endsection
