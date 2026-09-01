<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — V P Singh Advocate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: { extend: { colors: { charcoal: '#1A1816', ivory: '#F5EDE6', bronze: '#A38366' }, fontFamily: { sans: ['Open Sans', 'sans-serif'] } } }
        }
    </script>
</head>
<body class="bg-ivory font-sans min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-charcoal">V P Singh Advocate</h1>
                <p class="text-sm text-gray-500 mt-1">Admin Panel Login</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 text-sm rounded">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/admin/login">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" required
                           value="<?= old('email') ?>"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bronze focus:border-transparent outline-none"
                           placeholder="admin@vpsinghadvocate.com">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bronze focus:border-transparent outline-none"
                           placeholder="Enter your password">
                </div>

                <button type="submit"
                        class="w-full bg-charcoal text-white py-2.5 rounded-lg hover:bg-gray-800 transition font-medium">
                    Sign In
                </button>
            </form>

            <div class="mt-4 text-center text-xs text-gray-400">
                Default: admin@vpsinghadvocate.com / Admin@123
            </div>
        </div>
    </div>
</body>
</html>
