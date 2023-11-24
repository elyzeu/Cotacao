<style>
    .bg {
        background-color: #333333;
    }

    .bg2 {
        background-color: #222;
    }

    .card-container {
        position: relative;
        overflow: hidden;
        animation: pulseAnimation 2s ease-out infinite; /* Alterado para ease-out */
        box-shadow: 0 0 40px rgba(255, 0, 0, 0.7);
        border-radius: 15px;
    }

    @keyframes pulseAnimation {
        0% {
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.7);
        }
        50% {
            box-shadow: 0 0 50px rgba(255, 0, 0, 0.5);
        }
        100% {
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.7);
        }
    }
</style>

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg">
<div>
            {{ $logo }}
        </div>    
<div class="card-container w-full text-black sm:max-w-md mt-6 px-6 py-4 bg2 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    <br>
    <br>
    <br>
</div>
