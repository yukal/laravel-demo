<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body cz-shortcut-listen="true">
    <main>
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Contents</h2>

            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <h3 class="fs-2 text-body-emphasis">Genres</h3>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                        sentence and probably just keep going until we run out of words.</p>
                    <a href="{{ route('genres.index') }}" class="icon-link">See detailed</a>
                </div>

                <div class="feature col">
                    <h3 class="fs-2 text-body-emphasis">Movies</h3>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another
                        sentence and probably just keep going until we run out of words.</p>
                    <a href="{{ route('movies.index') }}" class="icon-link">See detailed</a>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
