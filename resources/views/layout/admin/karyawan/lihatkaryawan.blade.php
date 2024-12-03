<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor">
    <section id="app" class="bg-bgcolor flex">
        <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
        <sidebar></sidebar>
        <div class="ml-[68px] lg:ml-64 mt-16 w-full">

        </div>
    </section>
</body>
</html>