<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    h1{
        text-align: center;
    }
    .text{
        position: absolute;
        display: flex;
    }
</style>

<body>
    <div class="">
        <h1>Projects</h1>
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
            <h5 class="text">abc</h5>
        </a> 
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
            <h5 class="text">abc</h5>
        </a> 
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
            <h5 class="text">abc</h5>
        </a> 
        <a href="">
            <img src="https://picsum.photos/id/111/300/300" alt="an old car">
            <h5 class="text">abc</h5>
        </a> 
    </div>
    
</body>

</html>
