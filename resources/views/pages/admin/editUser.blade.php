@extends('pages.admin.layouts.app')

@section('user_content')
<h2 class="font-semibold text-2xl text-center">Edit akun</h2>
<div class="px-10 mx-20">
    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('update-user', $user->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                   @error('name') border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500 @enderror" 
                   placeholder="Name" autofocus required="">
            @error('name')
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                   @error('email') border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500 @enderror" 
                   placeholder="name@company.com" required="">
            @error('email')
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                   @error('phone') border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500 @enderror" 
                   placeholder="08xx xxxx xxxx">
            @error('phone')
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" id="password" name="password" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                   @error('password') border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500 @enderror" 
                   placeholder="••••••••">
            @error('password')
                <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password-confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
            <input type="password" id="password-confirm" name="password_confirmation" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                   placeholder="••••••••">
        </div>
        <label for="is_admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Peran</label>
        <select id="is_admin" name="is_admin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Pembeli</option>
          <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update account</button>
    </form>
    
</div>
@endsection