<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resep Nusantara &amp; Dunia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800&family=Instrument+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-ink font-sans antialiased">

<header class="border-b border-line">
    <div class="mx-auto flex max-w-5xl items-center justify-between px-5 py-4">
        <a href="{{ route('home') }}" class="font-display text-2xl font-extrabold tracking-tight text-chili">Resep<span class="text-ink">App</span></a>
        <a href="#tambah" class="rounded-full bg-chili px-4 py-2 text-sm font-semibold text-white hover:bg-chili-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-chili">+ Tambah resep</a>
    </div>
</header>

<main class="mx-auto max-w-5xl px-5">

    <section class="py-12 md:py-16">
        <p class="text-sm font-semibold uppercase tracking-widest text-leaf">{{ $total }} resep tersimpan</p>
        <h1 class="font-display mt-3 max-w-2xl text-4xl font-extrabold leading-tight tracking-tight md:text-6xl">Masak apa hari ini?</h1>
        <p class="mt-4 max-w-xl text-lg text-muted">Kumpulan resep makanan dari berbagai negara. Cari berdasarkan nama atau bahan, lalu buka kartunya untuk melihat bahan dan langkah memasak.</p>

        <form method="GET" action="{{ route('home') }}" class="mt-8 flex flex-col gap-3 sm:flex-row">
            <label class="sr-only" for="q">Cari resep</label>
            <input id="q" type="search" name="q" value="{{ $q }}" placeholder="Cari nama resep atau bahan, mis. ayam"
                   class="w-full flex-1 rounded-xl border border-line bg-white px-4 py-3 outline-none focus:border-chili focus:ring-2 focus:ring-chili/20">
            <label class="sr-only" for="country">Negara</label>
            <select id="country" name="country" class="rounded-xl border border-line bg-white px-4 py-3 outline-none focus:border-chili focus:ring-2 focus:ring-chili/20">
                <option value="">Semua negara</option>
                @foreach ($countries as $c)
                    <option value="{{ $c }}" @selected($c === $country)>{{ $c }}</option>
                @endforeach
            </select>
            <button class="rounded-xl bg-ink px-6 py-3 font-semibold text-white hover:bg-black">Cari</button>
        </form>
    </section>

    @if (session('status'))
        <div role="status" class="mb-6 rounded-xl border border-leaf/30 bg-leaf/10 px-4 py-3 text-leaf">{{ session('status') }}</div>
    @endif

    <section aria-label="Daftar resep">
        @if ($recipes->isEmpty())
            <div class="rounded-2xl border border-dashed border-line bg-white/60 p-10 text-center text-muted">
                Belum ada resep yang cocok. Coba kata kunci lain atau <a href="#tambah" class="font-semibold text-chili underline">tambah resep baru</a>.
            </div>
        @else
            <div class="grid gap-5 md:grid-cols-2">
                @foreach ($recipes as $recipe)
                    <article class="flex flex-col rounded-2xl border border-line bg-white p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <span class="inline-block rounded-full bg-chili/10 px-3 py-1 text-xs font-semibold text-chili">{{ $recipe->country }}</span>
                                <h2 class="font-display mt-3 text-2xl font-extrabold leading-tight">{{ $recipe->name }}</h2>
                            </div>
                            <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" onsubmit="return confirm('Hapus resep ini?')">
                                @csrf @method('DELETE')
                                <button class="rounded-lg px-2 py-1 text-sm text-muted hover:bg-chili/10 hover:text-chili" aria-label="Hapus {{ $recipe->name }}">Hapus</button>
                            </form>
                        </div>
                        <p class="mt-3 text-sm text-muted">{{ count($recipe->ingredientList()) }} bahan &middot; {{ count($recipe->stepList()) }} langkah</p>

                        <details class="group mt-4 border-t border-line pt-4">
                            <summary class="cursor-pointer list-none text-sm font-semibold text-chili marker:hidden">
                                <span class="group-open:hidden">Lihat resep &darr;</span><span class="hidden group-open:inline">Tutup &uarr;</span>
                            </summary>
                            <h3 class="mt-4 text-sm font-semibold uppercase tracking-wider text-leaf">Bahan</h3>
                            <ul class="mt-2 list-disc space-y-1 pl-5">
                                @foreach ($recipe->ingredientList() as $item)<li>{{ $item }}</li>@endforeach
                            </ul>
                            <h3 class="mt-5 text-sm font-semibold uppercase tracking-wider text-leaf">Langkah</h3>
                            <ol class="mt-2 list-decimal space-y-2 pl-5">
                                @foreach ($recipe->stepList() as $step)<li>{{ $step }}</li>@endforeach
                            </ol>
                        </details>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section id="tambah" class="my-16 rounded-2xl border border-line bg-white p-6 md:p-8">
        <h2 class="font-display text-3xl font-extrabold">Tambah resep baru</h2>
        <p class="mt-1 text-muted">Tulis satu bahan per baris, dan satu langkah per baris.</p>

        @if ($errors->any())
            <ul class="mt-4 list-disc rounded-xl bg-chili/10 px-8 py-3 text-chili">
                @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('recipes.store') }}" class="mt-6 grid gap-5 md:grid-cols-2">
            @csrf
            <div>
                <label for="name" class="mb-1 block text-sm font-semibold">Nama resep</label>
                <input id="name" name="name" value="{{ old('name') }}" required maxlength="255" class="w-full rounded-xl border border-line px-4 py-3 outline-none focus:border-chili focus:ring-2 focus:ring-chili/20">
            </div>
            <div>
                <label for="country_input" class="mb-1 block text-sm font-semibold">Negara asal</label>
                <input id="country_input" name="country" value="{{ old('country') }}" required maxlength="255" class="w-full rounded-xl border border-line px-4 py-3 outline-none focus:border-chili focus:ring-2 focus:ring-chili/20">
            </div>
            <div>
                <label for="ingredients" class="mb-1 block text-sm font-semibold">Bahan</label>
                <textarea id="ingredients" name="ingredients" rows="6" required class="w-full rounded-xl border border-line px-4 py-3 outline-none focus:border-chili focus:ring-2 focus:ring-chili/20">{{ old('ingredients') }}</textarea>
            </div>
            <div>
                <label for="instructions" class="mb-1 block text-sm font-semibold">Langkah memasak</label>
                <textarea id="instructions" name="instructions" rows="6" required class="w-full rounded-xl border border-line px-4 py-3 outline-none focus:border-chili focus:ring-2 focus:ring-chili/20">{{ old('instructions') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <button class="rounded-xl bg-chili px-6 py-3 font-semibold text-white hover:bg-chili-dark">Simpan resep</button>
            </div>
        </form>
    </section>
</main>

<footer class="border-t border-line py-8 text-center text-sm text-muted">
    ResepApp &middot; Laravel + MySQL di Docker &middot; <a class="underline" href="/api/recipes">/api/recipes</a>
</footer>

</body>
</html>
