<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shortify - URL Shortener</title>

    <!-- Tailwind CSS CDN (or use your own compiled version) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">
        <div class="text-center text-gray-800 mb-4 md:px-96 px-8 lg:px-96">
            <h1 class="text-3xl mb-4">Shortify - URL Shortener</h1>
            <p class="">Shortify is a simple and efficient web application that allows users to shorten long URLs into more manageable and shareable links. With an intuitive user interface and seamless functionality, Shortify is designed to make the URL shortening process quick and hassle-free.</p>
        </div>

        <div class="flex items-center justify-center mt-4">
            <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Shorten Your URL</h2>
                <form id="shorten-form" action="/shorten" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="original_url" class="block text-sm font-medium text-gray-700 mb-1">Enter URL</label>
                        <input
                            type="url"
                            id="original_url"
                            name="original_url"
                            placeholder="https://example.com"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required />
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                        Generate Short URL
                    </button>
                </form>

                <!-- Error section, hidden initially -->
                <div id="error-result" class="mt-4  hidden p-4 bg-red-100 text-red-700 border border-red-400 rounded-lg">
                    <div id="error-messages"></div>
                </div>

                <!-- Success result section, hidden initially -->
                <div id="success-result" class="mt-4 hidden">
                    <p class="text-sm text-gray-600">Your short URL:</p>
                    <a id="short-url" href="#" class="text-blue-500 hover:underline"></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add event listener to form submission
        document.getElementById('shorten-form').addEventListener('submit', async function(e) {
            e.preventDefault(); // Prevent form submission

            // Get CSRF token and URL input value
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const originalUrl = document.getElementById('original_url').value;

            // Hide previous error/success result
            document.getElementById('error-result').classList.add('hidden');
            document.getElementById('success-result').classList.add('hidden');

            try {
                // Send POST request to shorten URL
                const response = await fetch('/shorten', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken, // Include CSRF token in request headers
                        'Accept': 'application/json', // Ensure we expect JSON
                    },
                    body: JSON.stringify({
                        original_url: originalUrl
                    }),
                });

                if (!response.ok) {
                    const data = await response.json();
                    if (data.errors) {
                        // Display errors
                        const errorMessages = data.errors.original_url.map(error => `<p class="text-red-600">${error}</p>`).join('');
                        document.getElementById('error-messages').innerHTML = errorMessages;
                        document.getElementById('error-result').classList.remove('hidden');
                    } else {
                        throw new Error('Failed to generate short URL');
                    }
                } else {
                    // Parse response data
                    const data = await response.json();

                    // Display the short URL in the result section
                    const shortUrlElement = document.getElementById('short-url');
                    shortUrlElement.href = data.short_url_action;
                    shortUrlElement.textContent = data.short_url; // Display short URL as the link text

                    // Show the success result section
                    document.getElementById('success-result').classList.remove('hidden');
                }
            } catch (error) {
                console.error(error);
            }
        });
    </script>

</body>

</html>