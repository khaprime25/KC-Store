<x-user-layout>
    <x-navbar :categories="$categories"/>



    <div class="container py-3">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))
                <div class="alert alert-success w-75 mx-auto mt-3 alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <div class="profile-card">

                <div class="profile-header">

                    <h2>My Profile</h2>

                    <p>
                        Manage your personal information
                    </p>

                </div>

                <form action="{{ route('user.profiles.update') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- PROFILE IMAGE --}}
                    <div class="profile-avatar-section">

                        <img
                            id="profilePreview"
                            src="{{ auth()->user()->profile_image
                                    ? asset(auth()->user()->profile_image)
                                    : asset('images/defaultAvatar.jpeg') }}"
                            alt="Profile"
                            class="profile-avatar">

                        <label class="profile-upload-btn">

                            <i class="fa-solid fa-camera"></i>

                            Change Photo

                            <input
                                type="file"
                                id="profileInput"
                                name="profile_image"
                                accept="image/*"
                                hidden>

                        </label>

                    </div>

                    {{-- FORM GRID --}}
                    <div class="profile-form-grid">

                        <div class="profile-group">

                            <label>Name</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}">

                        </div>

                        <div class="profile-group">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}">

                        </div>

                        <div class="profile-group">

                            <label>Phone Number</label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone', auth()->user()->phone) }}">

                        </div>

                    </div>

                    <div class="text-center mt-4">

                        <button
                            type="submit"
                            class="profile-save-btn">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

            </div>

        </div>

    </div>

</x-user-layout>

<script>

document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('profileInput');
    const preview = document.getElementById('profilePreview');

    input.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;

        };

        reader.readAsDataURL(file);

    });

});

</script>