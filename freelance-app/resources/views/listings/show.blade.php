@extends('layouts.app')

@section('content')

<div>

    {{-- Listing Details --}}
    <h2>{{ $listing->title }}</h2>

    <p>
        <strong>Category:</strong>
        {{ $listing->category->name }}
    </p>

    <p>
        <strong>Price:</strong>
        ${{ $listing->price }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $listing->email }}
    </p>

    <p>
        {{ $listing->description }}
    </p>

    <div>
        <a href="{{ route('listings.edit', $listing) }}">Edit</a>

        <form action="{{ route('listings.destroy', $listing) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Delete this listing?')">Delete</button>
        </form>
    </div>

     <div>
            <div>

                <h4>Contact Freelancer</h4>

                @if (session('success'))
                    <div>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('listings.message', $listing) }}">
                    @csrf

                    <div>
                        <label>
                            Your Email
                        </label>
                        <input
                            type="email"
                            name="sender_email"
                            required
                        >
                    </div>

                    <div>
                        <label class="form-label">
                            Message
                        </label>
                        <textarea
                            name="message"
                            rows="4"
                            required
                        ></textarea>
                    </div>

                    <button>Send Message</button>
                </form>

            </div>
        </div>

        <a href="{{ route('listings.index') }}">Back to Listings</a>

    </div>
</div>
@endsection
