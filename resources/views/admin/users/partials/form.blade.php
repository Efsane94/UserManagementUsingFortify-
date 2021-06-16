@csrf
<div class="form-group mb-3">
    <label for="name">Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           id="name" aria-describedby="emailHelp"
           value="{{ old('name') }}@isset($user){{$user->name}}@endisset">
    @error('name')
    <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="email">Email address</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
           id="exampleInputEmail1" aria-describedby="emailHelp"
           value="{{ old('email') }}@isset($user){{$user->email}}@endisset">
    @error('email')
    <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
    @enderror
</div>

@isset($create)
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
               id="password">
        @error('password')
        <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
        @enderror
    </div>
    <div class="form-group mb-3">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
               name="password_confirmation"
               id="password_confirmation">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
        @enderror
    </div>
@endisset
<div class="mb-3">
    @foreach($roles as $role)
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="roles[]"
                   type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
                @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
            <label class="form-check-label" for="{{ $role->name }}">
                {{ $role->name }}
            </label>
        </div>
    @endforeach
</div>
<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">Create</button>
</div>
