@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
    <form action="{{ route('movies.update', $movie->id) }}" method="POST"
        class="max-w-4xl mx-auto bg-blue-50 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
        @csrf
        @method('PUT') <!-- Tambahkan method PUT untuk update -->

        <!-- Poster -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="file" name="poster" id="poster" value="{{ old('poster', $movie->poster) }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="poster"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Poster</label>
            @error('poster')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Synopsis -->
        <div class="relative z-0 w-full mb-5 group">
            <textarea name="synopsis" id="synopsis" rows="4"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required>{{ old('synopsis', $movie->synopsis) }}</textarea>
            <label for="synopsis"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">synopsis</label>
            @error('synopsis')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <!-- Poster -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="file" name="poster" id="poster" value="{{ old('poster', $movie->poster) }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="poster"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Poster</label>
            @error('poster')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- Year -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="number" name="year" id="year" value="{{ old('year') }}" min="0"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="year"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Year</label>
                @error('year')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Available -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="boolean" name="available" id="available" value="{{ old('available', $movie->available) }}" min="0"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="available"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Available</label>
                @error('available')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Genre -->
            <div class="relative z-0 w-full mb-5 group">
                <select name="genre" id="genre"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    required>
                    <option value="" disabled {{ old('genre', $movie->genre_id) ? '' : 'selected' }}>Pilih Genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ old('genre', $movie->genre_id) == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                    @endforeach
                </select>
                <label for="genre"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Genre</label>
                @error('genre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <!-- Submit Button -->
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
    </form>
</section>
@endsection