<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>Mailparser</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet"
    >
    <link
        rel="stylesheet"
        href="/css/app.css"
    >

    {{ $style ?? null }}
</head>

<body>
    <header>
        <a href="/">MailParser</a>
    </header>
    <section>
        {{ $slot }}
    </section>
    <script src="/js/app.js"></script>
</body>

</html>