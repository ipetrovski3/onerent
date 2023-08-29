<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .slash-line {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 1px;
            background-color: #ccc; /* Adjust color as needed */
        }
  
        .date-cell {
            width: 40px; /* Adjust width as needed */
            text-align: center;
            padding: 5px; /* Adjust padding as needed */
        }
    
        .bg-diagonal-line-from {
            position: relative;
            background: linear-gradient(135deg, #34d399 50%, #f87171 50%);
        }

        .bg-diagonal-line-to {
            position: relative;
            background: linear-gradient(-45deg, #34d399 50%, #f87171 50%);
        }
    </style>
    <title>Cars Availability</title>
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gray-100">

    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> --}}

    @livewireScripts

</body>
</html>
