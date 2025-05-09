<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <button id="pay-button" class="rounded-xl bg-chartreuse p-4 text-white">
            Bayar Sekarang
        </button>
    </div>
    
        <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    alert("Pembayaran berhasil!");
                    console.log(result);
                },
                onPending: function(result){
                    alert("Menunggu pembayaran!");
                    console.log(result);
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                    console.log(result);
                }
            });
        };
    </script>
</x-app-layout>
