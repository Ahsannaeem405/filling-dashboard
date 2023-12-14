<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    img {
        --s: 15px;
        --b: 2px;
        --w: 200px;
        --c: #7B3B3B;

        width: var(--w);
        aspect-ratio: 1;
        object-fit: cover;
        padding: calc(2*var(--s));
        --_g: var(--c) var(--b), #0000 0 calc(100% - var(--b)), var(--c) 0;
        background:
            linear-gradient(var(--_g)) 50%/100% var(--_i, 100%) no-repeat,
            linear-gradient(90deg, var(--_g)) 50%/var(--_i, 100%) 100% no-repeat;
        outline: calc(var(--w)/2) solid #0009;
        outline-offset: calc(var(--w)/-2 - 2*var(--s));
        transition: .4s;
        cursor: pointer;
    }

    img:hover {
        outline: var(--b) solid var(--c);
        outline-offset: calc(var(--s)/-2);
        --_i: calc(100% - 2*var(--s));
    }

    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: center;
        background: #e8e8e8;
    }

    h1 {
        text-align: center;
    }

    .text {
        position: absolute;
        display: flex;
    }

    @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");

    * {
        box-sizing: border-box;
    }

    body {
        font-family: "Montserrat", sans-serif;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        min-height: 100vh;
        margin: 0;
        transition: background 0.2s linear;
    }

    body.dark {
        background-color: #292c35;
    }

    /* #9b59b6 */

    body.dark h1,
    body.dark .support a {
        color: #fff;
    }

    .checkbox {
        opacity: 0;
        position: absolute;
    }

    .checkbox-label {
        background-color: #111;
        width: 50px;
        height: 26px;
        border-radius: 50px;
        position: relative;
        padding: 5px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .fa-moon-o {
        color: #f1c40f;
    }

    .fa-sun-o {
        color: #f39c12;
    }

    .checkbox-label .ball {
        background-color: #fff;
        width: 22px;
        height: 22px;
        position: absolute;
        left: 2px;
        top: 2px;
        border-radius: 50%;
        transition: transform 0.2s linear;
    }

    .checkbox:checked+.checkbox-label .ball {
        transform: translateX(24px);
    }
</style>

<body>
    <h1>Light/Dark Toggle<br> Button</h1>

    <div>
        <input type="checkbox" class="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox-label">
            <i class="fa fa-moon-o"></i>
            <i class="fa fa-sun-o"></i>
            <span class="ball"></span>
        </label>
    </div>

    <div class="">
        <h1>Projects</h1>
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
        </a>
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
        </a>
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
        </a>
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
        </a>
    </div>
    <script>
        const checkbox = document.getElementById("checkbox")
        checkbox.addEventListener("change", () => {
            document.body.classList.toggle("dark")
        })
    </script>
</body>

</html>
