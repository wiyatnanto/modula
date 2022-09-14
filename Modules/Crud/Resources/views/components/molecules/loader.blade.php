@props(['delay' => 0])
<div class="loader-wrapper">
    <div class="loader">
        <div class="loader-icon">
            <div class="spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="loader-text">
            Loading
        </div>
    </div>
</div>

<style>
    .loader-wrapper {
        background-color: #f9fafb;
        position: fixed;
        height: 100%;
        width: 100vw;
        z-index: 9999999999;
        margin-top: 60px;
        left: 0px;
        top: -50px;
        overflow: hidden;
    }

    .loader {
        width: 100px;
        height: 125px;
        margin: 0 auto;
        top: calc(50% - 5px);
        left: 50%;
        transform: translate(-50%, -50%);
        position: absolute;
    }

    .loader-icon {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .loader-text {
        text-align: center;
        width: 100%;
        position: absolute;
        bottom: 0px;
        color: #7987a1;
    }

    .spinner {
        width: 38.8px;
        height: 38.8px;
        animation: spinner-y0fdc1 2s infinite ease;
        transform-style: preserve-3d;
    }

    .spinner>div {
        background-color: rgba(188, 191, 252, 0.2);
        height: 100%;
        position: absolute;
        width: 100%;
        border: 2.2px solid #bcbffc;
    }

    .spinner div:nth-of-type(1) {
        transform: translateZ(-19.4px) rotateY(180deg);
    }

    .spinner div:nth-of-type(2) {
        transform: rotateY(-270deg) translateX(50%);
        transform-origin: top right;
    }

    .spinner div:nth-of-type(3) {
        transform: rotateY(270deg) translateX(-50%);
        transform-origin: center left;
    }

    .spinner div:nth-of-type(4) {
        transform: rotateX(90deg) translateY(-50%);
        transform-origin: top center;
    }

    .spinner div:nth-of-type(5) {
        transform: rotateX(-90deg) translateY(50%);
        transform-origin: bottom center;
    }

    .spinner div:nth-of-type(6) {
        transform: translateZ(19.4px);
    }

    @keyframes spinner-y0fdc1 {
        0% {
            transform: rotate(45deg) rotateX(-25deg) rotateY(25deg);
        }

        50% {
            transform: rotate(45deg) rotateX(-385deg) rotateY(25deg);
        }

        100% {
            transform: rotate(45deg) rotateX(-385deg) rotateY(385deg);
        }
    }
</style>
@push('script')
    <script>
        $(function() {
            document.body.style.overflowY = "hidden";
            setTimeout(() => {
                $(".loader-wrapper").fadeOut();
                document.body.style.overflowY = "auto";
            }, {{ $delay }});
        });
    </script>
@endpush
