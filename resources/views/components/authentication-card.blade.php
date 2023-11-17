<style>
    .bg{
        background-color: #333333;
       /* background-image: url("images/bg.jpeg");*/
        background-size: 100%;
    }
    .bg2{
        background-color: #222;
       /* background-image: url("images/bg.jpeg");*/
     
    }
</style>
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full text-black sm:max-w-md mt-6 px-6 py-4 bg2 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    <br>
    <br>
    <br>
</div>
