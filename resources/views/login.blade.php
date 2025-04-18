<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @layer utilities {
          .bg-chartreuse {
            background-color: #B9C240;
          }
          .text-chartreuse {
            color: #B9C240;
          }
          .focus\:ring-chartreuse:focus {
            --tw-ring-color: #B9C240;
            }
        }
      </style>
</head>
<body class="h-screen flex flex-wrap font-sans">
    <div class="w-full md:w-2/5 p-10 relative flex justify-center items-start">
        <h1 class="tracking-widest md:text-4xl font-bold text-chartreuse">
            Selamat Datang Di WellMaggot
        </h1>
        <img src="{{ asset('images/Reduce plastic bag campaign.png') }}" alt=""
        class="md:absolute bottom-0 w-48 md:w-auto">
    </div>

    <div class="w-full md:w-3/5 bg-chartreuse rounded-t-lg md:rounded-r-none md:rounded-l-lg p-10">
        <ul class="flex items-center justify-between">
            <li class="text-white font-semibold">Beranda</li>
            <div class="flex items-center space-x-4">
              <li class="text-white font-semibold">Masuk</li>
              <li>
                <button class="bg-white text-chartreuse cursor-pointer font-bold px-4 py-2 rounded-lg">
                  Daftar
                </button>
              </li>
            </div>
          </ul>

          <div class="flex flex-col min-h-[calc(100vh-200px)] items-center justify-center">
              <form action="POST" class="w-full max-w-md bg-white text-chartreuse p-10 rounded-xl shadow-md">
                  <label for="email" class="block mb-2 font-semibold">Email</label>
                  <input
                      type="email"
                      placeholder="tulis email kamu..."
                      name="email"
                      id="email"
                      class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                      required
                  >

                  <label for="password" class="block mb-2 font-semibold">Kata Sandi</label>
                  <input
                      type="password"
                      placeholder="minimal 8 karakter ya!!"
                      name="password"
                      id="password"
                      class="w-full px-4 py-2 mb-4 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                      required
                  >

                  <div class="flex justify-between items-center">
                      <a href="#" class="text-sm text-chartreuse hover:underline">Lupa kata sandi</a>
                      <button type="submit" class="cursor-pointer bg-chartreuse text-white py-2 px-4 rounded-lg hover:bg-lime-500 transition-all">
                          Masuk
                      </button>
                  </div>
              </form>
          </div>
    </div>
</body>
</html>
